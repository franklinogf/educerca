<x-layouts.parent-dashboard>
    <div class="mt-5 space-y-5">
        @forelse ($posts as $post)
            <x-mary-card :subtitle="$post->created_at->diffForHumans()" :title="$post->title" class="rounded-md bg-base-100 shadow-md" separator>
                <p class="line-clamp-3">{{ $post->content }}</p>
                <x-slot:menu>
                    <x-mary-button :link="route('dashboard.foro.post', [$post])" class="btn-circle btn-primary"
                                   icon="o-chat-bubble-bottom-center-text" wire:navigate />
                </x-slot:menu>
            </x-mary-card>
        @empty
            <x-mary-alert class="bg-secondary" icon="o-chat-bubble-bottom-center" title="No se econtraron posts" />
        @endforelse

    </div>
</x-layouts.parent-dashboard>
