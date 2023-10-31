<div>
    <!--begin::Row-->
    <div wire:init="load" class="row g-6 g-xl-9">

        <div wire:loading wire:target="load" class="flex-column flex-center">
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                الرجاء الانتظار...
        </div>

        @if ($contracts)
            @forelse($contracts ?? [] as $contract)
                <!--begin::Col-->
                <div wire:key="contract-{{ $contract->id }}" class="col-md-6 col-xl-4">
                    <!--begin::Card-->
                    <a href="{{ route('user.contracts.details', ['contract_id' => $contract->id]) }}" class="card border-hover-primary">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-9">
                            <!--begin::Card Title-->
                            <div class="card-title m-0">
                                <div class="fs-3 fw-bold text-dark">رقم العقد: #{{ $contract->id }}</div>
                            </div>
                            <!--end::Car Title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <span class="badge badge-light-{{ $contract->active_status_class }} fw-bold me-auto px-4 py-3">
                                    {{ $contract->active_status_string }}
                                </span>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end:: Card header-->
                        <!--begin:: Card body-->
                        <div class="card-body p-9">
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap mb-5">
                                <!--begin::Due-->
                                <div class="border border-gray-300 border-dashed rounded w-100 py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ $contract->start_at_human }}</div>
                                    <div class="fw-semibold text-gray-400">بداية العقد</div>
                                </div>
                                <!--end::Due-->
                                <!--begin::Due-->
                                <div class="border border-gray-300 border-dashed rounded w-100 py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ $contract->end_at_human }}</div>
                                    <div class="fw-semibold text-gray-400">تاريخ الانتهاء</div>
                                </div>
                                <!--end::Due-->
                                <!--begin::Budget-->
                                <div class="border border-gray-300 border-dashed rounded w-100 py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ $contract->cost_human }}</div>
                                    <div class="fw-semibold text-gray-400">شهري</div>
                                </div>
                                <!--end::Budget-->
                            </div>
                            <!--end::Info-->

                            <button class="btn btn-primary w-100">
                                <i class="ki-duotone ki-category">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                التفاصيل
                            </button>

                        </div>
                        <!--end:: Card body-->
                    </a>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            @empty
                <div class="col-md-6 col-xl-4">
                    <div class="d-flex flex-column flex-center">
                        <img src="{{ asset('user-assets/media/illustrations/sigma-1/5.png') }}"
                             class="mw-350px">
                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                        <div class="fs-6"></div>
                    </div>
                </div>

            @endif

            {{ $contracts->links() }}

        @endif
    </div>
    <!--end::Row-->
</div>
