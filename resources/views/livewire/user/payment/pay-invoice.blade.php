<div>

    @if($this->invoice)
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
            <span class="required">قيمة الفاتورة المستحقة</span>
        </label>
        <!--end::Label-->
        <input type="number" class="form-control form-control-solid" value="{{ $this->invoice->unPaidAmount }}" readonly/>
        @error('invoice_id')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!--end::Input group-->
    <div class="mb-5">
        <h3>بيانات البطاقة البنكية</h3>
    </div>
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
            <span class="required">الاسم على البطاقة</span>
        </label>
        <!--end::Label-->
        <input wire:model.defer="card_name" type="text" class="form-control form-control-sm" placeholder=""/>
        @error('card_name')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="required fs-6 fw-semibold form-label mb-2">رقم البطاقة</label>
        <!--end::Label-->
        <!--begin::Input wrapper-->
        <div class="position-relative">
            <!--begin::Input-->
            <input wire:model.defer="card_number" type="text" class="form-control form-control-sm" placeholder="" />
            <!--end::Input-->
            <!--begin::Card logos-->
            <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                <img src="{{asset('user-assets/media/svg/card-logos/visa.svg')}}" alt="" class="h-25px" />
                <img src="{{asset('user-assets/media/svg/card-logos/mastercard.svg')}}" alt="" class="h-25px" />
            </div>
            <!--end::Card logos-->
        </div>
        <!--end::Input wrapper-->
        @error('card_number')
        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Col-->
        <div class="col-md-8 fv-row">
            <!--begin::Label-->
            <label class="required fs-6 fw-semibold form-label mb-2">تاريخ انتهاء الصلاحية</label>
            <!--end::Label-->
            <!--begin::Row-->
            <div class="row fv-row">
                <!--begin::Col-->
                <div class="col-6">
                    <select wire:model.defer="card_month_exp" class="form-select form-select-sm">
                        <option label="الشهر"></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-6">
                    <select wire:model.defer="card_year_exp" class="form-select form-select-sm">
                        <option>السنة</option>
                        @foreach($expiryYears as $year)
                            <option value="{{$year['label']}}">{{$year['label']}}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
                @error('card_month')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="required">CVV</span>
            </label>
            <!--end::Label-->
            <!--begin::Input wrapper-->
            <div class="position-relative">
                <!--begin::Input-->
                <input wire:model.defer="card_cvv" type="text" class="form-control form-control-sm" minlength="3" maxlength="3" placeholder="CVV" />
                <!--end::Input-->
                @error('card_cvv')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input wrapper-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button wire:click="closeMe" type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">الغاء</button>
        <button wire:click="pay" wire:loading.attr="disabled" class="btn btn-primary">
            <span wire:loading.remove  class="indicator-label">دفع</span>
            <span wire:loading class="indicator-progress">الرجاء الانتظار
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <!--end::Actions-->

    @endif
</div>
