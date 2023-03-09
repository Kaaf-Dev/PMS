<div class="row g-6 g-xl-9">
    <!--begin::Col-->
    <div class="col-lg-12">
        @if($this->apartment->isRented)
            <!--begin::Card-->
            <div class="card card-flush pt-3 mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">عقد الإيجار</h2>
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <a href="{{ route('admin.contracts.details', ['contract_id' => $this->contract->id]) }}" class="btn btn-light-primary">
                            <i class="fa-solid fa-file-contract"></i>
                            تفاصيل العقد
                        </a>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-3">
                    <!--begin::Section-->
                    <div class="mb-10">
                        <!--begin::Title-->
                        <h5 class="mb-4">المستأجر:</h5>
                        <!--end::Title-->
                        <!--begin::Details-->
                        <div class="mb-4">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-60px symbol-circle me-3">
                                    <img alt="{{ $this->contract->user->name }}" src="{{ $this->contract->user->profilePhotoUrl }}">
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <a href="{{ route('admin.users.details', ['user_id' => $this->contract->user->id]) }}" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">{{ $this->contract->user->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <a href="{{ route('admin.users.details', ['user_id' => $this->contract->user->id]) }}" class="fw-semibold text-gray-600 text-hover-primary">cpr: {{ $this->contract->user->cpr }}</a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap py-5">
                            <!--begin::Row-->
                            <div class="flex-equal me-5">
                                <!--begin::Details-->
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">الحالة:</td>
                                        <td class="text-gray-800">
                                            <span class="badge badge-light-success">فعّال</span>
                                        </td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">رقم الهاتف:</td>
                                        <td class="text-gray-800">{{ $this->contract->user->phone }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">العقار:</td>
                                        <td class="text-gray-800">{{ $this->contract->apartment->name }}</td>
                                    </tr>
                                    <!--end::Row-->
                                </table>
                                <!--end::Details-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="flex-equal">
                                <!--begin::Details-->
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">تاريخ البداية:</td>
                                        <td class="text-gray-800">{{ $this->contract->start_at->format('Y-m') }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">فعّال لغاية:</td>
                                        <td class="text-gray-800">{{ $this->contract->end_at->format('Y-m') }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">الإيجار: </td>
                                        <td class="text-gray-800">{{ $this->contract->cost }}</td>
                                    </tr>
                                    <!--end::Row-->
                                </table>
                                <!--end::Details-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Section-->
                    @if($this->contract->notes)
                        <!--begin::Section-->
                        <div class="mb-10">
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">ملاحظات:</h4>
                                        <div class="fs-6 text-gray-700">
                                            {{ $this->contract->notes }}
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <!--end::Section-->
                    @endif
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <!--begin::Card-->
            @livewire('admin.property.apartment.details.invoices')
            <!--end::Card-->
        @else
            <!--begin::Card-->
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
            <!--end::Card-->
        @endif

    </div>
    <!--end::Col-->

</div>
