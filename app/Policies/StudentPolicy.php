<?php

namespace App\Policies;

use App\Models\ecole;
use App\Models\User;
use App\Models\eleve;
use Illuminate\Auth\Access\Response;


class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //tout le monde a le droit de voir les eleves 
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, eleve $eleve): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role==='admin';
    }
    public function studentInfo(User $user)
    {
        return $user->role==='admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, eleve $eleve): bool
    {
        return $user->role='admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, eleve $eleve): bool
    {
        return $user->role;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, eleve $eleve): bool
    {
        return $user->role==='admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, eleve $eleve): bool
    {
        return $user->role==='admin';
    }
}
