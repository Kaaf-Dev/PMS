<div>
    {{-- The whole world belongs to you. --}}

    <div class="card card-flush pt-3 mb-5 mb-xl-10">
        <!--begin::Header-->
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">فواتير المحاماة</h3>
            </div>

            <div class="card-toolbar">
                <button wire:click="createInvoice" class="btn btn-primary btn-sm">
                    <i class="ki-outline ki-plus"></i>
                    إنشاء فاتورة جديدة
                </button>
            </div>

        </div>
        <!--end::Header-->
        <div class="card-body">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th class="min-w-30px">#</th>
                        <th class="min-w-140px">رسوم المحكمة</th>
                        <th class="min-w-140px">رسوم المنفذ الخاص</th>
                        <th class="min-w-140px">أتعاب المحامي</th>
                        <th class="min-w-140px">أخرى</th>
                        <th class="min-w-120px">الحالة</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @forelse($this->invoices ?? [] as $lawyer_invoice)
                        <tr>
                            <td>
                                <a class="text-dark fw-bold text-hover-primary fs-6">{{ $lawyer_invoice->id }}</a>
                            </td>
                            <td>
                                <a class="text-dark fw-bold text-hover-primary fs-6">{{ $lawyer_invoice->court_fees }}</a>
                            </td>
                            <td>
                                <a class="text-dark fw-bold text-hover-primary fs-6">{{ $lawyer_invoice->executor_fees }}</a>
                            </td>
                            <td>
                                <a class="text-dark fw-bold text-hover-primary fs-6">{{ $lawyer_invoice->attorneys_fees }}</a>
                            </td>
                            <td>
                                <a class="text-dark fw-bold text-hover-primary fs-6">{{ $lawyer_invoice->other }}</a>
                            </td>
                            <td>
{{--                                <span class="badge badge-light-success">Approved</span>--}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <div class="alert alert-info">
                                    لا يوجد فواتير محددة بعد!
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
    </div>




</div>
