<?php

use Livewire\Volt\Component;
use Carbon\Carbon;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div class="space-y-4">
    @if ($notes->isEmpty())
        <div class="text-center text-gray-500">
            <p class="text-xl font-bold">No notes found</p>
            <p class="text-sm">Let's create your firt note to send.</p>
            <x-button primary right-icon="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create
                Note</x-button>
        </div>
    @else
        <x-button primary right-icon="plus" class="mt-6 mb-8" href="{{ route('notes.create') }}" wire:navigate>Create
            Note</x-button>
        <div class="grid grid-cols-3 gap-4 mt-12">
            @foreach ($notes as $note)
                <x-card wire:key='card-{{ $note->id }}'>
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <a href='#'
                                class="text-xl font-bold hover:underline hover:text-blue-500">{{ $note->title }}</a>
                            <p class="mt-2 text-sm">{{ Str::limit($note->body, 50, '...') }}</p>
                        </div>
                        <div class='text-xs text-gray-500'>
                            {{ Carbon::createFromFormat('Y-m-d', $note->send_date)->format('d-m-Y') }}
                        </div>
                    </div>
                    <div class="flex flex-row justify-between mt-4 space-x-1 items">
                        <p class='text-xs'>Recipient: <span class="font-semibold">{{ $note->recipient }} </span></p>
                        <div>
                            <x-mini-button rounded slate icon="eye"></x-mini-button>
                            <x-mini-button rounded slate icon="trash"></x-mini-button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</div>
