<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
{{--                <div class="d-flex align-items-center position-relative my-1">--}}
{{--                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->--}}
{{--                    <span class="svg-icon svg-icon-1 position-absolute ms-6">--}}
{{--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"--}}
{{--                              height="2" rx="1"--}}
{{--                              transform="rotate(45 17.0365 15.1223)"--}}
{{--                              fill="currentColor"/>--}}
{{--                        <path--}}
{{--                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"--}}
{{--                            fill="currentColor"/>--}}
{{--                    </svg>--}}
{{--                </span>--}}
{{--                    <!--end::Svg Icon-->--}}
{{--                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14"--}}
{{--                           placeholder="Search"/>--}}
{{--                </div>--}}
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button wire:click="showAddContract" type="button" class="btn btn-primary" data-bs-toggle="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16"
                                      height="2" rx="1"
                                      transform="rotate(-90 11.364 20.364)"
                                      fill="currentColor"/>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                      fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->تسجيل عقد
                    </button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">

            <div wire:loading.class="table-loading" wire:target="load" class="table-responsive">
                <div class="table-loading-message">
                    الرجاء الإنتظار...
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
                                                <div class="text-gray-800 fw-bold">
                                                    {{ $contract->user->name }}
                                                </div>
                                                <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                                    {{ $contract->activeStatusString }}
                                                </span>
                                            </div>
                                            <div class="text-muted">Expires Dec 2024</div>
                                        </div>
                                        <!--end::Summary-->
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex my-3 ms-9">
                                        <!--begin::Edit-->
                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
																			<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
																				<i class="ki-duotone ki-pencil fs-3">
																					<span class="path1"></span>
																					<span class="path2"></span>
																				</i>
																			</span>
                                        </a>
                                        <!--end::Edit-->
                                        <!--begin::Delete-->
                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </a>
                                        <!--end::Delete-->
                                        <!--begin::More-->
                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="tooltip" title="More Options" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-setting-3 fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-payment-mehtod-action="set_as_primary">Set as Primary</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
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
                                                    <td class="text-muted min-w-125px w-125px">Name</td>
                                                    <td class="text-gray-800">Emma Smith</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Number</td>
                                                    <td class="text-gray-800">**** 5863</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Expires</td>
                                                    <td class="text-gray-800">12/2024</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Type</td>
                                                    <td class="text-gray-800">Mastercard credit card</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Issuer</td>
                                                    <td class="text-gray-800">VICBANK</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">ID</td>
                                                    <td class="text-gray-800">id_4325df90sdf8</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="flex-equal">
                                            <table class="table table-flush fw-semibold gy-1">
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Billing address</td>
                                                    <td class="text-gray-800">AU</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Phone</td>
                                                    <td class="text-gray-800">No phone provided</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Email</td>
                                                    <td class="text-gray-800">
                                                        <a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">Origin</td>
                                                    <td class="text-gray-800">Australia
                                                        <div class="symbol symbol-20px symbol-circle ms-2">
                                                            <img src="assets/media/flags/australia.svg" />
                                                        </div></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted min-w-125px w-125px">CVC check</td>
                                                    <td class="text-gray-800">Passed
                                                        <i class="ki-duotone ki-check-circle fs-2 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i></td>
                                                </tr>
                                            </table>
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


                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="min-w-auto">المستأجر</th>
                        <th class="min-w-auto">الحالة</th>
                        <th class="min-w-auto">التكلفة</th>
                        <th class="min-w-auto">بداية العقد</th>
                        <th class="min-w-auto">نهاية العقد</th>
                        <th class="text-end min-w-100px">العمليات</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">

                    @if($contracts)

                        @forelse($contracts as $contract)
                            <!--begin::Table row-->
                            <tr>

                                <td>
                                    {{ $contract->id }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.users.details', ['user_id' => $contract->user_id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                        {{ $contract->user->name }}
                                    </a>
                                </td>

                                <td>
                                    <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                        {{ $contract->activeStatusString }}
                                    </span>
                                </td>

                                <td>
                                    {{ $contract->cost }}
                                </td>

                                <td>{{ ($contract->start_at)? $contract->start_at->format('Y/m/d') : '-' }}</td>
                                <td>{{ ($contract->end_at)? $contract->end_at->format('Y/m/d') : '-' }}</td>

                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}"
                                       class="btn btn-sm btn-light btn-active-light-primary">
                                        <i class="fa-solid fa-gear"></i>
                                        إدارة
                                    </a>
                                    <a wire:click="showApartments({{ $contract->id }})"
                                       class="btn btn-sm btn-light btn-active-light-primary">
                                        <i class="fa-solid fa-list"></i>
                                        العقارات
                                    </a>
                                </td>
                                <!--end::Action=-->
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

            @if($contracts)
                {{ $contracts->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
