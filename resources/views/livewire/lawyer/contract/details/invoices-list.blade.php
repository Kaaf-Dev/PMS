<div>
    <div class="card card-flush pt-3 mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>الفواتير</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <!--begin::Tab nav-->
                <ul class="nav nav-stretch fs-5 fw-semibold nav-line-tabs nav-line-tabs-2x border-transparent" role="tablist">
                    @foreach($this->invoices->keys() ?? [] as $year)
                        <li class="nav-item" role="presentation">
                            <a id="kt_referrals_{{ $year }}_tab" class="nav-link text-active-primary ms-3 @if($loop->first) active @endif" data-bs-toggle="tab" role="tab" href="#details_invoices_{{ $year }}">{{ $year }}</a>
                        </li>
                    @endforeach
                </ul>
                <!--end::Tab nav-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2">
            @if (count($this->invoices))
                <!--begin::Tab Content-->
                <div id="kt_referred_users_tab_content" class="tab-content">
                    @foreach($this->invoices ?? [] as $year => $invoices)
                        <!--begin::Tab panel-->
                        <div id="details_invoices_{{ $year }}" class="tab-pane fade @if($loop->first) show active @endif" role="tabpanel">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="details_invoices_table_{{ $year }}" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                    <!--begin::Thead-->
                                    <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                    <tr class="text-start text-gray-400">
                                        <th class="min-w-100px">رقم الفاتورة</th>
                                        <th class="min-w-100px align-left">المبلغ</th>
                                        <th class="min-w-100px">الحالة</th>
                                        <th class="min-w-100px">الاستحقاق</th>
                                        <th class="min-w-100px">النوع</th>
                                        <th class="min-w-100px">ملاحظات</th>
                                        <th class="w-100px">الفاتورة</th>
                                    </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>
                                                <a href="#{{ $invoice->id }}" class="text-gray-600 text-hover-primary">{{ $invoice->no }}</a>
                                            </td>
                                            <td class="text-{{ $invoice->paid_class }}">
                                                {{ $invoice->amount }}
                                            </td>
                                            <td>
                                                <span class="badge badge-light-{{ $invoice->paid_class }}">{{ $invoice->paid_string }}</span>
                                            </td>
                                            <td>
                                                {{ $invoice->due->format('M d, Y') }}
                                            </td>
                                            <td>
                                                {{ $invoice->type_string }}
                                            </td>
                                            <td>
                                                @if($invoice->notes)
                                                    {{ $invoice->notes }}
                                                @else
                                                    <span class="badge badge-square bg-gray-700">لا يوجد</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Tab panel-->
                    @endforeach
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
</div>
