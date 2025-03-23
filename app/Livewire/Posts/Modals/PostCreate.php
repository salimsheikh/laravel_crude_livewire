<?php

namespace App\Livewire\Posts\Modals;

use Livewire\Component;
use App\Models\Post;
use Flux;

class PostCreate extends Component
{
    public $title, $content;

    public function render()
    {
        return view('livewire.posts.modals.post-create');
    }

    public function submit(){

        $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Post::create([
            'title'=> $this->title,
            'content' => $this->content,
        ]);

        $this->resetForm();

        Flux::modal('post-create')->close();

        $this->dispatch("reloadPosts");
    }

    private function resetForm(){
        $this->title = "";
        $this->content = "";
    }
}
