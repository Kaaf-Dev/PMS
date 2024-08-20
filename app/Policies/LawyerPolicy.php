<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LawyerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermission('manage_lawyers')
            ? Response::allow()
            : Response::deny('you don’t have access to this page.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Lawyer $lawyer)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Lawyer $lawyer)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Lawyer $lawyer)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Lawyer $lawyer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Lawyer $lawyer)
    {
        //
    }
}
