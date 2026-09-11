<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionBank;
use App\Models\QuestionBankOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuestionBankController extends Controller
{
    public function index(): View
    {
        $questionBanks = QuestionBank::with('options')
            ->withCount('options')
            ->where('instructor_id', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.question-banks.index', compact('questionBanks'));
    }

    public function create(): View
    {
        return view('admin.question-banks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question_text' => ['required', 'string'],
            'options' => ['required', 'array', 'min:2'],
            'options.*' => ['required', 'string'],
            'correct_option' => ['required', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($request) {
            $questionBank = new QuestionBank([
                'question_text' => trim($request->question_text),
            ]);
            $questionBank->instructor_id = Auth::id();
            $questionBank->save();

            foreach ($request->options as $index => $optionText) {
                QuestionBankOption::create([
                    'question_bank_id' => $questionBank->id,
                    'option_text' => trim($optionText),
                    'is_correct' => (int) $index === (int) $request->correct_option,
                ]);
            }
        });

        return redirect()->route('admin.question-banks.index')->with('success', 'Soal berhasil ditambahkan ke Bank Soal.');
    }

    public function edit(QuestionBank $questionBank): View
    {
        $questionBank->load('options');

        return view('admin.question-banks.edit', compact('questionBank'));
    }

    public function update(Request $request, QuestionBank $questionBank): RedirectResponse
    {
        $request->validate([
            'question_text' => ['required', 'string'],
            'options' => ['required', 'array', 'min:2'],
            'options.*' => ['required', 'string'],
            'correct_option' => ['required', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($request, $questionBank) {
            $questionBank->update([
                'question_text' => trim($request->question_text),
            ]);

            $questionBank->options()->delete();

            foreach ($request->options as $index => $optionText) {
                QuestionBankOption::create([
                    'question_bank_id' => $questionBank->id,
                    'option_text' => trim($optionText),
                    'is_correct' => (int) $index === (int) $request->correct_option,
                ]);
            }
        });

        return redirect()->route('admin.question-banks.index')->with('success', 'Soal di Bank Soal berhasil diperbarui.');
    }

    public function destroy(QuestionBank $questionBank): RedirectResponse
    {
        $questionBank->delete();

        return redirect()->route('admin.question-banks.index')->with('success', 'Soal di Bank Soal berhasil dihapus.');
    }
}
