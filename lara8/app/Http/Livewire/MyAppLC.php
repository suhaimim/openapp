<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\MyApp;
use Auth;

class MyAppLC extends Component
{
    use WithPagination;

    public $name, $description, $app_id;
    public $isDialogOpen = 0;

    public function render()
    {
        return view('livewire.myapp.show',
        [
            'myapps' => MyApp::paginate(10),
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
    
        MyApp::updateOrCreate(['id' => $this->app_id], [
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('message', $this->app_id ? 'App updated!' : 'App created!');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $myapp = MyApp::findOrFail($id);
        $this->app_id = $id;
        $this->name = $myapp->name;
        $this->description = $myapp->description;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        MyApp::find($id)->delete();
        session()->flash('message', 'App removed!');
    }        

}
