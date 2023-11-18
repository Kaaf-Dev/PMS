<div>
    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Heading-->
        <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">تسجيل عقار جديد</h1>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-5">
                من هنا يمكنك تسجيل بيانات العقار الجديد
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <!--begin::Label-->
            <label class="required form-label mb-3">النوع</label>
            <!--begin::Row-->
            <div class="row g-9" data-kt-buttons="true"
                 data-kt-buttons-target="[data-kt-button='true']">
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Option-->
                    <label
                        class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6"
                        data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input wire:model="item_type" class="form-check-input gender" type="radio" name="campaign_gender" value="1"/>
                        </span>
                        <!--end::Radio-->
                        <!--begin::Info-->
                        <span class="ms-5"><span class="fs-4 fw-bold text-gray-800 d-block">عقار</span></span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Option-->
                    <label
                        class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6"
                        data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input wire:model="item_type" class="form-check-input" type="radio" name="campaign_gender" value="2"/>
                        </span>
                        <!--end::Radio-->
                        <!--begin::Info-->
                        <span class="ms-5"><span class="fs-4 fw-bold text-gray-800 d-block">ارض</span></span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            @error('gender_type')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->



        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">رقم البند</span>
            </label>
            <!--end::Label-->

            <input wire:model.defer="ky_no" type="text" class="form-control form-control-solid" placeholder="رقم البند">
            @error('ky_no')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">التصنيف</span>
            </label>
            <!--end::Label-->
            <!--begin::Input -->
            <select wire:model.defer="category_id"
                    class="form-control form-control-solid form-select form-control-solid">
                <option value="">اختيار</option>
                @foreach($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
            <!--end::Input -->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">الاسم</span>
            </label>
            <!--end::Label-->

            <input wire:model.defer="name" type="text" class="form-control form-control-solid" placeholder="اسم العقار">
            @error('name')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-12 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">المساحة</label>
                <input wire:model.defer="area" type="number" step="0.01" class="form-control form-control-solid"
                       placeholder="المساحة">
                @error('area')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">القيمة السوقية</label>
                <input wire:model.defer="market_value" type="number" class="form-control form-control-solid"
                       placeholder="القيمة السوقية">
                @error('market_value')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
            <!--end::Col-->

            @if($item_type == 1)
                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="required fs-6 fw-semibold mb-2">عدد الطوابق</label>
                    <input wire:model.defer="floors_count" type="number" class="form-control form-control-solid"
                           placeholder="عدد الطوابق">
                    @error('floors_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">عدد المنازل</label>
                    <input wire:model.defer="apartments_house_count" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                    @error('apartments_house_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">عدد المحلات</label>
                    <input wire:model.defer="apartments_market_count" type="number" class="form-control form-control-solid"
                           placeholder="لا يوجد">
                    @error('apartments_market_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">سنة التأسيس</label>
                    <input wire:model.defer="construction_date" type="number" class="form-control form-control-solid"
                           placeholder="سنة التأسيس">
                    @error('construction_date')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->





            @endif
            @if($item_type == 2)
                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="required fs-6 fw-semibold mb-2">رقم المقدمة</label>
                    <input wire:model.defer="register_number" type="number" class="form-control form-control-solid"
                           placeholder="رقم المقدمة">
                    @error('register_number')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="required fs-6 fw-semibold mb-2">سنة المقدمة</label>
                    <input wire:model.defer="register_year" type="number" class="form-control form-control-solid"
                           placeholder="سنة المقدمة">
                    @error('register_year')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->


                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="required fs-6 fw-semibold mb-2">رقم الوثيقة</label>
                    <input wire:model.defer="document_no" type="number" class="form-control form-control-solid"
                           placeholder="رقم الوثيقة">
                    @error('document_no')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">اسم المالك السابق</label>
                    <input wire:model.defer="owner_name" type="text" class="form-control form-control-solid"
                           placeholder="اسم المالك السابق">
                    @error('owner_name')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">هاتف المالك السابق</label>
                    <input wire:model.defer="owner_phone" type="number" class="form-control form-control-solid"
                           placeholder="هاتف المالك السابق">
                    @error('owner_phone')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <label class="fs-6 fw-semibold mb-2">الرقم الشخصي المالك السابق</label>
                    <input wire:model.defer="owner_cpr" type="number" class="form-control form-control-solid"
                           placeholder="الرقم الشخصي المالك السابق">
                    @error('owner_cpr')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Col-->
            @endif

        </div>
        <!--end::Input group-->


        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove>إنشاء</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading>
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form>
</div>
