<div>
    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>بيانات المستأجر</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 fs-6">
            <!--begin::Section-->
            <div class="mb-7">
                <!--begin::Title-->
                <h5 class="mb-4">المستأجر</h5>
                <!--end::Title-->
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-60px symbol-circle me-3">
                        <img alt="{{ $this->contract->user->name }}" src="{{ $this->contract->user->profilePhotoUrl }}">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                            {{ $this->contract->user->name }}
                        <!--end::Name-->
                        <!--begin::Email-->
                        <span class="fw-semibold text-gray-600">
                            {{ $this->contract->user->user_type_human }}
                        </span>
                        <!--end::Email-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
            <!--end::Section-->

            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">
                    التفاصيل
                    <span class="ms-2 rotate-180">
                        <i class="ki-outline ki-down fs-3"></i>
                    </span>
                </div>
            </div>
            <!--end::Details toggle-->

            <!--begin::Details content-->
            <div id="kt_user_view_details" class="collapse">
                <div class="pb-5 fs-6">
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">رقم العقد</div>
                    <div class="text-gray-600">#{{ $this->contract->id }}</div>
                    <!--begin::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">
                        @if($this->contract->user->is_person)
                            الرقم الشخصي
                        @else
                            رقم المؤسسة
                        @endif
                    </div>
                    <div class="text-gray-600">{{ $this->contract->user->id_human }}</div>
                    <!--begin::Details item-->

                    @if($this->contract->user->is_corporate)
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">رقم السجل</div>
                        <div class="text-gray-600">{{ $this->contract->user->corporate_id }}</div>

                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">المسؤول</div>
                        <div class="text-gray-600">{{ $this->contract->user->contact_name }}</div>

                    @endif
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">البريد الإلكتروني</div>
                    <div class="text-gray-600">{{ $this->contract->user->email }}</div>

                    @if($this->contract->User->is_person)
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">الجنسية</div>
                        <div class="text-gray-600">{{ ($this->contract->user->nationality) ? $this->contract->user->nationality->name : '-' }}</div>

                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">الجنس</div>
                        <div class="text-gray-600">{{ $this->contract->user->gender_string }}</div>

                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">رقم الهاتف</div>
                        <div class="text-gray-600">{{ $this->contract->user->phone }}</div>
                    @endif

                    @if($this->contract->user->is_corporate)
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">رقم هاتف التواصل</div>
                        <div class="text-gray-600">{{ $this->contract->user->contact_phone }}</div>
                    @endif

                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">الواتساب</div>
                    <div class="text-gray-600">{{ $this->contract->user->whatsapp_phone }}</div>
                    <!--begin::Details item-->
                </div>
            </div>
            <!--end::Details content-->

            <!--end::Details toggle-->
            <div class="separator separator-dashed my-5"></div>
            <!--begin::Details content-->

            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_attachments" role="button" aria-expanded="false" aria-controls="kt_user_view_attachments">
                    المرفقات
                    <span class="ms-2 rotate-180">
                        <i class="ki-outline ki-down fs-3"></i>
                    </span>
                </div>
            </div>
            <!--end::Details toggle-->

            <!--begin::Details content-->
            <div id="kt_user_view_attachments" class="collapse">
                <div class="pb-5 fs-6">

                    @foreach($attachments_list as $attachment_types => $attachments)
                        @if($attachment_types and $attachment_types != 'common')
                            @php
                                $attachment_types = explode('|', $attachment_types);
                                foreach ($attachment_types as $attachment_type) {
                                    if(!($this->contract->user->{'is_'.$attachment_type})){
                                        continue 2;
                                    }
                                }
                            @endphp
                        @endif

                        @foreach($attachments as $attachment)
                            <!--begin::File-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('admin-assets/media/svg/files/pdf.svg') }}"/>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-semibold">
                                    <span class="fs-6 fw-bold text-dark text-hover-primary">
                                        {{ $attachment['title'] }}
                                    </span>
                                    <div class="text-gray-400">
                                        @if(isset($this->contract->user->{$attachment['attribute']}))
                                            <a href="{{ $this->contract->user->getAttachmentDiskPath($attachment['attribute']) }}" target="_blank">معاينة المستند</a>
                                        @else
                                            <a>لا يوجد مستند</a>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                        @endforeach

                    @endforeach

                </div>
            </div>
            <!--end::Details content-->

        </div>
        <!--end::Card body-->
    </div>
</div>
