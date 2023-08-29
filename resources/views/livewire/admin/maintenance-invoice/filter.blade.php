<div>
    <form wire:submit.prevent="search">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin:Search-->
                <div class="position-relative">
                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"></i>
                    <input wire:model.defer="search" type="text" class="form-control form-control-solid ps-10" placeholder="البحث في الفواتير" />
                </div>
                <!--end:Search-->

                <!--begin::Border-->
                <div class="separator separator-dashed my-8"></div>
                <!--end::Border-->

                <!--begin::Input group-->
                <div class="mb-8">
                    <label class="fs-6 form-label fw-bold text-dark">حالة الفاتورة</label>
                    <!--begin::Select-->
                    <select wire:model.defer="status" class="form-select form-select-solid">
                        <option value="">الجميع</option>
                        @foreach($this->statusList ?? [] as $key => $status)
                            <option value="{{ $key }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Input group-->

                <!--begin::Border-->
                <div class="separator separator-dashed my-8"></div>
                <!--end::Border-->

                <!--begin::Input group-->
                <div class="mb-8">
                    <label class="fs-6 form-label fw-bold text-dark">شركة الصيانة</label>
                    <!--begin::Select-->
                    <select wire:model.defer="maintenance_company_id" class="form-select form-select-solid">
                        <option value="">الجميع</option>
                        @foreach($this->maintenanceCompanies ?? [] as $maintenance_company)
                            <option value="{{ $maintenance_company->id }}">{{ $maintenance_company->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Input group-->

                <!--begin::Border-->
                <div class="separator separator-dashed my-8"></div>
                <!--end::Border-->

                <!--begin::Action-->
                <div class="d-flex align-items-center justify-content-end">
                    <button wire:click="discard" wire:loading.attr="disabled" type="button" class="btn btn-active-light-primary btn-color-gray-400 me-3">
                        <span wire:loading.remove wire:target="discard">استعادة</span>
                        <!--begin::Indicator progress-->
                        <span wire:loading wire:target="discard">
                            الرجاء الانتظار
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress-->
                    </button>
                    <button type="submit" class="btn btn-primary">

                        <span wire:loading.remove wire:target="search">بحث</span>
                        <!--begin::Indicator progress-->
                        <span wire:loading wire:target="search">
                            الرجاء الانتظار
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress-->

                    </button>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </form>
</div>
