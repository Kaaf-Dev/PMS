<div>

    <div class="card card-flush mb-4">
        <div class="card-body">
            <!--begin::Summary-->


            <!--begin::User Info-->
            <div class="d-flex flex-center flex-column py-5">
                <!--begin::Avatar-->
                <div class="symbol symbol-100px symbol-circle mb-7">
                    <img src="{{ $this->ticket->TicketImagePath }}" alt="image">
                </div>
                <!--end::Avatar-->

                <!--begin::Name-->
                <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">
                    {{ $this->ticket->TicketName }}
                </a>
                <!--end::Name-->
            </div>
            <!--end::User Info-->
            <!--end::Summary-->

            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">
                    التواصل
                    <span class="ms-2 rotate-180">
                      <i class="ki-outline ki-down fs-3"></i>
                    </span>
                </div>
            </span>
            </div>
            <!--end::Details toggle-->

            <div class="separator"></div>

            <!--begin::Details content-->
            <div id="kt_user_view_details" class="collapse show">
                <div class="pb-5 fs-6">
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">العقار</div>
                    <div class="text-gray-600">{{ $this->ticket->property->name }}</div>
                    <!--begin::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">رقم الهاتف</div>
                    <div class="text-gray-600"><a class="text-gray-600 text-hover-primary">{{ $this->ticket->TicketUserPhone }}</a></div>
                    <!--begin::Details item-->
                </div>
            </div>
            <!--end::Details content-->
        </div>
    </div>

</div>
