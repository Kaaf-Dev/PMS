<div class="row g-6 g-xl-9">
    <!--begin::Col-->
    <div class="col-lg-12">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">المرفقات</span>
                </h3>
                <div class="card-toolbar">
                    <button wire:click="showAddPropertyFileModal" class="btn btn-sm btn-light-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        إضافة جديد
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-325px rounded-start">المرفق</th>
                            <th class="min-w-auto text-end rounded-end"></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @forelse($property->files as $file)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $file->file_name }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-end">
                                    <a wire:click="deleteFile({{$file->id}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fas fa-trash"></i>
                                        <!--end::Svg Icon-->
                                    </a>

                                    <a target="_blank" href="{{$file->MainImagePath}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fas fa-download"></i>
                                        <!--end::Svg Icon-->
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%">

                                    <div class="d-flex flex-column flex-center">
                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-350px">
                                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                        <div class="fs-6"></div>
                                    </div>

                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>
    <!--end::Col-->
</div>
