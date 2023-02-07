<div class="row g-6 g-xl-9">
    <!--begin::Col-->
    <div class="col-lg-12">

        <div class="card card-flush h-lg-100">
            <!--begin::Card body-->
            <div class="card-body p-0">
                <!--begin::Wrapper-->
                <div class="card-px text-center py-20 my-10">
                    <!--begin::Title-->
                    <h2 class="fs-2x fw-bold mb-10">
                        إدارة {{ $this->apartment->name }}
                    </h2>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="text-gray-400 fs-4 fw-semibold mb-10">
                        في الوقت الحالي لا يوجد عقد إيجار
                        ل{{ $this->apartment->name }}
                        <br>
                        يمكنك البدء بإجراءات تسجيل عقد إيجار جديد
                    </p>
                    <!--end::Description-->
                    <!--begin::Action-->
                    <a wire:click="showContractNewModal" class="btn btn-primary">تسجيل عقد إيجار جديد</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('admin-assets/media/illustrations/sigma-1/4.png') }}">
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
    <!--end::Col-->

</div>
