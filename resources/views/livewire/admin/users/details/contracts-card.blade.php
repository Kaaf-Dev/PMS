<div>
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>العقود</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2">
            @if (count($this->contracts))
                <!--begin::Tab Content-->
                <div id="kt_referred_users_tab_content" class="tab-content">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                            <!--begin::Thead-->
                            <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                            <tr class="text-start text-gray-400">
                                <th class="w-10px pe-2">#</th>
                                <th class="min-w-auto">العقار</th>
                                <th class="min-w-auto">الوحدة</th>
                                <th class="min-w-auto">الحالة</th>
                                <th class="min-w-auto">بداية العقد</th>
                                <th class="min-w-auto">نهاية العقد</th>
                                <th class="text-end min-w-100px">العمليات</th>
                            </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fs-6 fw-semibold text-gray-600">
                            @if($this->contracts)

                                @forelse($this->contracts as $contract)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Checkbox-->
                                        <td>
                                            {{ $contract->id }}
                                        </td>
                                        <!--end::Checkbox-->
                                        <!--begin::User=-->
                                        <td>
                                            <a href="{{ route('admin.property.details', ['property_id' => $contract->apartment->property->id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                                {{ $contract->apartment->property->name }}
                                            </a>
                                        </td>
                                        <!--end::User=-->
                                        <!--begin::User=-->
                                        <td>
                                            <a href="{{ route('admin.property.apartment.details', ['property_id' => $contract->apartment->property->id, 'apartment_id' => $contract->apartment->id]) }}" class="text-gray-800 text-hover-primary mb-1">
                                                {{ $contract->apartment->name }}
                                            </a>
                                        </td>
                                        <!--end::User=-->
                                        <!--begin::Role=-->
                                        <td>
                                    <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                        {{ $contract->activeStatusString }}
                                    </span>
                                        </td>

                                        <!--end::Role=-->
                                        <!--begin::Joined-->
                                        <td>{{ ($contract->start_at)? $contract->start_at->format('Y/m/d') : '-' }}</td>
                                        <td>{{ ($contract->end_at)? $contract->end_at->format('Y/m/d') : '-' }}</td>
                                        <!--begin::Joined-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}"
                                               class="btn btn-light btn-active-light-primary btn-sm">
                                                <i class="fa-solid fa-gear"></i>
                                            </a>
                                        </td>
                                        <!--end::Action=-->
                                    </tr>
                                    <!--end::Table row-->
                                @empty
                                    <tr>
                                        <td colspan="100%">

                                            <div class="d-flex flex-column flex-center">
                                                <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                                     class="mw-350px">
                                                <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                                <div class="fs-6"></div>
                                            </div>


                                        </td>
                                    </tr>
                                @endforelse

                            @endif
                            </tbody>
                            <!--end::Tbody-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Tab Content-->
            @else
                <div class="text-center px-4">
                    <img class="mw-100 mh-300px" alt="" src="{{ asset('admin-assets/media/illustrations/unitedpalms-1/19.png') }}">
                    <h4>لا يوجد فواتير مستحقة</h4>
                </div>
            @endif
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
