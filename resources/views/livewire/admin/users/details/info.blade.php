<!--begin::Card body-->
<div class="card-body">
    <!--begin::Summary-->
    <!--begin::User Info-->
    <div class="d-flex flex-center flex-column py-5">
        <!--begin::Avatar-->
        <div class="symbol symbol-100px symbol-circle mb-7">
            @if(isset($user->user_image_path))
            <img src="{{\Illuminate\Support\Facades\URL::asset('user-image/'.$user->user_image_path)}}" alt="image" />
            @endif
        </div>
        <!--end::Avatar-->
        <!--begin::Name-->
        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->name }}</a>
        <!--end::Name-->
    </div>
    <!--end::User Info-->
    <!--end::Summary-->
    <!--begin::Details toggle-->
    <div class="d-flex flex-stack fs-4 py-3">
        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">التفاصيل
            <span class="ms-2 rotate-180">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
            <span class="svg-icon svg-icon-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                        fill="currentColor"/>
                </svg>
            </span>
                <!--end::Svg Icon-->
        </span></div>
    </div>
    <!--end::Details toggle-->
    <div class="separator"></div>
    <!--begin::Details content-->
    <div id="kt_user_view_details" class="collapse show">
        <div class="pb-5 fs-6">
            <!--begin::Details item-->
            @if($user->user_type == 1)
                <div class="fw-bold mt-5">
                    الرقم الشخصي
                </div>
                <div class="text-gray-600">{{$user->cpr}}</div>
            @else
                <div class="fw-bold mt-5">
                    رقم المؤسسة
                </div>
                <div class="text-gray-600">{{$user->corporate_id}}</div>
            @endif

            <!--begin::Details item-->
            <!--begin::Details item-->
            <div class="fw-bold mt-5">البريد الإلكتروني</div>
            <div class="text-gray-600">
                <a href="#" class="text-gray-600 text-hover-primary">{{$user->email}}</a>
            </div>
            <!--begin::Details item-->
            <!--begin::Details item-->
{{--            <div class="fw-bold mt-5">Address</div>--}}
{{--            <div class="text-gray-600">101 Collin Street,--}}
{{--                <br />Melbourne 3000 VIC--}}
{{--                <br />Australia</div>--}}
{{--            <!--begin::Details item-->--}}
{{--            <!--begin::Details item-->--}}
{{--            <div class="fw-bold mt-5">Language</div>--}}
{{--            <div class="text-gray-600">English</div>--}}
{{--            <!--begin::Details item-->--}}
{{--            <!--begin::Details item-->--}}
{{--            <div class="fw-bold mt-5">Last Login</div>--}}
{{--            <div class="text-gray-600">20 Dec 2022, 11:05 am</div>--}}
            <!--begin::Details item-->
        </div>
    </div>
    <!--end::Details content-->

</div>
<!--end::Card body-->
