<!DOCTYPE html>
<!--
BePro Team
www.ebepro.com
-->
<html lang="en">
<!--begin::Head-->
<head><base>
    <title>{{ env('APP_NAME', 'BePro Team') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Property Management System - BePro Team" />
    <meta name="keywords" content="bepro, team, property, management, system, quality, solution, php, laravel, livewire" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME', 'BePro Team') }}" />
    <meta property="og:url" content="{{ env('APP_URL', 'https://www.ebepro.com') }}" />
    <meta property="og:site_name" content="Property Management System" />
    <link rel="canonical" href="{{ env('APP_URL', 'https://www.ebepro.com') }}" />
    <link rel="shortcut icon" href="{{ asset('admin-assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @livewireStyles

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    {{ $slot }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap px-5">
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base">
                    <a href="#" class="px-5" target="_blank">Terms</a>
                    <a href="#" class="px-5" target="_blank">Plans</a>
                    <a href="#" class="px-5" target="_blank">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('admin-assets/media/misc/auth-bg.png') }})">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->
                <a href="#" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('admin-assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
                </a>
                <!--end::Logo-->
                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('admin-assets/media/misc/auth-screens.png') }}" alt="" />
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                <!--end::Title-->
                <!--begin::Text-->
{{--                <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,--}}
{{--                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed--}}
{{--                    <br />and provides some background information about--}}
{{--                    <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their--}}
{{--                    <br />work following this is a transcript of the interview.--}}
{{--                </div>--}}
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->



<script>var hostUrl = "admin-assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

@livewireScripts

@stack('js')

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
