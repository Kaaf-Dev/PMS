<div>
    <div class="card card-flush pt-3 mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">عقد الإيجار</h2>
            </div>
            <!--end::Card title-->
            @if($this->show_contract_link)
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <a href="{{ route('admin.contracts.details', ['contract_id' => $this->contract->id]) }}" class="btn btn-light-primary">
                        <i class="fa-solid fa-file-contract"></i>
                        تفاصيل العقد
                    </a>
                </div>
                <!--end::Card toolbar-->
            @endif

        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-3">
            <!--begin::Section-->
            <div class="mb-10">
                @if($this->show_user)
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
                @endif
                <!--begin::Details-->
                <div class="d-flex flex-wrap pb-2">
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
            @if($this->show_notes and $this->contract->notes)
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
    </div>
</div>
