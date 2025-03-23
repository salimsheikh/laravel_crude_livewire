<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;
use Flux\flux;

class Posts extends Component
{
    public $posts, $postId;

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

    public function edit($id){
        $this->dispatch('editPost',$id);
    }

    public function delete($id){

        $this->postId = $id;
        Flux::modal('post-delete')->show();
    }

    public function destroy(){

        Post::find($this->postId)->delete();
        Flux::modal('post-delete')->close();
        $this->dispatch('reloadPosts');
    }
}
