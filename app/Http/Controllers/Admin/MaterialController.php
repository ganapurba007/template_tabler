<?php

namespace App\Http\Controllers\Admin;

use App\Events\MaterialCreated;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with(['subject', 'schoolClass', 'instructor'])
            ->latest()
            ->paginate(10);

        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        $user = Auth::user();
        $subjects = $user->subjects()->exists() ? $user->subjects : Subject::all();
        $classes = SchoolClass::all();

        return view('admin.materials.create', compact('subjects', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'class_id' => ['required', 'exists:classes,id'],
            'content_type' => ['required', 'in:text,document,youtube'],
            'content' => ['required_if:content_type,text', 'nullable', 'string'],
            'document_file' => ['required_if:content_type,document', 'nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,txt,png,jpg,jpeg', 'max:20480'],
            'video_url' => ['required_if:content_type,youtube', 'nullable', 'url'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $user = Auth::user();
        if ($user->subjects()->exists() && !$user->subjects()->where('subjects.id', $request->subject_id)->exists()) {
            return back()->withErrors(['subject_id' => 'Anda tidak berhak membuat materi untuk mata pelajaran ini.'])->withInput();
        }

        $documentPath = null;
        if ($request->content_type === 'document' && $request->hasFile('document_file')) {
            $documentPath = $request->file('document_file')->store('materials', 'public');
        }

        $material = new Material();
        $material->title = $request->title;
        $material->content_type = $request->content_type;
        $material->content = $request->content_type === 'text' ? $request->content : null;
        $material->document_path = $request->content_type === 'document' ? $documentPath : null;
        $material->video_url = $request->content_type === 'youtube' ? $request->video_url : null;
        $material->order = $request->order ?? 0;
        $material->subject_id = $request->subject_id;
        $material->class_id = $request->class_id;
        $material->instructor_id = Auth::id();
        $material->save();

        event(new MaterialCreated($material));

        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi pembelajaran berhasil ditambahkan dan notifikasi realtime dikirim.');
    }

    public function edit(Material $material)
    {
        $user = Auth::user();
        $subjects = $user->subjects()->exists() ? $user->subjects : Subject::all();
        $classes = SchoolClass::all();

        return view('admin.materials.edit', compact('material', 'subjects', 'classes'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'class_id' => ['required', 'exists:classes,id'],
            'content_type' => ['required', 'in:text,document,youtube'],
            'content' => ['required_if:content_type,text', 'nullable', 'string'],
            'document_file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,txt,png,jpg,jpeg', 'max:20480'],
            'video_url' => ['required_if:content_type,youtube', 'nullable', 'url'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $user = Auth::user();
        if ($user->subjects()->exists() && !$user->subjects()->where('subjects.id', $request->subject_id)->exists()) {
            return back()->withErrors(['subject_id' => 'Anda tidak berhak mengedit materi untuk mata pelajaran ini.'])->withInput();
        }

        if ($request->content_type === 'document' && $request->hasFile('document_file')) {
            if ($material->document_path) {
                Storage::disk('public')->delete($material->document_path);
            }
            $material->document_path = $request->file('document_file')->store('materials', 'public');
        }

        $material->title = $request->title;
        $material->content_type = $request->content_type;
        $material->content = $request->content_type === 'text' ? $request->content : null;
        if ($request->content_type !== 'document') {
            if ($material->document_path) {
                Storage::disk('public')->delete($material->document_path);
            }
            $material->document_path = null;
        }
        $material->video_url = $request->content_type === 'youtube' ? $request->video_url : null;
        $material->order = $request->order ?? 0;
        $material->subject_id = $request->subject_id;
        $material->class_id = $request->class_id;
        $material->save();

        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi pembelajaran berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        if ($material->document_path) {
            Storage::disk('public')->delete($material->document_path);
        }

        $material->delete();

        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi pembelajaran berhasil dihapus.');
    }
}
