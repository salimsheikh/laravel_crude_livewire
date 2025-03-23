<?php

namespace App\Livewire\Posts\Models;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux;

class PostEdit extends Component
{
    public $title = "";
    public $content = "";
    public $postId = "";

    public function render()
    {
        return view('livewire.posts.models.post-edit');
    }

    #[On('editPost')]
    public function editPost($id){
        $post = Post::find($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        Flux::modal("post-edit")->show();
    }

    public function update(){
        $this->validate([
            'title'=> 'required',
            'content'=> 'required',
        ]);

        $post = Post::find($this->postId);
        $post->title = $this->title;
        $post->content = $this->content;
        $post->save();

        Flux::modal("post-edit")->close();

        $this->dispatch('reloadPosts');

    }
}
