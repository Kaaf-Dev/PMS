<div wire:init="fetch">
    <div class="card card-flush">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">
                    الفواتير المستحقة
                </span>
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
                            <th class="p-0 min-w-auto"></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody style="cursor: pointer">
                        @forelse($invoices as $invoice)
                            <tr class="align-middle">
                                <!-- Invoice Number -->
                                <td>
                                    <div class="fw-semibold">
                                        <span class="text-muted fs-8"># الفاتورة</span>
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6 d-block mt-1">
                                            {{ $invoice->no }}
                                        </a>
                                    </div>
                                </td>

                                <!-- Invoice Amount -->
                                <td>
                                    <div class="fw-semibold">
                                        <span class="text-muted fs-8">القيمة</span>
                                        <span class="text-dark fw-bold fs-7 d-block mt-1">
                        {{ $invoice->unPaidAmount }} دب
                    </span>
                                    </div>
                                </td>

                                <!-- Due Date -->
                                <td>
                                    <div class="fw-semibold">
                                        <span class="text-muted fs-8">الاستحقاق</span>
                                        <span class="text-dark fw-bold fs-7 d-block mt-1">{{ $invoice->due_human }}</span>
                                    </div>
                                </td>

                                <!-- Unpaid Amount (Pay Button) -->
                                <td>
                                    @if ($invoice->unPaidAmount > 0)
                                        <a href="{{route('user.pay', $invoice->id)}}"
                                            class="btn btn-danger btn-sm fw-bold">
                                            دفع
                                        </a>
                                    @else
                                        <span class="badge badge-success fs-8 fw-bold">مدفوعة</span>
                                    @endif
                                </td>

                                <!-- Print Button -->
                                <td>
                                    <button
                                        wire:click.stop="printInvoice('{{ $invoice->id }}')"
                                        class="btn btn-sm btn-light btn-active-light-primary">
                                        طباعة
                                    </button>
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
