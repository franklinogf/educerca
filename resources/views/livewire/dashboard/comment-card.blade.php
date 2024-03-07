<div wire:poll.300s>
    <x-mary-card :subtitle="$comment->created_at->diffForHumans()" :title="auth()->id() === $comment->commentable_id ? 'Tu' : $comment->commentable->full_name" class="rounded-md bg-base-100 shadow-md">
        <p class="line-clamp-3">{!! nl2br($comment->content) !!}</p>
        @if (auth()->id() === $comment->commentable_id)
            <x-slot:actions>
                <x-mary-button class="btn-error btn-sm" label="Borrar" wire:click='deleteComment({{ $comment->id }})'
                               wire:confirm='Seguro que deseas borrarlo?' />
            </x-slot:actions>
        @endif
    </x-mary-card>
</div>
