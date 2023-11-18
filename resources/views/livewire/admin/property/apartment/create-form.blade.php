<div>
    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Heading-->
        <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">تسجيل وحدة جديدة</h1>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-5">
                من هنا يمكنك تسجيل بيانات الوحدة الجديدة
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">الاسم</span>
            </label>
            <!--end::Label-->

            <input wire:model.defer="name" type="text" class="form-control form-control-solid" placeholder="اسم الوحدة">
            @error('name')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">نوع الوحدة</span>
            </label>
            <!--end::Label-->

            <div class="row g-9">

                <!--begin::Col-->
                <div class="col-md-4 col-lg-4 col-xxl-4">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 @if($this->type == $type_house) active @endif">
                        <!--begin::Radio button-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input wire:model="type" class="form-check-input" type="radio" value="{{ $type_house }}" />
                        </span>
                        <!--end::Radio button-->
                        <span class="ms-5">
                            <div class="symbol symbol-75px symbol-circle mb-7">
                                <div class="symbol-label fs-2 fw-semibold bg-gray text-inverse-gray">
                                    <span class="svg-icon svg-icon-3x svg-icon-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>
                                            <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>
                                            <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <span class="fs-4 fw-bold mb-1 d-block">شقة سكنية</span>
                        </span>
                    </label>
                    @error('type')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 col-lg-4 col-xxl-4">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 @if($this->type == $type_store) active @endif ">
                        <!--begin::Radio button-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input wire:model="type" class="form-check-input" type="radio" value="{{ $type_store }}" />
                        </span>
                        <!--end::Radio button-->
                        <span class="ms-5">
                            <div class="symbol symbol-75px symbol-circle mb-7">
                                <div class="symbol-label fs-2 fw-semibold bg-gray text-inverse-gray">
                                    <span class="svg-icon svg-icon-3x svg-icon-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"></path>
                                            <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <span class="fs-4 fw-bold mb-1 d-block">محل تجاري</span>
                        </span>
                    </label>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-4 col-lg-4 col-xxl-4">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 @if($this->type == $type_earth) active @endif ">
                        <!--begin::Radio button-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input wire:model="type" class="form-check-input" type="radio" value="{{ $type_earth }}" />
                        </span>
                        <!--end::Radio button-->
                        <span class="ms-5">
                            <div class="symbol symbol-75px symbol-circle mb-7">
                                <div class="symbol-label fs-2 fw-semibold bg-gray text-inverse-gray">
                                 <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/maps/map002.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z" fill="currentColor"/>
                                            <path d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <span class="fs-4 fw-bold mb-1 d-block">قطعة أرض</span>
                        </span>
                    </label>
                </div>
                <!--end::Col-->

            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">الإيجار المقدر / شهري</label>
                <input wire:model.defer="cost" type="number" step="0.01" class="form-control form-control-solid" placeholder="الإيجار المقدر / شهري">
                @error('cost')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">المساحة</label>
                <input wire:model.defer="area" type="number" class="form-control form-control-solid" placeholder="المساحة">
                @error('area')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        @if( $this->type == $this->type_store)
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">عدد الطوابق</label>
                    <input wire:model.defer="floors" type="number" class="form-control form-control-solid" placeholder="عدد الطوابق">
                    @error('floors')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
        @endif

        @if( $this->type == $this->type_house)
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">عدد الغرف</label>
                    <input wire:model.defer="rooms_count" type="number" class="form-control form-control-solid" placeholder="عدد الغرف">
                    @error('rooms_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">دورات المياه</label>
                    <input wire:model.defer="bathrooms_count" type="number" class="form-control form-control-solid" placeholder="دورات المياه">
                    @error('bathrooms_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">يوجد حارس عمارة</label>
                    <select wire:model.defer="with_building_guard" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('with_building_guard')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">مع كهرباء</label>
                    <select wire:model.defer="with_electricity" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('with_electricity')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">مع بلكونة</label>
                    <select wire:model.defer="with_balcony" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('with_balcony')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">مع مصعد</label>
                    <select wire:model.defer="with_elevator" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('with_elevator')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">مع مسبح</label>
                    <select wire:model.defer="with_pool" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('with_pool')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">التأثيث</label>
                    <select wire:model.defer="furniture" class="form-control form-select form-control-solid">
                        <option>-- اختيار --</option>
                        <option value="1">كامل</option>
                        <option value="2">نصف تأثيث</option>
                        <option value="3">غير مؤثث</option>
                    </select>
                    @error('furniture')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="required fs-6 fw-semibold mb-2">عدد مواقف السيارات</label>
                    <input wire:model.defer="parking" type="number" class="form-control form-control-solid">
                    @error('parking')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        @endif

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">إنشاء</span>
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
</div>
