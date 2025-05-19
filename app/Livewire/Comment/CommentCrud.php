<?php

namespace App\Livewire\Comment;
use Livewire\Attributes\Layout;
use App\Models\Comment;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use App\Livewire\Comment\Forms\CommentForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class CommentCrud extends Component
{

        
    /*
    Buat CRUD menggunakan
    - Locked Properties
    - URL Query Parameters
    - Forms
    - Validation
    */

    use \Mary\Traits\Toast;


    #[Locked] 
    public $id;

    public CommentForm $masterForm;

    public function mount()
    {
       if($this->id){
        $this->edit();
       }else{
        $this->create();
       }
    }

    public function create()
    {
        $this->masterForm->reset();

    }

    public function store()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $comments = Comment::create([
            'name' => $validatedForm['name'],
            'detail' => $validatedForm['detail'],
        ]);

        if($comments){
            $this->success('Comment berhasil ditambahkan');
            $this->dispatch('comment-created');
        }else{
            $this->success('Comment gagal ditambahkan');
        }

    }

    public function edit()
    {
        $comment = Comment::findOrFail($this->id);
        $this->masterForm->name = $comment->name;
        $this->masterForm->detail = $comment->detail;
    }

    public function update()
    {
        $validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];
        
        $comment = Comment::findOrFail($this->id);

        $updated = $comment->update($validatedForm);
    
        if ($updated) {
            $this->success('Comment berhasil diupdate');
            $this->dispatch('comment-updated');
        } else {
            $this->error('Comment gagal diupdate');
        }

    }

    public function render()
    {
        return view('livewire.comment.comment-crud');
    }
}
