<?php

namespace App\Livewire\Dashboard;

use App\Models\Comment;
use Livewire\Component;
use Mary\Traits\Toast;

class CommentCard extends Component
{
    use Toast;

    public Comment $comment;

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function deleteComment()
    {
        $this->comment->delete();
        $this->dispatch('comment-deleted');
        $this->success('Comentario eliminado!', position: 'toast-bottom');
    }

    public function render()
    {
        return view('livewire.dashboard.comment-card');
    }
}
