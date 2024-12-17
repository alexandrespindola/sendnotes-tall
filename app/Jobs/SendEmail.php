<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Note;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . ':8000/notes/' . $this->note->id;

        $emailContent = "Hello! You have a new note to read. Click here to view it: {$noteUrl}";

        Mail::raw($emailContent, function ($message) {
            $message->from('info@titansmarketing.com.br', 'Sendnotes')
                ->to($this->note->recipient)
                ->subject('You have a new note from ' . $this->note->user->name);
        });
    }
}
