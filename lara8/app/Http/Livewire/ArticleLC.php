<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use App\Http\Livewire\CategoryLC;
use Auth;

class ArticleLC extends Component
{
    use WithPagination;

    public $category_id, $title, $body, $article_id;
    public $isDialogOpen = 0;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.article.show',
        [
            'articles' => Article::paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isDialogOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isDialogOpen = false;
    }

    private function resetCreateForm(){
        $this->title = '';
        $this->body = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required|min:100',
        ]);
    
        Article::updateOrCreate(['id' => $this->article_id], [
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('message', $this->article_id ? 'Article updated!' : 'Article created!');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->category_id = $article->category_id;
        $this->title = $article->title;
        $this->body = $article->body;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Article::find($id)->delete();
        session()->flash('message', 'Article removed!');
    }        

}
