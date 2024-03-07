<div class="mx-auto max-w-xl">
    {{-- <x-mary-button :link="Auth::user()->role === 'teacher' ? route('dashboard.teacher.foro') : route('dashboard.parent.foro.posts',[$post->grade])" class="mb-2" icon="o-arrow-left" label="Todos los posts" wire:navigate /> --}}
    <div class="rounded-md bg-base-200/30 p-5">
        <x-mary-card :subtitle="$post->created_at->diffForHumans()" :title="$post->title" class="rounded-md bg-base-300 shadow-md" separator>
            <p class="text-pretty">{!! nl2br($post->content) !!}</p>
        </x-mary-card>

        <div class="mt-5 space-y-5">
            @forelse ($this->comments as $comment)
                <livewire:dashboard.comment-card :$comment :key="$comment->id" @commentDeleted="$refresh" />
            @empty
                <x-mary-alert class="bg-secondary" icon="o-chat-bubble-bottom-center" title="No tienes comentarios" />
            @endforelse
        </div>
        <div class="mt-4">
            {{ $this->comments->links(data: ['scrollTo' => false]) }}
        </div>

        <div class="mt-5">
            <x-mary-textarea placeholder="Que tienes para compartir?" rows="5" wire:model='content' />
            <x-mary-button class="btn-primary" icon-right="o-paper-airplane" label="Comentar" spinner="makeComment"
                           wire:click='makeComment' />
        </div>

    </div>
    <script>
        // fetch(
        //         'https://www.waboxapp.com/api/send/chat?token=498c1c94099837c873fa4f4d8ecd419062068ef8ebacb&uid=19293394306&to=19293394306&custom_uid=msg-0018&text=Hello+dude'
        //     )
        //     .then(data => data.json()).then(json => console.log(json))
    </script>
</div>
