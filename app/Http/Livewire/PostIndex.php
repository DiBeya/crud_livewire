<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostIndex extends Component
{
    use WithFileUploads;
    public $showingPostModel = false;

    public $title;
    public $newImage;
    public $body;
    public $oldImage;
    public $post;
    public $isEditMode = false;

    public function ShowPostModal()
    {
        $this->reset();
        $this->showingPostModel = true;
    }

    public function storePost( ){
        $this->validate([
            'newImage' => 'image',
            'title' => 'required',
            'body' => 'required',
        ]);

        $image =$this->newImage->store('public/posts');
        Post::create([
            'title' => $this->title,
            'imaage' => $image,

            'body' => $this->body,

        ]);
        $this->reset();
        
    }
   
    
    public function ShowEditModal($id)
    {
        $this->post = Post::findOrFail($id);
        $this->title = $this->post->title;
        $this->body = $this->post->body;
        $this->isEditMode = true;
        $this->oldImage = $this->post->image;
        $this->showingPostModel = true;

    }

    function updatePost(){
        $this->validate([
            // 'image' => 'image|max:1024',
            'title' => 'required',
            'body' => 'required',
        ]);
        $image = $this->post->image;
        if($this->newImage){
            $image = $this->newImage->store('public/posts');
        }

        $this->post->update([
            'title' => $this->title,
            'image' =>$image,
            'body' =>$this->body,
        ]);

        $this->reset();
    }

    public function ShowDeleteModal($id){
        $post=Post::findOrFail($id)->delete();
        Storage::delete($post->image);
        $post->delete(); 
        $this->reset();
    }
    public function render()
    {
        return view('livewire.post-index',['posts'=> post::all()]);
    }
}
