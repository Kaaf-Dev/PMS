<div>

    <div class="row">
        <!--begin::Aside column-->
        <div class="col-md-8 col-sm-12">

            @livewire('lawyer.contract.details.overview', ['contract' => $this->contract->id])

            @livewire('lawyer.contract.details.invoices-list', ['contract' => $this->contract->id])

            @livewire('lawyer.contract.details.replies', ['contract' => $this->contract->id])

        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="col-md-4 col-sm-12">

            @livewire('lawyer.contract.details.summary', ['contract' => $this->contract->id])


        </div>
        <!--end::Main column-->
    </div>

</div>
