<div>
    <!--begin::Stepper-->
    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">

        @if ($this->contract_id)

            <div class="w-100">
                <!--begin::Heading-->
                <div class="pb-12 text-center">
                    <!--begin::Title-->
                    <h1 class="fw-bold text-dark">تم تسجيل العقد بنجاح</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-4">يمكنك الآن الاطلاع على العقد.</div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Actions-->
                <div class="d-flex flex-center pb-20">
                    <button wire:click="closeMe" type="button" class="btn btn-lg btn-light me-3" data-kt-element="complete-start">إنهاء</button>
                    <a href="{{ route('admin.contracts.details', ['contract_id' => $this->contract_id]) }}" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" data-bs-original-title="Coming Soon" data-kt-initialized="1">الانتقال إلى العقد</a>
                </div>
                <!--end::Actions-->
                <!--begin::Illustration-->
                <div class="text-center px-4">
                    <img src="{{ asset('admin-assets/media/illustrations/unitedpalms-1/19.png') }}" alt="" class="mww-100 mh-350px">
                </div>
                <!--end::Illustration-->
            </div>

        @else

            <!--begin::Aside-->
            <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                <!--begin::Nav-->
                <div class="stepper-nav ps-lg-10">
                    <!--begin::Step 1-->
                    <div class="stepper-item
                    @if($step_no == 1)
                        current
                    @elseif ($step_no > 1)
                        completed
                    @endif
                    " data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">العقار</h3>
                                <div class="stepper-desc">تحديد العقار</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Step 2-->
                    <div class="stepper-item
                    @if($step_no == 2)
                        current
                    @elseif ($step_no > 2)
                        completed
                    @endif
                ">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <!--begin::Icon-->
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">المستأجر</h3>
                                <div class="stepper-desc">اختيار المستأجر</div>
                            </div>
                            <!--begin::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 2-->
                    <!--begin::Step 3-->
                    <div class="stepper-item
                    @if($step_no == 3)
                        current
                    @elseif ($step_no > 3)
                        completed
                    @endif
                ">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">3</span>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">العقد</h3>
                                <div class="stepper-desc">تحديد بنود العقد</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 4-->
                    <div class="stepper-item
                    @if($step_no == 4)
                        current
                    @elseif ($step_no > 4)
                        completed
                    @endif
                ">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">4</span>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">الإكمال</h3>
                                <div class="stepper-desc">مراجعة العقد والاعتماد</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 4-->
                </div>
                <!--end::Nav-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid py-lg-5 px-lg-15">
                <!--begin::Form-->
                <div class="form">

                    @if($step_no == 1)
                        <!--begin::Step 1-->
                        <div class="current">
                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold">
                                    <span class="required">العقار:</span>
                                </label>
                                @error('selected_property')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!--end::Label-->
                                @if($selected_property)
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                                        <div class="d-flex align-items-center p-3 mb-2">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <a href="{{ route('admin.property.details', ['property_id' => $selected_property->id]) }}" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                                    {{ $selected_property->name }}
                                                </a>
                                                <!--end::Name-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Button-->
                                            <a wire:click="selectProperty()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <!--end::Button-->
                                        </div>

                                    </div>
                                @else
                                    <div class="w-100">
                                        <div class="text-gray-500 fw-semibold fs-5">يمكنك البحث ضمن قائمة العقارات:</div>

                                        <div class="w-100 position-relative my-5" autocomplete="off">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
										<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
									</svg>
								</span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Input-->
                                            <input wire:model="search_property" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="البحث عن العقارات من خلال الاسم…">
                                            <!--end::Input-->
                                            <!--begin::Spinner-->
                                            <span wire:loading.class.remove="d-none" wire:target="search_property" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                                <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                            </span>
                                            <!--end::Spinner-->
                                            <!--begin::Reset-->
                                            <span wire:click="clearSearchProperty" wire:loading.remove wire:target="search_property" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search_property) d-none @endif">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                                <!--end::Svg Icon-->
                            </span>
                                            <!--end::Reset-->
                                        </div>

                                        <div class="mh-475px scroll-y me-n7 pe-7">

                                            @forelse($properties ?? [] as $property)
                                                <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Details-->
                                                        <div class="ms-6">
                                                            <!--begin::Name-->
                                                            <a href="{{ route('admin.property.details', ['property_id' => $property->id]) }}" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">
                                                                {{ $property->name }}
                                                            </a>
                                                            <!--end::Name-->
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Stats-->
                                                    <div class="d-flex">
                                                        <!--begin::Sales-->
                                                        <div class="text-end">
                                                            <a wire:click="selectProperty('{{ $property->id }}')" class="btn btn-sm btn-primary">اختيار</a>
                                                        </div>
                                                        <!--end::Sales-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Property-->
                                            @empty
                                                <div class="d-flex flex-column flex-center">
                                                    <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-250px">
                                                    <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                                    <div class="fs-6"></div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row">
                                @if($selected_property)
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold">
                                        <span class="required">الوحدة:</span>
                                    </label>
                                    @error('selected_apartment')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Label-->

                                    @if($selected_apartment)

                                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                                            <div class="d-flex align-items-center p-3 mb-2">
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Name-->
                                                    <a href="{{ route('admin.property.details', ['property_id' => $selected_apartment->id]) }}" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                                        {{ $selected_apartment->name }}
                                                    </a>
                                                    <!--end::Name-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Button-->
                                                <a wire:click="selectApartment()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!--end::Button-->
                                            </div>

                                        </div>

                                    @else
                                        <div class="w-100">
                                            <div class="text-gray-500 fw-semibold fs-5 my-4">يمكنك البحث ضمن القائمة المتاحة:</div>

                                            <div class="w-100 position-relative mb-5" autocomplete="off">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Input-->
                                                <input wire:model="search_apartment" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="البحث عن الوحدات السكنية…">
                                                <!--end::Input-->
                                                <!--begin::Spinner-->
                                                <span wire:loading.class.remove="d-none" wire:target="search_apartment" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                        </span>
                                                <!--end::Spinner-->
                                                <!--begin::Reset-->
                                                <span wire:click="clearSearchApartment" wire:loading.remove wire:target="search_apartment" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search_apartment) d-none @endif">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                                    <!--end::Svg Icon-->
                                        </span>
                                                <!--end::Reset-->
                                            </div>

                                            <div class="mh-350px scroll-y me-n7 pe-7">

                                                @forelse($apartments ?? [] as $apartment)

                                                    <!--begin::Apartment-->
                                                    <div class="border border-hover-primary p-7 rounded mb-7 @if($apartment->is_rented) bg-light-danger @endif">
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pb-3">
                                                            <!--begin::Info-->
                                                            <div class="d-flex">
                                                                <!--begin::Avatar-->
                                                                <div class="symbol symbol-circle symbol-45px">
                                                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                                {!! $apartment->icon_svg !!}
                                                            </span>
                                                                </div>
                                                                <!--end::Avatar-->
                                                                <!--begin::Details-->
                                                                <div class="ms-5">
                                                                    <!--begin::Name-->
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="{{ route('admin.property.apartment.details', ['property_id' => $selected_property->id, 'apartment_id' => $apartment->id]) }}" class="text-dark fw-bold text-hover-primary fs-5 me-4">
                                                                            {{ $apartment->name }}
                                                                        </a>
                                                                        <!--begin::Label-->
                                                                        <span class="badge badge-light-{{ $apartment->contractActiveStatusClass }} d-flex align-items-center fs-8 fw-semibold">
                                                                            {{ $apartment->contractActiveStatusString }}
                                                                        </span>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Name-->
                                                                    <!--begin::Desc-->
                                                                    <span class="text-muted fw-semibold mb-3">
                                                                {{ $apartment->type_string }}
                                                            </span>
                                                                    <!--end::Desc-->
                                                                </div>
                                                                <!--end::Details-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Stats-->
                                                            <div clas="d-flex">
                                                                <!--begin::Price-->
                                                                <div class="text-end pb-3">
                                                                    <span class="text-dark fw-bold fs-5">{{ $apartment->cost }}</span>
                                                                    <span class="text-muted fs-7">/شهري</span>
                                                                </div>
                                                                <!--end::Price-->
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::Info-->
                                                        <!--begin::Wrapper-->
                                                        <div class="p-0">
                                                            <!--begin::Section-->
                                                            <div class="d-flex flex-column">
                                                                <!--begin::Tags-->
                                                                <div class="d-flex text-gray-700 fw-semibold fs-7">
                                                                    <!--begin::Tag-->
                                                                    <span class="border border-2 rounded me-3 p-1 px-2">

                                                                <span class="svg-icon svg-icon-2x svg-icon-gray-600 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M17 7V17H7V7H17ZM20 3H4C3.4 3 3 3.4 3 4V20C3 20.6 3.4 21 4 21H20C20.6 21 21 20.6 21 20V4C21 3.4 20.6 3 20 3Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>

                                                                {{ $apartment->area }}

                                                            </span>
                                                                    <!--end::Tag-->

                                                                    @if($apartment->is_type_house)
                                                                        <!--begin::Tag-->
                                                                        <span class="border border-2 rounded me-3 p-1 px-2">

                                                                <span class="svg-icon svg-icon-2x svg-icon-gray-600 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                                    </svg>
                                                                </span>

                                                                {{ $apartment->rooms_count }}

                                                            </span>
                                                                        <!--end::Tag-->
                                                                        <!--begin::Tag-->
                                                                        <span class="border border-2 rounded me-3 p-1 px-2">

                                                                <span class="svg-icon svg-icon-2x svg-icon-gray-600 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M2.07664 11.85L2.87663 10.05C3.07663 9.55003 3.67665 9.35003 4.17665 9.55003L5.07664 9.95002C7.17664 10.85 9.17662 10.85 11.2766 9.95002C14.3766 8.55002 17.4766 8.55002 20.5766 9.95002L21.4766 10.35C21.9766 10.55 22.1766 11.15 21.9766 11.65L21.1766 13.45C20.9766 13.95 20.3766 14.15 19.8766 13.95L18.9766 13.55C16.8766 12.65 14.8766 12.65 12.7766 13.55C9.67662 14.95 6.57663 14.95 3.47663 13.55L2.57664 13.15C2.07664 12.95 1.87664 12.35 2.07664 11.85ZM2.57664 20.05L3.47663 20.45C6.57663 21.85 9.67662 21.85 12.7766 20.45C14.8766 19.55 16.8766 19.55 18.9766 20.45L19.8766 20.85C20.3766 21.05 20.9766 20.85 21.1766 20.35L21.9766 18.55C22.1766 18.05 21.9766 17.45 21.4766 17.25L20.5766 16.85C17.4766 15.45 14.3766 15.45 11.2766 16.85C9.17662 17.75 7.17664 17.75 5.07664 16.85L4.17665 16.45C3.67665 16.25 3.07663 16.45 2.87663 16.95L2.07664 18.75C1.87664 19.25 2.07664 19.85 2.57664 20.05Z" fill="currentColor"></path>
                                                                        <path d="M2.07664 4.94999L2.87663 3.15C3.07663 2.65 3.67665 2.45 4.17665 2.65L5.07664 3.05C7.17664 3.95 9.17662 3.95 11.2766 3.05C14.3766 1.65 17.4766 1.65 20.5766 3.05L21.4766 3.44999C21.9766 3.64999 22.1766 4.25 21.9766 4.75L21.1766 6.55C20.9766 7.05 20.3766 7.25 19.8766 7.05L18.9766 6.65C16.8766 5.75 14.8766 5.75 12.7766 6.65C9.67662 8.05 6.57663 8.05 3.47663 6.65L2.57664 6.25C2.07664 6.05 1.87664 5.44999 2.07664 4.94999Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>

                                                                {{ $apartment->bathrooms_count }}

                                                            </span>
                                                                        <!--end::Tag-->
                                                                    @endif

                                                                </div>
                                                                <!--end::Tags-->
                                                            </div>
                                                            <!--end::Section-->
                                                            @if($apartment->is_available)
                                                                <!--begin::Footer-->
                                                                <div class="d-flex flex-column">
                                                                    <!--begin::Separator-->
                                                                    <div class="separator separator-dashed border-muted my-5"></div>
                                                                    <!--end::Separator-->
                                                                    <!--begin::Action-->
                                                                    <div class="d-flex flex-stack">
                                                                        <!--begin::Progress-->
                                                                        <div class="d-flex flex-column mw-200px">
                                                                        </div>
                                                                        <!--end::Progress-->
                                                                        <!--begin::Button-->
                                                                        <a wire:click="selectApartment('{{ $apartment->id }}')" class="btn btn-sm btn-primary">اختيار</a>
                                                                        <!--end::Button-->
                                                                    </div>
                                                                    <!--end::Action-->
                                                                </div>
                                                                <!--end::Footer-->
                                                            @endif
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Apartment-->
                                                @empty
                                                    <div class="d-flex flex-column flex-center">
                                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-250px">
                                                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                                        <div class="fs-6"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Step 1-->
                    @endif

                    @if($step_no == 2)
                        <!--begin::Step 2-->
                        <div class="current">
                            <div class="w-100">
                                <!--begin::Input group-->
                                <div class="fv-row mb-8">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold">
                                        <span class="required">المستأجر:</span>
                                    </label>
                                    @error('selected_user')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Label-->
                                    @if($selected_user)
                                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                                            <div class="d-flex align-items-center p-3 mb-2">
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Name-->
                                                    <a href="{{ route('admin.users.details', ['user_id' => $selected_user->id]) }}" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                                        {{ $selected_user->name }}
                                                    </a>
                                                    <!--end::Name-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Button-->
                                                <a wire:click="selectUser()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <!--end::Button-->
                                            </div>

                                        </div>
                                    @else
                                        <div class="w-100">
                                            <div class="text-gray-500 fw-semibold fs-5">يمكنك البحث ضمن قائمة المستأجرين:</div>

                                            <div class="w-100 position-relative my-5" autocomplete="off">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon -->
                                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Input-->
                                                <input wire:model="search_user" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="اكتب الاسم أو الرقم الشخصي أو البريد الإلكتروني…">
                                                <!--end::Input-->
                                                <!--begin::Spinner-->
                                                <span wire:loading.class.remove="d-none" wire:target="search_user" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                        </span>
                                                <!--end::Spinner-->
                                                <!--begin::Reset-->
                                                <span wire:click="clearSearchUser" wire:loading.remove wire:target="search_user" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search_user) d-none @endif">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                                    <!--end::Svg Icon-->
                                        </span>
                                                <!--end::Reset-->
                                            </div>

                                            <div class="mh-475px scroll-y me-n7 pe-7">

                                                @forelse($users ?? [] as $user)
                                                    <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                                        <!--begin::Details-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Details-->
                                                            <div class="ms-6">
                                                                <!--begin::Name-->
                                                                <a href="{{ route('admin.users.details', ['user_id' => $user->id]) }}" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">
                                                                    {{ $user->name }}
                                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">{{ $user->cpr }}</span></a>
                                                                <!--end::Name-->
                                                                <!--begin::Email-->
                                                                <div class="fw-semibold text-muted">{{ $user->email }}</div>
                                                                <!--end::Email-->
                                                            </div>
                                                            <!--end::Details-->
                                                        </div>
                                                        <!--end::Details-->
                                                        <!--begin::Stats-->
                                                        <div class="d-flex">
                                                            <!--begin::Sales-->
                                                            <div class="text-end">
                                                                <a wire:click="selectUser('{{ $user->id }}')" class="btn btn-sm btn-primary">اختيار</a>
                                                            </div>
                                                            <!--end::Sales-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Property-->
                                                @empty
                                                    <div class="d-flex flex-column flex-center">
                                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-250px">
                                                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                                        <div class="fs-6"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        <!--end::Step 2-->
                    @endif

                    @if($step_no == 3)
                        <!--begin::Step 3-->
                        <div class="current">
                            <div class="w-100">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold">مدة العقد:</label>
                                    @error('start_at')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @error('end_at')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!--end::Label-->
                                    <!--begin::Input-->

                                    <div class="mt-2">
                                        <input wire:ignore  class="form-control form-control-solid" value="" placeholder="Pick date rage" id="kt_contract_duration"/>
                                        <style>
                                            .daterangepicker{
                                                z-index: 10000 !important;
                                            }
                                        </style>
                                        <script wire:ignore>

                                            var start = moment();
                                            var end = moment();

                                            @this.set('start_at', start);
                                            @this.set('end_at', end);

                                            $("#kt_contract_duration").daterangepicker({
                                                startDate: start,
                                                endDate: end,
                                                showDropdowns: true,
                                                linkedCalendars: false,
                                                ranges: {
                                                    "شهر": [moment(), moment().add(1, 'months')],
                                                    "6 أشهر": [moment(), moment().add(6, 'month')],
                                                    "1 سنة": [moment(), moment().add(1, 'years')],
                                                    "5 سنوات": [moment(), moment().add(5, 'years')],
                                                },
                                                locale: {
                                                    format: 'MM/YYYY'
                                                },
                                            }, function(start, end, label) {
                                            @this.set('start_at', start);
                                            @this.set('end_at', end);
                                            });

                                        </script>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-semibold">قيمة الإيجار:</label>

                                    <!--begin::Input-->
                                    <div class="input-group mb-5">
                                        <input wire:model.defer="cost" type="text" class="form-control">
                                        <span class="input-group-text" id="basic-addon2">د.ب. / شهري</span>
                                    </div>
                                    <!--end::Input-->

                                    @error('cost')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Label-->

                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold">ملاحظات:</label>

                                    <!--begin::Input-->
                                    <textarea wire:model.defer="notes" rows="3" type="text" class="form-control"></textarea>
                                    <!--end::Input-->

                                    @error('notes')
                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Label-->

                                </div>
                                <!--end::Input group-->


                            </div>
                        </div>
                        <!--end::Step 3-->
                    @endif

                    @if($step_no == 4)
                        <!--begin::Step 4-->
                        <div class="current">
                            <div class="w-100">


                                <!--begin::Section-->
                                <div class="mb-7">
                                    <!--begin::Details-->
                                    <!--begin::Title-->
                                    <h5 class="mb-4">المستأجر:</h5>
                                    <!--end::Title-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-60px symbol-circle me-3">
                                            <img alt="Pic" src="{{ $this->selected_user->profile_photo_url }}">
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <a class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                                {{ $this->selected_user->name }}
                                            </a>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <a class="fw-semibold text-gray-600 text-hover-primary">
                                                cpr: {{ $this->selected_user->cpr }}
                                            </a>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Seperator-->
                                <div class="separator separator-dashed mb-7"></div>
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                <div class="mb-10">
                                    <!--begin::Title-->
                                    <h5 class="mb-4">العقد: </h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                        <!--begin::Row-->
                                        <tbody><tr class="">
                                            <td class="text-gray-400">العقار: </td>
                                            <td class="text-gray-800">{{ $this->selected_property->name }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400">الوحدة: </td>
                                            <td class="text-gray-800">{{ $this->selected_apartment->name }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400">تاريخ البداية: </td>
                                            <td class="text-gray-800">
                                                {{ \Carbon\Carbon::make($this->start_at)->format('Y/m') }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400">تاريخ النهاية: </td>
                                            <td class="text-gray-800">
                                                {{ \Carbon\Carbon::make($this->end_at)->format('Y/m') }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr class="">
                                            <td class="text-gray-400">الملاحظات: </td>
                                            <td class="text-gray-800">
                                                @if($this->notes)
                                                    {{ $this->notes }}
                                                @else
                                                    <span class="badge badge-square bg-gray-700">لا يوجد ملاحظات</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        </tbody></table>
                                    <!--end::Details-->
                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->

                                    <div class="mb-7">
                                        <div class="d-flex flex-stack bg-primary rounded-3 p-6 mb-11">
                                            <!--begin::Content-->
                                            <div class="fs-6 fw-bold text-white">
                                                <span class="d-block fs-1 lh-1">الإيجار</span>
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Content-->
                                            <div class="fs-6 fw-bold text-white text-end">
                                            <span class="d-block fs-1 lh-1" data-kt-pos-element="grant-total">
                                                {{ $this->cost }}
                                                <sm class="fs-1">
                                                    د.ب. / شهري
                                                </sm>
                                            </span>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>

                                </div>
                                <!--end::Section-->

                            </div>
                        </div>
                        <!--end::Step 4-->
                    @endif

                    <!--begin::Actions -->
                    <div class="d-flex flex-stack pt-10">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            @if($step_no > 1)
                                <button wire:click="goPreviouesStep" type="button" class="btn btn-lg btn-light-primary me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    <span class="svg-icon svg-icon-3 me-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                                    <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
                                </svg>
                            </span>
                                    <!--end::Svg Icon-->
                                    العودة
                                </button>
                            @endif
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Wrapper-->
                        <div>
                            <button wire:click="goNextStep" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span wire:loading.remove>
                                    التالي
                                <span class="svg-icon svg-icon-3 ms-1 me-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                    </svg>
                                </span>
                                </span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span wire:loading wire:target="goNextStep">
                                    انتظر قليلًا…
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Content-->

        @endif


    </div>
    <!--end::Stepper-->

</div>


