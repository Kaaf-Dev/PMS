<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\LawyerCase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ContractPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Authenticatable $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Authenticatable $user, Contract $contract)
    {
        return $this->ownContract($user, $contract);
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Authenticatable $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Authenticatable $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Authenticatable $user, Contract $contract)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Authenticatable $user, Contract $contract)
    {
        //
    }

    public function reply(Authenticatable $user, Contract $contract)
    {
        return $this->ownContract($user, $contract);
    }

    /**
     * @param Authenticatable $user
     * @param Contract $contract
     * @return bool
     */
    protected function ownContract(Authenticatable $user, Contract $contract): bool
    {
        $allow = false;
        if (Auth::guard('admin')->check()) {
            $allow = true;

        } elseif (Auth::guard('lawyer')->check()) {
            $hasContract = LawyerCase::where('lawyer_id', $user->id)
                ->where('contract_id', $contract->id)
                ->exists();

            if ($hasContract) {
                $allow = true;
            }

        } elseif ($user->id === $contract->user_id) {
            $allow = true;
        }

        return $allow;
    }
}
