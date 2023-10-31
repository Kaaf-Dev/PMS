<div>

    @if($this->ticket->is_rated)
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
                <h4 class="mb-4">تقييم المستأجر</h4>
                <!--end::Title-->

                <!--begin::Title-->
                <h4 class="mb-2">ملاحظات:</h4>
                <h4 class="mb-4">{{ $this->ticket->rate_notes ?? 'لا يوجد' }}</h4>
                <!--end::Title-->

                <!--begin::Rating-->
                <div class="rating">
                    <div class="rating-label @if($this->ticket->rate_stars >= 1) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div class="rating-label @if($this->ticket->rate_stars >= 2) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div class="rating-label @if($this->ticket->rate_stars >= 3) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div class="rating-label @if($this->ticket->rate_stars >= 4) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                    <div class="rating-label @if($this->ticket->rate_stars >= 5) checked @endif">
                        <i class="ki-duotone ki-star fs-1"></i>
                    </div>
                </div>
                <!--end::Rating-->

                <!--end::Content-->

            </div>
            <!--end::Wrapper-->

        </div>
    @endif

</div>
