<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => true,
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit.prevent="submit" class="space-y-4">
        <x-input wire:model="noteTitle" label="Note Title" placeholder="It's been a day." />
        <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share all your thoughts with your friends." />
        <x-input wire:model="noteRecipient" label="Recipient" type="email" placeholder="yourfriend@gmail.com"
            icon="user" />
        <x-input wire:model="noteSendDate" type="date" label="Send Date" icon="calendar" />
        <div class="pt-4">
            <x-button type="submit" right-icon="calendar" spinner>Schedule Note</x-button>
        </div>
        <x-errors />
    </form>
</div>
