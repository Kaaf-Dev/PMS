<div>

    <div class="row">
        <!--begin::Aside column-->
        <div class="col-md-8 col-sm-12">

            @livewire('lawyer.lawyer-case.details.overview', ['lawyer_case' => $this->lawyer_case->id])

            @livewire('lawyer.contract.details.overview', ['contract' => $this->lawyer_case->contract->id])

            @livewire('lawyer.contract.details.invoices-list', ['contract' => $this->lawyer_case->contract->id])

            @livewire('lawyer.contract.details.replies', ['contract' => $this->lawyer_case->contract->id])

        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="col-md-4 col-sm-12">

            @livewire('lawyer.contract.details.summary', ['contract' => $this->lawyer_case->contract->id])


        </div>
        <!--end::Main column-->
    </div>

</div>
