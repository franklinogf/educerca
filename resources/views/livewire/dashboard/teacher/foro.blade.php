<div class="mx-auto max-w-xl">
    <div class="rounded-md bg-base-200/30 p-5 shadow-md">
        <x-mary-input class="mb-2" placeholder="Titulo del post" wire:model='title'></x-mary-input>
        <x-mary-textarea placeholder="Que tienes para compartir?" rows="5" wire:model='content' />
        <x-mary-button :label="!$editMode ? 'Postear' : 'Editar post'" class="btn-primary" icon-right="o-paper-airplane" spinner='savePost'
                       wire:click='savePost' />

        @if ($editMode)
            <x-mary-button label="Cancelar edición" wire:click='cancelEdit' wire:transition.opacity />
        @endif

    </div>
    <div class="mt-5 space-y-5">
        @forelse ($teacherPosts as $post)
            <x-mary-card :subtitle="$post->created_at->diffForHumans()" :title="$post->title" class="rounded-md bg-base-100 shadow-md" separator>
                <p class="line-clamp-3">{!! nl2br($post->content) !!}</p>
                <x-slot:menu>
                    <x-mary-button :link="route('dashboard.foro.post', [$post])" class="btn-circle btn-primary"
                                   icon="o-chat-bubble-bottom-center-text" wire:navigate />
                </x-slot:menu>
                <x-slot:actions>
                    <x-mary-button class="btn-secondary btn-sm" label="Editar" wire:click='edit({{ $post->id }})' />
                    <x-mary-button class="btn-error btn-sm" label="Borrar" wire:click='deletePost({{ $post->id }})'
                                   wire:confirm='Seguro que deseas borrar?' />
                </x-slot:actions>
            </x-mary-card>
        @empty
            <x-mary-alert class="bg-secondary text-secondary-content" icon="o-chat-bubble-bottom-center"
                          title="No tienes posts creados" />
        @endforelse

    </div>
</div>
