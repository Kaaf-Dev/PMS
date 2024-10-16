<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Contract;
use App\Models\LawyerCase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class LawyerCasePolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LawyerCase  $lawyer_case
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Authenticatable $user, LawyerCase $lawyer_case)
    {
        $allow = false;
        if (Auth::guard('admin')->check()) {
            $allow = true;
        } elseif (Auth::guard('lawyer')->check()) {
            if ($user->id == $lawyer_case->lawyer_id) {
                $allow = true;
            }
        }
        return $allow;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Authenticatable $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LawyerCase  $lawyer_case
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Authenticatable $user, LawyerCase $lawyer_case)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LawyerCase  $lawyer_case
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Authenticatable $user, LawyerCase $lawyer_case)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LawyerCase  $lawyer_case
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Authenticatable $user, LawyerCase $lawyer_case)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LawyerCase  $lawyer_case
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Authenticatable $user, LawyerCase $lawyer_case)
    {
        //
    }

}
