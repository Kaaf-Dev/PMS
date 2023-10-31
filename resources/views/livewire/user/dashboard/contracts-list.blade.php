<div wire:init="fetch" class="h-xl-100">
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">
                    عقود الإيجار
                </span>
                <a href="{{ route('user.contracts') }}" class="text-gray-400 mt-1 fw-semibold fs-6 mt-2">عرض الجميع</a>
            </h3>
            <!--end::Title-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2"></i>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5">
            <!--begin::Items-->
            <div class="">
                @forelse($contracts as $contract)
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center me-5">
                            <!--begin::Flag-->
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label bg-light-{{ $contract->active_status_class }}">
                                    <i class="fas fa-building fs-2x text-{{ $contract->active_status_class }}"></i>
                                </span>
                            </div>
                            <!--end::Flag-->
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="{{ route('user.contracts.details',['contract_id' => $contract->id]) }}" class="text-gray-800 fw-bold text-hover-primary fs-6">رقم العقد: {{ $contract->id }}</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">{{ $contract->costHuman }}</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center">
                            <!--begin::Info-->
                            <div class="m-0">
                                <!--begin::Label-->
                                <span class="badge badge-light-{{ $contract->active_status_class }} fs-base">
                                    {{ $contract->active_status_string }}
                                </span>
                                <!--end::Label-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Item-->
                    @if(!$loop->last)
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                    @endif

                @empty
                    @if (empty($contracts))
                        الرجاء الانتظار...
                    @else
                        لا يوجد بيانات
                    @endif
                @endforelse

            </div>
            <!--end::Items-->
        </div>
        <!--end: Card Body-->
    </div>
</div>
