<div>
    <div class="card card-flush">
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                    <tr>
                        <th class="">المستأجر</th>
                        <th class="">رقم العقد</th>
                        <th class="">حالة العقد</th>
                        <th class="min-w-50px text-end">إدارة</th>
                    </tr>
                    </thead>
                    <tbody class="fs-6">
                    @forelse($contracts ?? [] as $contract)
                        <tr>
                            <td>
                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Wrapper-->
                                    <div class="me-5 position-relative">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px me-3">
                                            <img src="{{ $contract->user->profile_photo_url }}" class="" alt="">
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <span class="mb-1 text-gray-800">{{ $contract->user->name }}</span>
                                        <div class="fw-semibold fs-6 text-gray-400">CPR: {{ $contract->user->cpr }}</div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </td>
                            <td>
                                #{{ $contract->id }}
                            </td>
                            <td>
                                <span class="badge badge-light-{{ $contract->activeStatusClass }} fs-7 fw-bold">
                                    {{ $contract->activeStatusString }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('lawyer.contracts.details', ['contract_id' => $contract->id]) }}" class="btn btn-light btn-sm">عرض</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">

                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('lawyer-assets/media/illustrations/sigma-1/5.png') }}"
                                         class="mw-350px">
                                    <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد عقود تم توكيلك بها</div>
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

            @if($contracts)
                {{ $contracts->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
</div>
