<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch('note-saved');

        /* redirect(route('notes.index')); */
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Notes') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit="saveNote" class="space-y-4">
            <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a day." />
            <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share all your thoughts with your friends."
                rows="12" />
            <x-input wire:model="noteRecipient" label="Recipient" type="email" placeholder="yourfriend@gmail.com"
                icon="user" />
            <x-input wire:model="noteSendDate" type="date" label="Send Date" icon="calendar" />
            <x-checkbox label="Note Published" wire:model="noteIsPublished">Published</x-checkbox>
            <div class="flex flex-row justify-between pt-2">
                <x-button type="submit" spinner="saveNote">Save Note</x-button>
                <x-button href="{{ route('notes.index') }}" flat secondary>Back to Notes</x-button>
            </div>
            <x-action-message on="note-saved" />
            <x-errors />
        </form>
    </div>
</div>
