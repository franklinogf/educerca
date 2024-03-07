<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Enums\GuardsEnum;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Computed;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.teacher-dashboard')]
class Foro extends Component
{
    use Toast;

    #[Validate('required|min:3')]
    public string $title = '';

    #[Validate('required|min:5')]
    public string $content = '';

    #[Locked]
    public ?Post $post;

    public bool $editMode = false;


    #[Computed]
    public function teacher()
    {
        return auth(GuardsEnum::Teacher->value)->user();
    }

    public function savePost()
    {
        $this->validate();
        if (!$this->editMode) {
            $this->teacher->posts()->create([
                'title' => $this->title,
                'content' => $this->content,
                'grade_id' => $this->teacher->grade->id,
            ]);

            $this->success(
                'Post creado!',
                timeout: 5000,
                position: 'toast-bottom'
            );
        } else {
            $this->post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->editMode = false;

            $this->success(
                'Post editado',
                timeout: 5000,
                position: 'toast-bottom'
            );
        }

        $this->reset('title', 'content');
    }

    public function deletePost(string $id)
    {
        if ($this->editMode && $id === (string) $this->post->id) {

            $this->error(
                'No puede borrar un post que este editando',
                timeout: 5000,
                position: 'toast-bottom'
            );

        } else {

            Post::find($id)->delete();
        }
    }

    public function cancelEdit()
    {
        $this->post = null;
        $this->editMode = false;
        $this->reset('title', 'content');
    }

    public function edit(string $id)
    {
        $this->post = Post::find($id);
        $this->editMode = true;
        $this->fill($this->post->only(['title', 'content']));
    }

    public function render()
    {
        $teacherPosts = $this->teacher->posts()->orderByDesc('id')->get();
        return view('livewire.dashboard.teacher.foro', ['teacherPosts' => $teacherPosts]);
    }
}
