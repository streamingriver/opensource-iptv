@push('filament-scripts')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>    
@endpush

<div>
    <x-filament::app-header :title="__($title)" />

    <x-filament::app-content>


        <ul wire:sortable="updateTaskOrder">
            @foreach ($channels as $channel)
                <li wire:sortable.item="{{ $channel->id }}" wire:key="task-{{ $channel->id }}" class="cursor-pointer">
                    <h4 wire:sortable.handle>{{ $channel->name }}</h4>
                    {{-- <button wire:click="removeTask({{ $channel->id }})">Remove</button> --}}
                </li>
            @endforeach
        </ul>



    </x-filament::app-content>
</div>
