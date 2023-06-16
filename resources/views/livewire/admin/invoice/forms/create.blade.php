<div>
    @if($this->invoice)
        <form wire:submit.prevent="save" id="kt_invoice_form">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column align-items-start flex-xxl-row">
                <!--begin::Input group-->
                <div class="d-flex align-items-center flex-equal fw-row me-4 order-2" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Specify invoice date" data-kt-initialized="1">
                    <!--begin::Date-->
                    <div class="fs-6 fw-bold text-gray-700 text-nowrap">التاريخ:</div>
                    <!--end::Date-->

                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center w-150px">
                        <!--begin::Datepicker-->
                        <input wire:ignore id="invoice-date-picker" class="form-control form-control-transparent fw-bold pe-5 flatpickr-input" placeholder="تاريخ الفاتورة" readonly="readonly">
                        <script wire:ignore>
                            $("#invoice-date-picker").flatpickr({
                                onChange: function(selectedDates, dateStr, instance) {
                                    @this.set('invoice.date', dateStr)
                                }
                            });
                        </script>
                        <!--end::Datepicker-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-down fs-4 position-absolute ms-4 end-0"></i>
                       <!--end::Icon-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Enter invoice number" data-kt-initialized="1">
                    <span class="fs-2x fw-bold text-gray-800">فاتورة #</span>
                    <input wire:model.defer="invoice.no" type="text" class="form-control form-control-flush fw-bold text-muted fs-3 w-125px" placehoder="...">
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Specify invoice due date" data-kt-initialized="1">
                    <!--begin::Date-->
                    <div class="fs-6 fw-bold text-gray-700 text-nowrap">الاستحقاق:</div>
                    <!--end::Date-->

                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center w-150px">
                        <!--begin::Datepicker-->
                        <input wire:ignore id="invoice-due-picker" class="form-control form-control-transparent fw-bold pe-5 flatpickr-input" placeholder="تاريخ الاستحقاق" readonly="readonly">
                        <script wire:ignore>
                            $("#invoice-due-picker").flatpickr({
                                onChange: function(selectedDates, dateStr, instance) {
                                    @this.set('invoice.due', dateStr)
                                }
                            });
                        </script>
                        <!--end::Datepicker-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-down fs-4 position-absolute end-0 ms-4"></i>                        <!--end::Icon-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Top-->

            <!--begin::Separator-->
            <div class="separator separator-dashed my-10"></div>
            <!--end::Separator-->

            <!--begin::Wrapper-->
            <div class="mb-0">
                <!--begin::Row-->
                <div class="row gx-10 mb-5">
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">العقد</label>
                        @error('invoice.contract_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        @if($this->selected_contract)
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                                <div class="d-flex align-items-center p-3 mb-2">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                            رقم العقد#: {{ $this->selected_contract->id}}
                                            <br>
                                            {{ $this->selected_contract->user->name }}
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Button-->
                                    <a wire:click="selectContract()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
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
                                <div class="text-gray-500 fw-semibold fs-5 my-4">البحث عن العقود المتاحة</div>

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
                                    <input wire:model="search_contract" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="البحث عن العقود">
                                    <!--end::Input-->
                                    <!--begin::Spinner-->
                                    <span wire:loading.class.remove="d-none" wire:target="search_contract" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                        </span>
                                    <!--end::Spinner-->
                                    <!--begin::Reset-->
                                    <span wire:click="clearSearchApartment" wire:loading.remove wire:target="search_contract" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search_contract) d-none @endif">
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

                                    @forelse($this->contracts ?? [] as $contract)

                                        <!--begin::Apartment-->
                                        <div class="border border-hover-primary p-7 rounded mb-7 @if(!$contract->active) bg-light-danger @endif">
                                            <!--begin::Id-->
                                            <div class="d-flex flex-stack pb-3">
                                                <div class="d-flex">
                                                    <p class="text-muted">
                                                        رقم العقد#:
                                                        {{ $contract->id }}
                                                    </p>



                                                </div>
                                                <!--begin::Label-->
                                                @if($contract->active)
                                                    <span class="badge badge-light-success d-flex align-items-center fs-8 fw-semibold">
                                                        فعّال
                                                    </span>
                                                @else
                                                    <span class="badge badge-light-danger d-flex align-items-center fs-8 fw-semibold">
                                                        غير فعّال
                                                    </span>
                                                @endif
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Id-->
                                            <!--begin::Wrapper-->
                                            <div class="p-0">
                                                <!--begin::Section-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Separator-->
                                                    <div class="separator separator-dashed border-muted mb-5"></div>
                                                    <!--end::Separator-->
                                                    <!--begin::Action-->
                                                    <div class="d-flex flex-stack">
                                                        <!--begin::Progress-->
                                                        <div class="d-flex flex-column mw-200px">
                                                            <div class="d-flex flex-column">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="symbol symbol-40px symbol-circle me-3">
                                                                        <img src="{{ $contract->user->profile_photo_url }}" alt="$contract->user->name">
                                                                    </div>
                                                                    <div class="d-flex justify-content-start flex-column">
                                                                        <a href="{{ route('admin.users.details', ['user_id' => $contract->user->id]) }}" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                            {{ $contract->user->name }}
                                                                        </a>
                                                                        <span class="text-muted fw-semibold d-block fs-7">
                                                                            {{ $contract->user->cpr }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Progress-->
                                                    </div>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Footer-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Separator-->
                                                    <div class="separator separator-dashed border-muted my-5"></div>
                                                    <!--end::Separator-->
                                                    <!--begin::Action-->
                                                    <div class="d-flex flex-stack">
                                                        <!--begin::Progress-->
                                                        <div class="d-flex flex-column mw-200px">
                                                            <div class="d-flex flex-column">
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Cost-->
                                                                    <span class="text-dark fw-bold fs-5">{{ $contract->cost }}</span>
                                                                    <span class="text-muted fs-7">/شهري</span>
                                                                    <!--end::Cost-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Progress-->
                                                        <!--begin::Button-->
                                                        <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                            معاينة
                                                        </a>
                                                        <!--end::Button-->
                                                        <!--begin::Button-->
                                                        <a wire:click="selectContract('{{ $contract->id }}')" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-check"></i>
                                                            اختيار
                                                        </a>
                                                        <!--end::Button-->
                                                    </div>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Footer-->

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
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">القيمة</label>
                        <!--begin::Input group-->
                        <div class="mb-5">
                            <input wire:model.defer="invoice.amount" type="text" class="form-control form-control-solid">
                            @error('invoice.amount')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

            </div>
            <!--end::Wrapper-->

            <!--begin::Actions-->
            <div class="text-center">
                <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                    عودة
                </button>

                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-danger">
                    <!--begin::Indicator label-->
                    <span wire:loading.remove wire:target="save">تأكيد العملية</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span wire:loading wire:target="save">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                    <!--end::Indicator progress-->
                </button>
            </div>
            <!--end::Actions-->
        </form>
    @endif
</div>
