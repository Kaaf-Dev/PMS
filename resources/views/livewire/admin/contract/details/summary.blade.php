<div>
    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>الإدارة</h2>
            </div>

            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::More options-->
                <a href="#" class="btn btn-sm btn-light btn-icon" data-kt-menu-trigger="click" data-kt-menu-placement="{{ getDataKtMenuPlacementBottomValue() }}">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">

                    <!--begin::Heading-->
                    <div class="menu-item px-3">
                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">الفوترة</div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a wire:click="createInvoice" class="menu-link px-3">
                            <span class="">فاتورة جديدة</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">
                            <span class="">تسجيل دفعة</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Heading-->
                    <div class="menu-item px-3">
                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">إعدادات</div>
                    </div>
                    <!--end::Heading-->

                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                        <a href="#" class="menu-link px-3">
                            <span class="menu-title">المستأجر</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4" style="">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a wire:click="manageUser" class="menu-link px-3">إدارة المستأجر</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a wire:click="manageApartment" class="menu-link px-3">إدارة العقار</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>

                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                        <a href="#" class="menu-link px-3">
                            <span class="menu-title">بنود العقد</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4" style="">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a wire:click="manageRentalCost" class="menu-link px-3">قيمة الإيجار</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a wire:click="updateDuration" class="menu-link px-3">مدة العقد</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    @if($this->contract->is_lawyerable)
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a class="menu-link text-muted px-3">( تم تعيين محامي )</a>
                        </div>
                        <!--end::Menu item-->
                    @else
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a wire:click="assignLawyer" class="menu-link px-3">تحويل العقد إلى المحامي</a>
                        </div>
                        <!--end::Menu item-->
                    @endif

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    @if($this->contract->active_status)
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a wire:click="cancelContract" class="menu-link text-danger px-3">إيقاف العقد</a>
                        </div>
                        <!--end::Menu item-->
                    @else
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a class="menu-link text-muted px-3">إيقاف العقد (غير فعّال)</a>
                        </div>
                        <!--end::Menu item-->
                    @endif
                </div>
                <!--end::Menu-->
                <!--end::More options-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 fs-6">
            <!--begin::Section-->
            <div class="mb-7">
                <!--begin::Title-->
                <h5 class="mb-4">المستأجر</h5>
                <!--end::Title-->
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
            <!--end::Section-->

            @if ($this->contract->is_lawyerable)

                <div class="separator separator-dashed my-5"></div>

                <!--begin::Section-->
                <div class="mb-7">
                    <!--begin::Title-->
                    <h5 class="mb-4">المحامي</h5>
                    <!--end::Title-->
                    <!--begin::Details-->
                    <div class="d-flex align-items-center">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-60px symbol-circle me-3">
                            <img alt="{{ $this->contract->lawyerCase->lawyer->name }}" src="{{ $this->contract->lawyerCase->lawyer->profilePhotoUrl }}">
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <a class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">{{ $this->contract->lawyerCase->lawyer->name }}</a>
                            <!--end::Name-->
                            <!--begin::Email-->
                            <a class="fw-semibold text-gray-600 text-hover-primary">{{ $this->contract->lawyerCase->lawyer->contact_name }}</a>
                            <!--end::Email-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Section-->

                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed rounded-3 p-6">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <div class="fs-6 text-gray-700">
                                تم تحويل هذا العقد إلى المحامي
                            </div>
                        </div>
{{--                        <button wire:click="unassignLawyer" class="btn btn-warning btn-sm">إلغاء التوكيل</button>--}}
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>

            @endif
        </div>
        <!--end::Card body-->
    </div>
</div>
