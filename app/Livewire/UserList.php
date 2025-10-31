<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UserList extends Component
{
    public $search = '';
    public $role = 'allrole';

    public function render()
    {
        $users = User::with('modelHasRoles')->get();

        $users = $users->map(function ($user) {
            $lastSeen = $user->last_seen ? Carbon::parse($user->last_seen) : null;
            $user->is_online = $lastSeen && $lastSeen->diffInMinutes(now()) <= 2;
            return $user;
        });

        // Filter berdasarkan role
        if ($this->role != 'allrole') {
            $users = $users->filter(function ($user) {
                return $user->modelHasRoles->contains('role_id', $this->role);
            });
        }

        // Pencarian berdasarkan email
        if (!empty($this->search)) {
            $users = $users->filter(function ($user) {
                return stripos($user->email, $this->search) !== false;
            });
        }

        // Pengurutan berdasarkan status online dan nama
        $users = $users->sortBy(function ($user) {
            return [$user->is_online ? 0 : 1, $user->name];
        });

        return view('livewire.user-list', compact('users'));
    }
}