<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')]
class extends Component {
    public Note $note;
    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
    }
}; ?>

<div class="flex flex-col space-y-2">
    <p>{{ $note->title }}</p>
    <p>{{ $note->body }}</p>
    <p>{{ $note->user->email }}</p>
    <p>{{ $note->recipient }}</p>
    <p>{{ $note->id }}</p>
</div>
