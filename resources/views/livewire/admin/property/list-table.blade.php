<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
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
                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button wire:click="showPropertyAddModal" type="button" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
															<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
														</svg>
													</span>
                        <!--end::Svg Icon-->إضافة جديد</button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">

            <div wire:loading.class="table-loading" wire:target="load" class="table-responsive">
                <div class="table-loading-message">
                    Loading...
                </div>

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="min-w-125px">العقار</th>
                        <th class="min-w-125px">الوحدات السكنية</th>
                        <th class="min-w-125px">المساحة</th>
                        <th class="min-w-125px">عدد الطوابق</th>
                        <th class="min-w-125px">سنة التأسيس</th>
                        <th class="min-w-125px">نسبة الإشغال</th>
                        <th class="text-end min-w-100px"></th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">

                    @if($properties)

                        @forelse($properties as $property)
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Checkbox-->
                                <td>
                                    {{ $property->id }}
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::User=-->
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.property.details', ['property_id' => $property->id]) }}" class="text-gray-800 text-hover-primary mb-1">{{ $property->name }}</a>
                                        <span>{{ $property->address }}</span>
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <!--end::User=-->
                                <!--begin::apartments_count=-->
                                <td>{{ $property->apartments_count }}</td>
                                <!--end::apartments_count=-->
                                <!--begin::apartments_count=-->
                                <td>{{ $property->area }}</td>
                                <!--end::apartments_count=-->
                                <!--begin::apartments_count=-->
                                <td>{{ $property->floors_count }}</td>
                                <!--end::apartments_count=-->
                                <!--begin::apartments_count=-->
                                <td>{{ $property->construction_date }}</td>
                                <!--end::apartments_count=-->
                                <!--begin::apartments_count=-->
                                <td>
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                        <span class="text-muted me-2 fs-7 fw-bold">
                                            {{ $property->rented_apartments_avg }}%
                                        </span>
                                        </div>

                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $property->rented_apartments_avg }}%" aria-valuenow="{{ $property->rented_apartments_avg }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <!--end::apartments_count=-->
                                <!--begin::Action=-->
                                <td class="text-end">

                                    <a href="{{ route('admin.property.details', ['property_id' => $property->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-3">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
																				<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
																			</svg>
																		</span>
                                        <!--end::Svg Icon-->
                                    </a>

                                </td>
                                <!--end::Action=-->
                            </tr>
                            <!--end::Table row-->
                        @empty
                            <tr>
                                <td colspan="100%">

                                    <div class="d-flex flex-column flex-center">
                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-350px">
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

            @if($properties)
                {{ $properties->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>

@push('modals')
    <!--begin::Modal - Create Property-->
    <div class="modal fade" id="kt_modal_property_add" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    @livewire('admin.property.create-form')
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Property-->
@endpush

@push('js')
    <script>
        const modalEl = document.getElementById('kt_modal_property_add');
        const modal = new bootstrap.Modal(modalEl);

        Livewire.on('show-property-add-modal', () => {
            modal.show();
        })

        Livewire.on('hide-property-add-modal', () => {
            modal.hide();
        })
    </script>

@endpush
