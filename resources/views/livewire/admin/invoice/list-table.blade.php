<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="رقم الفاتورة" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex  btn-info btn-active-color-white fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>بحث</a>
                        <!--end::Menu toggle-->

                        <!--begin::Menu toggle-->
                        <button wire:click="exportExcel" class="btn btn-sm btn-flex  btn-success btn-active-color-white fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-file-up fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>تصدير</button>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac4061cc0f">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">خيارات البحث</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">العقد:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="contract_id" id="contract_id" class="form-select form-select-solid select-multi">
                                            <option label="الجميع">الجميع</option>
                                            @foreach($contracts as $contract)
                                                <option value="{{$contract->id}}">{{$contract->User->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">الحالة:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select wire:model="paid_type" class="form-select form-select-solid">
                                            <option selected label="الجميع">الجميع</option>
                                            <option value="1">مدفوعة</option>
                                            <option value="2">غير مدفوعة</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">التاريخ من:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <input wire:model.defer="due_at" class="form-control" type="date">
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">التاريخ إلى:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <input wire:model.defer="due_end" class="form-control" type="date">
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="d-flex justify-content-center">
                                    <!--begin::Input-->
                                    <div>
                                        <button wire:click="loadInvoices" class="btn btn-primary">بحث</button>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->






                                {{--                                <!--begin::Actions-->--}}
                                {{--                                <div class="d-flex justify-content-end">--}}
                                {{--                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>--}}
                                {{--                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>--}}
                                {{--                                </div>--}}
                                {{--                                <!--end::Actions-->--}}
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">

            <div wire:loading.class="table-loading" wire:target="load" class="table-responsive">
                <div class="table-loading-message">
                    Loading...
                </div>

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="min-w-125px">الاسم</th>
                        <th class="min-w-125px">رقم العقد</th>
                        <th class="min-w-125px">المبلغ</th>
                        <th class="min-w-125px">التاريخ</th>
                        <th class="min-w-125px">الحالة</th>

                        <th class="text-end min-w-100px"></th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">

                    @if($invoices)

                        @forelse($invoices as $invoice)
                            <!--begin::Table row-->
                            <tr>
                                <td>
                                    {{ $invoice->no }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.users.details', ['user_id' => $invoice->Contract->User->id]) }}"
                                       class="text-gray-800 text-hover-primary mb-1">{{ $invoice->Contract->User->name }}</a>
                                </td>
                                <!--end::Property-->

                                <td>{{$invoice->contract_id}}</td>

                                <td>{{$invoice->amount}}</td>

                                <td>{{$invoice->DueHuman}}</td>

                                <td>{{$invoice->PaidString}}</td>


                                <!--begin::Action=-->
                                <td class="text-end">

                                    <button wire:click="printInvoice({{$invoice->id}})" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">طباعة</button>


                                @if(!$invoice->IsPaid)
                                        <button wire:click="paidInvoice({{$invoice->id}})" class="btn btn-info btn-sm me-1">
                                            تسديد
                                        </button>
                                    @endif


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
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>

            @if($invoices)
                {{ $invoices->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
@push('js')
    <script>
        document.addEventListener('livewire:load', function (event) {
            window.Livewire.hook('message.processed', () => {
                $('.select-multi').select2();

                $('#contract_id').on('change', function (e) {
                    let elementName = $(this).attr('id');
                    var data = $(this).select2("val");
                @this.set(elementName, data);
                });
            });
        });
    </script>
@endpush
