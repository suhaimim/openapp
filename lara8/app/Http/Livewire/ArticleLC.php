<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Article;
use App\Models\Category;
use App\Http\Livewire\CategoryLC;
use Auth;
// use Image;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleLC extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $category_id, $title, $body, $article_id;
    public $publish, $status;
    public $isDialogOpen = 0;
 
    public $image;
    protected $listeners = ['fileUpload' => 'handleFileUpload'];


    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.article.show',
        [
            'articles' => Article::latest()->paginate(10),
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
        $this->image = '';
        $this->publish = 0;
        $this->status = 0;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|max:200',
            'body' => 'required|min:50',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048',
        ]);

        $this->image = $this->storeImage();
    
        Article::updateOrCreate(['id' => $this->article_id], [
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
            'image' => $this->image,
            'publish' => $this->publish,
            'status' => $this->status,
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
        $this->image = $article->image;
        $this->publish = $article->publish;
        $this->status = $article->status;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Article::find($id)->delete();
        session()->flash('message', 'Article removed!');
    }        

    public function details($id) {
        $article = Article::findOrFail($id);
        return view('livewire.article.details', compact('article'));
    }


    public function handleFileUpload($imageData)
    {
       $this->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048', 
        ]);        
        $this->image = $imageData;
    }  

    public function storeImage()
    {
        if(!$this->image){
            return null;
        }
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $imgName = Str::random().'.jpg';
        Storage::disk('public')->put($imgName, $img);
        return $imgName;
    }      
    
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }


}
