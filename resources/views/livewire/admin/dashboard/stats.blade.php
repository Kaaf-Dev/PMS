<div>

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-8">
            @livewire('admin.dashboard.stats.property-rent-overview')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4">
            @livewire('admin.dashboard.stats.property-total')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4">
            @livewire('admin.dashboard.stats.occupancy-overview')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4">
            @livewire('admin.dashboard.stats.rentals-overview')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4">
            @livewire('admin.dashboard.stats.collection-overview')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4">
            @livewire('admin.dashboard.stats.maintenance-overview')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
