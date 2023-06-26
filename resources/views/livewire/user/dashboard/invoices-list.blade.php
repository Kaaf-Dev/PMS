<div wire:init="fetch" class="h-xl-100">
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">
                    الفواتير المستحقة
                </span>
                <a href="#" class="text-gray-400 mt-1 fw-semibold fs-6 mt-2">عرض الجميع</a>
            </h3>
            <!--end::Title-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2"></i>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5">
            <!--begin::Items-->
            <div class="">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                        <tr>
                            <th class="p-0 min-w-auto"></th>
                            <th class="p-0 min-w-auto"></th>
                            <th class="p-0 min-w-auto"></th>
                            <th class="p-0 min-w-auto"></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>


                        @forelse($invoices as $invoice)
                            <tr>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-8">#الفاتورة</span>
                                    <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $invoice->no }}</a>
                                </td>
                                <td class="">
                                    <span class="text-muted fw-semibold d-block fs-8">القيمة</span>
                                    <span class="text-dark fw-bold d-block fs-7">{{ $invoice->amount_human }}</span>
                                </td>
                                <td class="">
                                    <span class="text-muted fw-semibold d-block fs-8">الاستحقاق</span>
                                    <span class="text-dark fw-bold d-block fs-7">{{ $invoice->due_human }}</span>
                                </td>
                                <td class="">
                                    <span class="badge badge-light-{{ $invoice->paid_class }} fs-7 fw-bold">
                                        {{ $invoice->paid_string }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            @if (empty($invoices))
                                الرجاء الانتظار...
                            @else
                                لا يوجد بيانات
                            @endif
                        @endforelse
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>


            </div>
            <!--end::Items-->
        </div>
        <!--end: Card Body-->
    </div>
</div>
