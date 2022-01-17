<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Category;
use Auth;

class CategoryLC extends Component
{
    use WithPagination;

    public $name, $description, $category_id;
    public $isDialogOpen = 0;

    public function render()
    {
        // $this->categories = Category::all();
        return view('livewire.category.show',
        [
            'categories' => Category::paginate(10),
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
        $this->name = '';
        $this->description = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required|max:255',
        ]);
    
        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('message', $this->category_id ? 'Category updated!' : 'Category created!');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->description = $category->description;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category removed!');
    }        

}
