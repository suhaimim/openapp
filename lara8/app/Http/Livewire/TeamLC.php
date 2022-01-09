<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Team;
use Auth;

class TeamLC extends Component
{
    use WithPagination;

    public $name, $team_id;
    public $personal = 0;
    public $isDialogOpen = 0;

    public function render()
    {
        // $this->teams = Teams::all();
        return view('livewire.team.show',
        [
            'teams' => Team::paginate(10),
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
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
    
        Team::updateOrCreate(['id' => $this->team_id], [
            'name' => $this->name,
            'user_id' => Auth::user()->id,
            'personal_team' => $this->personal,
        ]);

        session()->flash('message', $this->team_id ? 'Team updated!' : 'Team created!');

        $this->closeModalPopover();
        $this->resetCreateForm();
        return back();
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $this->team_id = $id;
        $this->name = $team->name;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Team::find($id)->delete();
        session()->flash('message', 'Team removed!');
    }        

}
