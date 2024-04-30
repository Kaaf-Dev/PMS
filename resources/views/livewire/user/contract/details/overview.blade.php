<div>
    <!--begin::Card-->
    <div class="card card-flush pt-3 mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">بيانات عقد الإيجار</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-3">
            <div class="d-flex flex-column flex-xl-row">

                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">

                    <!--begin::Section-->
                    <div class="mb-10">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap py-5">
                            <!--begin::Row-->
                            <div class="flex-equal me-5">
                                <!--begin::Details-->
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400 min-w-175px w-175px">الحالة:</td>

                                        <td class="text-gray-800">
                                            <span class="badge badge-{{ $this->contract->active_status_class }}">
                                                {{ $this->contract->active_status_string }}
                                            </span>
                                        </td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">المستأجر:</td>
                                        <td class="text-gray-800">{{ $this->contract->user->name }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">قيمة الإيجار</td>
                                        <td class="text-gray-800">{{ $this->contract->costHuman }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">بداية العقد</td>
                                        <td class="text-gray-800">{{ $this->contract->startAtHuman }}</td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr>
                                        <td class="text-gray-400">نهاية العقد</td>
                                        <td class="text-gray-800">{{ $this->contract->endAtHuman }}</td>
                                    </tr>
                                    <!--end::Row-->
                                </table>
                                <!--end::Details-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="mb-0">
                        <!--begin::Title-->
                        <h3 class="mb-4">
                            <a wire:click="toggleApartment" class="btn btn-dark btn-sm">
                                @if($show_apartments)
                                    <i class="ki-duotone ki-eye-slash fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                    إخفاء
                                @else
                                    <i class="ki-duotone ki-eye fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                    عرض الوحدات
                                @endif

                            </a>
                        </h3>
                        <!--end::Title-->

                        @if($show_apartments)
                            <!--begin::Product table-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-25px"></th>
                                        <th class="min-w-75px">العقار</th>
                                        <th class="min-w-125px">الوحدة السكنية</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-800">
                                    @forelse($this->contract->apartments ?? [] as $apartment)
                                        <tr>
                                            <td>
                                                <div class="symbol">
                                            <span class="symbol-label bg-light-primary text-primary">
                                                {!! $apartment->icon_svg !!}
                                            </span>
                                                </div>
                                            </td>
                                            <td>{{ $apartment->property->name }}</td>
                                            <td>{{ $apartment->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">

                                                <div class="d-flex flex-column flex-center">
                                                    <img src="{{ asset('user-assets/media/illustrations/sigma-1/5.png') }}" class="mw-350px">
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
                            <!--end::Product table-->
                        @endif

                    </div>
                    <!--end::Section-->
                </div>

            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
