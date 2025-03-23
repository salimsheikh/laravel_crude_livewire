<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;

class Posts extends Component
{
    public $posts;

    public function mount(){
        $this->posts = Post::latest()->get();
    }

    public function render()
    {
        return view('livewire.posts.posts');
    }

    #[On('reloadPosts')]
    public function reloadPosts(){
        $this->posts = Post::latest()->get();
    }
}
