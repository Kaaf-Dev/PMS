<div>

    @if($this->ticket->is_ratable)
        <div class="alert bg-light-info border border-info border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <i class="ki-duotone ki-like-2 fs-2hx text-info me-4 mb-5 mb-sm-0">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="mb-4">كيف ترى جودة خدمات الصيانة؟</h4>
                <!--end::Title-->

                <!--begin::Content-->
                <span class="mb-4">
                    يهمنا مدى رضاك عن الخدمة
                </span>

                <!--begin::Rating-->
                <div class="rating">
                    <div wire:click="rate(1)" class="rating-label @if($rate_stars >= 1) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div wire:click="rate(2)" class="rating-label @if($rate_stars >= 2) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div wire:click="rate(3)" class="rating-label @if($rate_stars >= 3) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div wire:click="rate(4)" class="rating-label @if($rate_stars >= 4) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div wire:click="rate(5)" class="rating-label @if($rate_stars >= 5) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <span wire:loading wire:target="rate">
                        <span class="spinner-border spinner-border-sm align-middle"></span>
                    </span>
                </div>
                <!--end::Rating-->

                <div class="mb-4 w-100">
                    <textarea wire:model.defer="rate_notes" class="form-control form-control placeholder-gray-600 fw-bold fs-4 ps-9 pt-7" rows="6" cols="50%" placeholder="ملاحظات"></textarea>
                </div>


                <span>
                    <button wire:click="submit" type="button" class="btn btn-sm btn-primary">
                        <div wire:loading.remove wire:target="submit">
                            إرسال التقييم
                        </div>
                        <!--begin::Indicator progress-->
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm align-middle"></span>
                        </span>
                        <!--end::Indicator progress-->
                </button>
                </span>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->

        </div>
    @endif
</div>
