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

                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Order ID</th>
                        <th class="text-end min-w-100px">Created</th>
                        <th class="text-end min-w-125px">Customer</th>
                        <th class="text-end min-w-100px">Total</th>
                        <th class="text-end min-w-100px">Profit</th>
                        <th class="text-end min-w-50px">Status</th>
                        <th class="text-end"></th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                    <tr data-kt-table-widget-4="subtable_template" class="d-none">
                        <td colspan="2">
                            <div class="d-flex align-items-center gap-3">
                                <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                    <img src="" data-kt-src-path="assets/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
                                </a>
                                <div class="d-flex flex-column text-muted">
                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold" data-kt-table-widget-4="template_name">Product name</a>
                                    <div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7">Cost</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">1</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7">Qty</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">1</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7">Total</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total">name</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7 me-3">On hand</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_stock">32</div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGY-346</a>
                        </td>
                        <td class="text-end">7 min ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Albert Flores</a>
                        </td>
                        <td class="text-end">$630.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$86.70</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#YHD-047</a>
                        </td>
                        <td class="text-end">52 min ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
                        </td>
                        <td class="text-end">$25.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$4.20</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SRR-678</a>
                        </td>
                        <td class="text-end">1 hour ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Robert Fox</a>
                        </td>
                        <td class="text-end">$1,630.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$203.90</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#PXF-534</a>
                        </td>
                        <td class="text-end">3 hour ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Cody Fisher</a>
                        </td>
                        <td class="text-end">$119.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$12.00</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGD-249</a>
                        </td>
                        <td class="text-end">2 day ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
                        </td>
                        <td class="text-end">$660.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$52.26</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-035</a>
                        </td>
                        <td class="text-end">2 day ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
                        </td>
                        <td class="text-end">$290.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$29.00</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#SKP-567</a>
                        </td>
                        <td class="text-end">7 min ago</td>
                        <td class="text-end">
                            <a href="#" class="text-gray-600 text-hover-primary">Dan Wilson</a>
                        </td>
                        <td class="text-end">$590.00</td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-bolder">$50.00</span>
                        </td>
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
																			</svg>
																		</span>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="min-w-125px">المستأجر</th>
                        <th class="min-w-125px">الحالة</th>
                        <th class="min-w-125px">بداية العقد</th>
                        <th class="min-w-125px">نهاية العقد</th>
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
                                <!--begin::Checkbox-->
                                <td>
                                    {{ $contract->id }}
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::User=-->
                                <td>
                                    <a href="{{ route('admin.users.details', ['user_id' => $contract->user_id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                        {{ $contract->user->name }}
                                    </a>
                                </td>

                                <!--end::User=-->
                                <!--begin::Role=-->
                                <td>
                                    <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                        {{ $contract->activeStatusString }}
                                    </span>
                                </td>

                                <!--end::Role=-->
                                <!--begin::Joined-->
                                <td>{{ ($contract->start_at)? $contract->start_at->format('Y/m/d') : '-' }}</td>
                                <td>{{ ($contract->end_at)? $contract->end_at->format('Y/m/d') : '-' }}</td>
                                <!--begin::Joined-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}"
                                       class="btn btn-light btn-active-light-primary btn-sm">
                                        <i class="fa-solid fa-gear"></i>
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
