<?php

namespace App\Policies;

use App\Models\MaintenanceInvoice;
use App\Models\MaintenanceInvoiceAttachment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenanceInvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MaintenanceInvoice  $maintenanceInvoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, MaintenanceInvoice $maintenanceInvoice)
    {
        $allow = false;
        if (optional($maintenanceInvoice->ticket)->maintenance_company_id == $user->id) {
            $allow = true;
        }
        return $allow;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MaintenanceInvoice  $maintenanceInvoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, MaintenanceInvoice $maintenanceInvoice)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MaintenanceInvoice  $maintenanceInvoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, MaintenanceInvoice $maintenanceInvoice)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MaintenanceInvoice  $maintenanceInvoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MaintenanceInvoice $maintenanceInvoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MaintenanceInvoice  $maintenanceInvoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MaintenanceInvoice $maintenanceInvoice)
    {
        //
    }
}
