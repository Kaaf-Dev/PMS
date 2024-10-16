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
                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="بحث" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3" >
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex  btn-info btn-active-color-white fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>بحث</a>
                        <!--end::Menu toggle-->

                        <!--begin::Menu toggle-->
                        <button wire:click="exportExcel" class="btn btn-sm btn-flex  btn-success btn-active-color-white fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-file-up fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>تصدير</button>
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
                                    <label class="form-label fw-semibold">الفئة:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="category_id" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac4061cc0f" data-allow-clear="true">
                                            <option label="الجميع"></option>
                                            <option value="1">كاف</option>
                                            <option value="2">جمعية الإصلاح</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">العقار:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model.defer="property_id" id="property_id" class="form-select form-select-solid select-multi" data-kt-select2="true" data-placeholder="الجميع" data-allow-clear="true">
                                            <option label="الجميع"></option>
                                            @foreach($properties as $property)
                                                <option value="{{$property->id}}">{{$property->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">التصنيف:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="type_id" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac4061cc0f" data-allow-clear="true">
                                            <option label="الجميع"></option>
                                            <option value="1">شقة</option>
                                            <option value="2">محل تجاري</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">الحالة:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="status" class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac4061cc0f" data-allow-clear="true">
                                            <option label="الجميع"></option>
                                            <option value="1">مؤجر</option>
                                            <option value="2">متاح للتأجير</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                {{--                                <!--begin::Actions-->--}}
                                {{--                                <div class="d-flex justify-content-end">--}}
                                {{--                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>--}}
                                {{--                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>--}}
                                {{--                                </div>--}}
                                {{--                                <!--end::Actions-->--}}
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
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
                    Loading...
                </div>

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="min-w-125px">الفئة</th>
                        <th class="min-w-125px">الوحدة السكنية</th>
                        <th class="min-w-125px">العقار</th>
                        <th class="min-w-125px">الحالة</th>
                        <th class="min-w-125px">قيمة الاجار</th>
                        <th class="min-w-125px">عدد الغرف</th>
                        <th class="min-w-125px">عدد دورات المياة</th>
                        <th class="text-end min-w-100px"></th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">

                    @if($apartments)

                        @forelse($apartments as $apartment)
                            <!--begin::Table row-->
                            <tr>
                                <td>
                                    {{ $apartment->id }}
                                </td>
                                <td>
                                    {{ $apartment->TypeString }}
                                </td>
                                <!--begin::Property=-->
                                <td>
                                    <a href="{{ route('admin.property.apartment.details', ['property_id' => $apartment->property_id,'apartment_id' => $apartment->id]) }}"
                                       class="text-gray-800 text-hover-primary mb-1">{{ $apartment->name }}</a>
                                </td>
                                <!--end::Property-->

                                <!--begin::Property=-->
                                <td>

                                    <a href="{{ route('admin.property.details', ['property_id' => $apartment->property_id]) }}"
                                       class="text-gray-800 text-hover-primary mb-1">{{ $apartment->Property->name ?? '' }}</a>

                                </td>
                                <!--end::Property-->
                                <!--begin::category=-->
                                <td>{{ $apartment->ContractActiveStatusString }}</td>
                                <!--end::category-->
                                <!--begin::category=-->
                                <td>{{ $apartment->cost }} دب</td>
                                <!--end::category-->
                                <!--begin::category=-->
                                <td>{{ $apartment->rooms_count }} </td>
                                <!--end::category-->
                                <!--begin::category=-->
                                <td>{{ $apartment->bathrooms_count }} </td>
                                <!--end::category-->

                                <!--begin::Action=-->
                                <td class="text-end">

                                    <a href="{{ route('admin.property.apartment.details', ['property_id' => $apartment->property_id, 'apartment_id' =>  $apartment->id]) }}"
                                       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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

            @if($apartments)
                {{ $apartments->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
@push('js')
    <script>
        document.addEventListener('livewire:load', function (event) {
            window.Livewire.hook('message.processed', () => {
                $('.select-multi').select2();

                $('#property_id').on('change', function (e) {
                    let elementName = $(this).attr('id');
                    var data = $(this).select2("val");
                @this.set(elementName, data);
                });
            });
        });
    </script>
@endpush
