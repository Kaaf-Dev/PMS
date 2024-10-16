<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return $admin->hasPermission('manage_tickets')
            ? Response::allow()
            : Response::deny('you don’t have access to this page.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Authenticatable $user, Ticket $ticket)
    {
        $allow = false;

        if (Auth::guard('admin')->check()) {
            $allow = true;

        } elseif (Auth::guard('maintenance_company')->check()) {
            if ($user->tickets->contains($ticket)) {
                $allow = true;
            }

        } elseif ($user->tickets->contains($ticket)) {
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
    public function create(Authenticatable $user)
    {

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Authenticatable $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Authenticatable $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Authenticatable $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Authenticatable $user, Ticket $ticket)
    {
        //
    }

    public function cancel(Authenticatable $user, Ticket $ticket)
    {
        $allow = false;

        if (Auth::guard('admin')->check()) {
            $allow = true;

        } elseif ($user->tickets->contains($ticket)) {
            if ($ticket->cancelable) {
                $allow = true;
            }
        }

        return $allow;
    }

    public function reply(Authenticatable $user, Ticket $ticket)
    {
        $allow = false;

        if (Auth::guard('admin')->check()) {
            $allow = true;

        } elseif ($user->tickets->contains($ticket)) {
            if ($ticket->repliable) {
                $allow = true;
            }
        }

        return $allow;
    }

    public function finish(Authenticatable $user, Ticket $ticket)
    {
        $allow = false;

        if (Auth::guard('admin')->check()) {
            $allow = true;

        } else {
            $allow = $ticket->finishable;
        }

        return $allow;

    }

    public function createInvoice($user, Ticket $ticket)
    {
        $allow = false;
        if (Auth::guard('admin')->check()) {
            $allow = true;

        } elseif (Auth::guard('maintenance_company')->check()) {
            if ($user->tickets->contains($ticket)) {
                $allow = true;
            }
        }
        return $allow;
    }
}
