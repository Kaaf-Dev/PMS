<div>
    <div class="card card-flush pt-3 mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">عقد الإيجار</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-3">
            <!--begin::Section-->
            <div class="mb-10">
                <!--begin::Details-->
                <div class="d-flex flex-wrap pb-2">
                    <!--begin::Row-->
                    <div class="flex-equal me-5">
                        <!--begin::Details-->
                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                            <!--begin::Row-->
                            <tr>
                                <td class="text-gray-400">الحالة:</td>
                                <td class="text-gray-800">
                                    <span class="badge badge-light-{{ $this->contract->active_status_class }}">{{ $this->contract->active_status_string }}</span>
                                </td>
                            </tr>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <tr>
                                <td class="text-gray-400">الإيجار: </td>
                                <td class="text-gray-800">{{ $this->contract->cost }}</td>
                            </tr>
                            <!--end::Row-->
                        </table>
                        <!--end::Details-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="flex-equal">
                        <!--begin::Details-->
                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                            <!--begin::Row-->
                            <tr>
                                <td class="text-gray-400">تاريخ البداية:</td>
                                <td class="text-gray-800">{{ $this->contract->start_at->format('Y-m') }}</td>
                            </tr>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <tr>
                                <td class="text-gray-400">فعّال لغاية:</td>
                                <td class="text-gray-800">{{ $this->contract->end_at->format('Y-m') }}</td>
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

            <!--begin::Title-->
            <h5 class="mb-4">العقارات</h5>
            <!--end::Title-->
            <!--begin::Details-->
            <div class="mb-4">
                <!--begin::Details-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table head-->
                        <thead>
                        <tr>
                            <th class="p-0 w-50px"></th>
                            <th class="p-0 min-w-auto"></th>
                            <th class="p-0 min-w-40px"></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @forelse($this->contract->apartments ?? [] as $selected_apartment)
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px me-2">
                                                        <span class="symbol-label">
                                                            {!! $selected_apartment['icon_svg'] !!}
                                                        </span>
                                    </div>
                                </td>
                                <td>
                                    {{ $selected_apartment['name'] }}
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        {{ $selected_apartment['property']['name'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info">
                                        لا يوجد عقارات محددة بعد!
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Details-->
            </div>
            <!--end::Details-->


        </div>
    </div>
</div>
