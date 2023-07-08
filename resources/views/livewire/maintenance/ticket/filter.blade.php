<div>
    <!--begin::Form-->
    <form wire:submit.prevent="search">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin:Search-->
                <div class="position-relative">
                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"></i>
                    <input wire:model.defer="search" type="text" class="form-control form-control-solid ps-10" placeholder="البحث في الطلبات" />
                </div>
                <!--end:Search-->
                <!--begin::Border-->
                <div class="separator separator-dashed my-8"></div>
                <!--end::Border-->
                <!--begin::Input group-->
                <div class="mb-5">
                    <label class="fs-6 form-label fw-bold text-dark">حالة الطلب</label>
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

                <!--begin::Input group-->
                <div class="mb-5">
                    <label class="fs-6 form-label fw-bold text-dark">موعد الزيارة خلال</label>
                    <!--begin::Radio group-->
                    <div class="nav-group nav-group-fluid">
                        <!--begin::Option-->
                        <label>
                            <input wire:model.defer="visit_in" name="ticket_category" type="radio" class="btn-check" value="day" />
                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">اليوم</span>
                        </label>
                        <!--end::Option-->
                        <!--begin::Option-->
                        <label>
                            <input wire:model.defer="visit_in" name="ticket_category" type="radio" class="btn-check" value="week" />
                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">الأسبوع</span>
                        </label>
                        <!--end::Option-->
                        <!--begin::Option-->
                        <label>
                            <input wire:model.defer="visit_in" name="ticket_category" type="radio" class="btn-check" value="month" />
                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">الشهر</span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Radio group-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10">
                    <label class="fs-6 form-label fw-bold text-dark mb-5">الفئة</label>

                    @foreach($this->ticketCategories ?? [] as $key => $ticket_category)
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input wire:model.defer="ticket_categories.{{ $ticket_category->id }}" value="{{ $ticket_category->id }}" class="form-check-input" type="checkbox" id="kt_search_category_{{ $key }}" />
                            <label class="form-check-label flex-grow-1 fw-semibold text-gray-700 fs-6" for="kt_search_category_{{ $key }}">{{ $ticket_category->title }}</label>
                        </div>
                        <!--end::Checkbox-->
                    @endforeach
                </div>
                <!--end::Input group-->
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
    <!--end::Form-->
</div>
