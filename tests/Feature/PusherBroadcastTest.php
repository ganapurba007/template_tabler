<?php

namespace Tests\Feature;

use App\Events\AssignmentCreated;
use App\Events\DiscussionCommentSent;
use App\Events\MaterialCreated;
use App\Models\Assignment;
use App\Models\Material;
use App\Models\MaterialDiscussion;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PusherBroadcastTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_discussion_comment_sent_event_broadcasts_on_material_channel(): void
    {
        Event::fake([DiscussionCommentSent::class]);

        $guru = User::where('email', 'guru@lms.com')->first();
        $class = SchoolClass::first();
        $subject = Subject::first();

        $material = new Material([
            'title' => 'Materi Realtime',
            'content_type' => 'text',
            'content' => 'Konten materi',
        ]);
        $material->class_id = $class->id;
        $material->subject_id = $subject->id;
        $material->instructor_id = $guru->id;
        $material->save();

        $discussion = MaterialDiscussion::create([
            'material_id' => $material->id,
            'user_id' => $guru->id,
            'comment' => 'Komentar awal diskusi',
        ]);

        DiscussionCommentSent::dispatch($discussion);

        Event::assertDispatched(DiscussionCommentSent::class, function ($event) use ($material) {
            return $event->discussion->material_id === $material->id
                && $event->broadcastOn()[0]->name === 'private-material.'.$material->id
                && $event->broadcastAs() === 'comment.sent';
        });
    }

    public function test_material_created_event_broadcasts_on_class_channel(): void
    {
        Event::fake([MaterialCreated::class]);

        $guru = User::where('email', 'guru@lms.com')->first();
        $class = SchoolClass::first();
        $subject = Subject::first();

        $material = new Material([
            'title' => 'Materi Baru Realtime',
            'content_type' => 'text',
            'content' => 'Konten materi baru',
        ]);
        $material->class_id = $class->id;
        $material->subject_id = $subject->id;
        $material->instructor_id = $guru->id;
        $material->save();

        MaterialCreated::dispatch($material);

        Event::assertDispatched(MaterialCreated::class, function ($event) use ($class) {
            return $event->material->class_id === $class->id
                && $event->broadcastOn()[0]->name === 'private-class.'.$class->id
                && $event->broadcastAs() === 'material.created';
        });
    }

    public function test_assignment_created_event_broadcasts_on_class_channel(): void
    {
        Event::fake([AssignmentCreated::class]);

        $guru = User::where('email', 'guru@lms.com')->first();
        $class = SchoolClass::first();
        $subject = Subject::first();

        $assignment = new Assignment([
            'title' => 'Tugas Baru Realtime',
            'description' => 'Deskripsi tugas baru',
            'due_date' => now()->addDays(3),
        ]);
        $assignment->class_id = $class->id;
        $assignment->subject_id = $subject->id;
        $assignment->instructor_id = $guru->id;
        $assignment->save();

        AssignmentCreated::dispatch($assignment);

        Event::assertDispatched(AssignmentCreated::class, function ($event) use ($class) {
            return $event->assignment->class_id === $class->id
                && $event->broadcastOn()[0]->name === 'private-class.'.$class->id
                && $event->broadcastAs() === 'assignment.created';
        });
    }
}
