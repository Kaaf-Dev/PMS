<!DOCTYPE html>
<!--
BePro Team
www.ebepro.com
-->
<html @if (App::isLocale('ar')) direction="rtl" dir="rtl" style="direction: rtl" @else lang="en" @endif>
<!--begin::Head-->
<head><base href=""/>
    <title>{{ env('APP_NAME', 'kaaf') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Property Management System - Quality-Solutions" />
    <meta name="keywords" content="bepro, team, property, management, system, quality, solution, php, laravel, livewire" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME', 'kaaf') }}" />
    <meta property="og:url" content="{{ env('APP_URL', 'https://www.quality-solution.net') }}" />
    <meta property="og:site_name" content="Property Management System" />
    <link rel="canonical" href="{{ env('APP_URL', 'https://www.quality-solution.net') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    @if (App::isLocale('ar'))
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="{{ asset('lawyer-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('lawyer-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('lawyer-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    @else
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('lawyer-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('lawyer-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    @endif


    @stack('css')
    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <!--begin::Header-->
            <livewire:layoutes.lawyer.app-header />
        <!--end::Header-->

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Wrapper container-->
            <div class="app-container container-xxl d-flex flex-row-fluid">
                <!--begin::Sidebar-->
                <livewire:layoutes.lawyer.app-sidebar />
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        {{ $slot }}
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <livewire:layoutes.lawyer.app-footer />
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--begin::Drawers-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-outline ki-arrow-up"></i>
</div>
<!--end::Scrolltop-->
<!--begin::Modals-->

<!--begin::Modals-->
@stack('modals')
<!--end::Modals-->

<!--end::Modals-->
<!--begin::Javascript-->
<script>var hostUrl = "lawyer-assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('lawyer-assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('lawyer-assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

@livewireScripts

<script src="{{ asset('lawyer-assets/js/livewire/swal-alert.js') }}"></script>
<script src="{{ asset('lawyer-assets/js/livewire/modals.js') }}"></script>

@stack('js')

@include('modals.lawyer')

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
