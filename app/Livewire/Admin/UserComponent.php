<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    public $user, $activo, $_user;
    public $eliminateMessage, $restaurateMessage, $deleteMessage;
    public $isOpenUserDeletion = false;
    public $isOpenUserDestruction = false;
    public $isOpenUserRestauration = false;
    public  $tip_description, $tip_permission, $historicos;
    
    use WithPagination;

    public function render()
    {
        if ($this->historicos){
            $users = User::onlyTrashed()->orderBy('name')->paginate(8);
        } else {
            $users = User::orderBy('name')->paginate(8);
        }
        return view('livewire.admin.user-component', ['users' => $users]);
    }

    public function confirmUserDeletion(User $user)
    {
        $this->isOpenUserDeletion = $user->id;
    }

    public function confirmUserDestruction($user)
    {
        $this->isOpenUserDestruction = $user;
    }

    public function confirmUserRestauration($user)
    {
        $this->isOpenUserRestauration = $user;
    }

    public function updatedHistoricos()
    {
        $this->resetPage();
        $this->render();
    }
    
}

