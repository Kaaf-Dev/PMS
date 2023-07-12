<div>

    <div class="card card-flush mb-4">
        <div class="card-body">
            <!--begin::Summary-->


            <!--begin::User Info-->

            <div class="d-flex align-items-center me-5 me-xl-13 mb-5">
                <!--begin::Symbol-->
                <div class="symbol symbol-60px symbol-circle me-3">
                    <img src="{{ $this->ticket->contract->user->profile_photo_url }}" class="" alt="">
                </div>
                <!--end::Symbol-->

                <!--begin::Info-->
                <div class="m-0">
                    <span class="fw-semibold text-gray-400 d-block fs-7">المستأجر</span>
                    <a href="{{ route('admin.users.details', ['user_id' => $this->ticket->contract->user->id]) }}" class="fw-bold text-gray-800 text-hover-primary fs-6">
                        {{ $this->ticket->contract->user->name }}
                    </a>
                </div>
                <!--end::Info-->
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
                    <div class="text-gray-600">{{ $this->ticket->contract->apartments[0]->property->name }}</div>
                    <!--begin::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">رقم الهاتف</div>
                    <div class="text-gray-600"><a class="text-gray-600 text-hover-primary">{{ $this->ticket->contract->user->phone }}</a></div>
                    <!--begin::Details item-->
                </div>
            </div>
            <!--end::Details content-->
        </div>
    </div>

</div>
