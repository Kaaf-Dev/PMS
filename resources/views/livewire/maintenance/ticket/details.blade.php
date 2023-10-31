<div>

    <div class="row">
        <!--begin::Aside column-->
        <div class="col-md-4 col-sm-12">

            @livewire('maintenance.ticket.details.finish-ticket-btn', ['ticket' => $this->ticket->id])

            @livewire('maintenance.ticket.details.info', ['ticket' => $this->ticket->id])

            @livewire('maintenance.ticket.details.manage', ['ticket' => $this->ticket->id])

            @livewire('maintenance.ticket.details.create-invoice-btn', ['ticket' => $this->ticket->id])

        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="col-md-8 col-sm-12">
            <!--begin::overview-->
            @livewire('maintenance.ticket.details.overview', ['ticket' => $this->ticket->id])
            <!--end::overview-->
            <!--begin::replies-->
            @livewire('maintenance.ticket.details.replies', ['ticket' => $this->ticket->id])
            <!--end::replies-->

        </div>
        <!--end::Main column-->
    </div>

</div>
