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
                                    <span class="badge badge-light-{{ $this->contract->active_status_class }}">{{ $this->contract->active_status_string }}</span>
                                </td>
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
                        </table>
                        <!--end::Details-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Section-->

            <!--begin::Title-->
            <h5 class="mb-4">العقارات</h5>
            <!--end::Title-->
            <!--begin::Details-->
            <div class="mb-4">
                <!--begin::Details-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table head-->
                        <thead>
                        <tr>
                            <th class="p-0 w-50px"></th>
                            <th class="p-0 min-w-auto"></th>
                            <th class="p-0 min-w-40px"></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @forelse($this->contract->apartments ?? [] as $selected_apartment)
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px me-2">
                                                        <span class="symbol-label">
                                                            {!! $selected_apartment['icon_svg'] !!}
                                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.property.apartment.details', ['property_id' => $selected_apartment['property']['id'], 'apartment_id' => $selected_apartment['id']]) }}" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                        {{ $selected_apartment['name'] }}
                                    </a>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        {{ $selected_apartment['property']['name'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info">
                                        لا يوجد عقارات محددة بعد!
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->


                </div>
                <!--end::Details-->
            </div>
            <!--end::Details-->

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

            @if($this->show_edit_notes)
                <div class="mb-10">
                    <button wire:click="editNotes" class="btn btn-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                        </svg>
                        تعديل الملاحظات
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
