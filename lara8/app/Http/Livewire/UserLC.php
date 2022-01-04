<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use Auth;

class UserLC extends Component
{
    use WithPagination;

    public $name, $description, $category_id;
    public $isDialogOpen = 0;

    public function render()
    {
        // $this->teams = Teams::all();
        return view('livewire.users.show',
        [
            'users' => User::paginate(10),
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
        $this->email = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
    
        User::updateOrCreate(['id' => $this->id], [
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', $this->id ? 'User updated!' : 'User created!');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User removed!');
    }        

}
