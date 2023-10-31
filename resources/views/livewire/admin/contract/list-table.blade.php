<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 d-flex justify-content-between">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="بحث" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Actions-->
                <div class="d-flex gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex  btn-info btn-active-color-white fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>بحث</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac4061cc0f">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">خيارات البحث</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">حالة العقد:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="active_status" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac4061cc0f" data-allow-clear="true">
                                            <option label="الجميع"></option>
                                            <option value="1">فعال</option>
                                            <option value="2">عقد منتهي</option>
                                            <option value="3">غير فعال</option>
                                            <option value="4">محول الى المحامي</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <button wire:click="showAddContract" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">
                         <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        تسجيل عقد
                    </button>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">

            <div wire:loading.class="table-loading" wire:target="load" class="table-responsive">
                <div class="table-loading-message">
                    الرجاء الانتظار...
                </div>

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    @if($contracts)

                        @forelse($contracts as $contract)
                            <!--begin::Option-->
                            <div class="py-0">
                                <!--begin::Header-->
                                <div class="py-3 d-flex flex-stack flex-wrap">
                                    <!--begin::Toggle-->
                                    <div class="d-flex align-items-center collapsible rotate" data-bs-toggle="collapse" href="#contract_apartment_list_{{ $contract->id }}" role="button" aria-expanded="false" aria-controls="contract_apartment_list_{{ $contract->id }}">
                                        <!--begin::Arrow-->
                                        <div class="me-3 rotate-90">
                                            <i class="ki-duotone ki-right fs-3"></i>
                                        </div>
                                        <!--end::Arrow-->
                                        <!--begin::Summary-->
                                        <div class="me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-gray-800 fw-bold me-2">
                                                    {{ $contract->user->name }}
                                                </div>
                                                <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                                    {{ $contract->activeStatusString }}
                                                </span>
                                            </div>
                                            <div class="text-muted">#{{ $contract->id }}</div>
                                        </div>
                                        <!--end::Summary-->
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex my-3 ms-9">
                                        <!--begin::Edit-->
                                        <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
                                                <i class="ki-duotone ki-pencil fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </a>
                                        <!--end::More-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div id="contract_apartment_list_{{ $contract->id }}" class="collapse fs-6 ps-10" data-bs-parent="#contract_apartment_list_{{ $contract->id }}">
                                    <!--begin::Details-->
                                    <div class="d-flex flex-wrap py-5">
                                        <!--begin::Col-->
                                        <div class="flex-equal me-5">
                                            <table class="table table-flush fw-semibold gy-1">
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">المستأجر</td>
                                                    <td class="text-gray-800">{{ $contract->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">الإيجار</td>
                                                    <td class="text-gray-800">{{ $contract->cost }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="flex-equal">
                                            <table class="table table-flush fw-semibold gy-1">
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">بداية العقد</td>
                                                    <td class="text-gray-800">{{ ($contract->start_at)? $contract->start_at->format('Y/m/d') : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">نهاية العقد</td>
                                                    <td class="text-gray-800">{{ ($contract->end_at)? $contract->end_at->format('Y/m/d') : '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="d-flex flex-wrap py-5">
                                        <!--begin::Col-->
                                        <div class="flex-equal me-5">

                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                                <!--begin::Table head-->
                                                <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        #
                                                    </th>
                                                    <th class="min-w-auto">العقار</th>
                                                    <th class="min-w-auto">الوحدة</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="text-gray-600 fw-semibold">

                                                @if($contract->apartments)

                                                    @forelse($contract->apartments as $apartment)
                                                        <!--begin::Table row-->
                                                        <tr>

                                                            <td>
                                                                {{ $apartment->id }}
                                                            </td>

                                                            <td>
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    {!! $apartment->icon_svg !!}
                                                                </div>
                                                                <a href="{{ route('admin.property.details', ['property_id' => $apartment->property->id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                                                    {{ $apartment->property->name }}
                                                                </a>
                                                            </td>

                                                            <td>
                                                                <a href="{{ route('admin.property.apartment.details', ['property_id' => $apartment->property->id, 'apartment_id' => $apartment->id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                                                    {{ $apartment->name }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!--end::Table row-->
                                                    @empty
                                                        <tr>
                                                            <td colspan="100%">

                                                                <div class="d-flex flex-column flex-center">
                                                                    <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                                                         class="mw-350px">
                                                                    <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                                                    <div class="fs-6"></div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                @endif

                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->

                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Option-->
                            <div class="separator separator-dashed"></div>
                        @empty
                            <tr>
                                <td colspan="100%">

                                    <div class="d-flex flex-column flex-center">
                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                             class="mw-350px">
                                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                        <div class="fs-6"></div>
                                    </div>


                                </td>
                            </tr>
                        @endforelse
                    @endif
                </div>
                <!--end::Card body-->
            </div>

            @if($contracts)
                {{ $contracts->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
