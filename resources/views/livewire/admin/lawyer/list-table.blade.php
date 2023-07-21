<div>
    <div wire:init="load" class="card card-flush">


        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="البحث في الجهات القانونية">
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end">
                    <!--begin::Add user-->
                    <button wire:click="showAddLawyer" type="button" class="btn btn-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        تسجيل جديد
                    </button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                    <tr>
                        <th class="min-w-20px">#</th>
                        <th class="min-w-150px">الجهة القانونية</th>
                        <th class="min-w-150px">المسؤول</th>
                        <th class="min-w-150px">رقم الهاتف</th>
                        <th class="min-w-250px">العنوان</th>
                        <th class="min-w-50px text-end">إدارة</th>
                    </tr>
                    </thead>
                    <tbody class="fs-6">
                    @forelse($lawyers ?? [] as $layer)
                        <tr>
                            <td>{{ $layer->id }}</td>
                            <td>{{ $layer->name }}</td>
                            <td>{{ $layer->contact_name }}</td>
                            <td>{{ $layer->contact_phone }}</td>
                            <td>{{ $layer->contact_address }}</td>
                            <td class="text-end">
                                <a wire:click="updateLawyer('{{ $layer->id }}')" class="btn btn-light btn-sm">إدارة</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">

                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                         class="mw-350px">
                                    <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد جهات قانونية!</div>
                                    <div class="fs-6"></div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->

            @if($lawyers)
                {{ $lawyers->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
</div>
