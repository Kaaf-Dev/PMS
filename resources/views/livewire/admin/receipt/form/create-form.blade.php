<div>
    <form wire:submit.prevent="save" id="kt_invoice_form">
        <!--begin::Wrapper-->
        <div class="mb-0">
            <!--begin::Row-->
            <div class="row gx-10 mb-5">
                <!--begin::Col-->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fs-6 fw-bold text-gray-700 mb-3">العقد</label>
                    @error('invoice.contract_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    @if($this->selected_contract)
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                            <div class="d-flex align-items-center p-3 mb-2">
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary">
                                        رقم العقد#: {{ $this->selected_contract->id}}
                                        <br>
                                        {{ $this->selected_contract->user->name }}
                                    </a>
                                    <!--end::Name-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Button-->
                                <a wire:click="selectContract()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Button-->
                            </div>

                        </div>

                        <button wire:click="selectAll" type="button" class="btn btn-primary w-100 mt-4">
                            <!--begin::Indicator label-->
                            <span wire:loading.remove wire:target="selectAll">
                                                        <i class="fas fa-list-check"></i>
                                اختيار جميع الفواتير
                                                    </span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span wire:loading wire:target="selectAll">
                                                        الرجاء الانتظار
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                            <!--end::Indicator progress-->
                        </button>

                        <div class="mh-350px scroll-y p2 mt-4">

                            @forelse($this->selected_contract->unPaidInvoices ?? [] as $invoice)

                                <!--begin::Apartment-->
                                <div class="border border-dashed border-primary p-7 rounded mb-7
                                @if($this->isSelected($invoice->id))
                                bg-light-primary
                                @endif
                                ">
                                    <!--begin::Id-->
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <p class="text-muted">
                                                <span class="text-black">
                                                    الفاتورة#:
                                                </span>
                                                {{ $invoice->no }}
                                            </p>
                                        </div>
                                        <!--begin::Label-->
                                        <span class="badge badge-light-{{ $invoice->paid_class }} d-flex align-items-center fs-8 fw-semibold">
                                            {{ $invoice->paid_string }}
                                        </span>
                                        <!--end::Label-->
                                    </div>
                                    <div class="d-block mb-3">
                                        <p class="text-muted">
                                            <span class="text-black">
                                                القيمة المستحقة:
                                            </span>
                                            {{ $invoice->unPaidAmountHuman }}
                                        </p>
                                    </div>
                                    <!--end::Id-->
                                    <!--begin::Wrapper-->
                                    <div class="p-0">
                                        <!--begin::Footer-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Separator-->
                                            <div class="separator separator-dashed border-muted my-5"></div>
                                            <!--end::Separator-->
                                            <!--begin::Action-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Progress-->
                                                <div class="d-flex flex-column mw-200px">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Cost-->
                                                            <span class="text-dark fw-bold fs-5">{{ $invoice->amount_human }}</span>
                                                            <!--end::Cost-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Progress-->
                                                <!--begin::Button-->


                                                <!--end::Button-->
                                                <!--begin::Button-->

                                                @if($this->isSelected($invoice->id))
                                                    <a wire:click="removeInvoice('{{ $invoice->id }}')" class="btn btn-sm btn-danger">
                                                        <!--begin::Indicator label-->
                                                        <span wire:loading.remove wire:target="removeInvoice('{{ $invoice->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                        حذف من قائمة الاختيار
                                                    </span>
                                                        <!--end::Indicator label-->
                                                        <!--begin::Indicator progress-->
                                                        <span wire:loading wire:target="removeInvoice('{{ $invoice->id }}')">
                                                        الرجاء الانتظار
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                        <!--end::Indicator progress-->
                                                    </a>
                                                @else
                                                    <a wire:click="selectInvoice('{{ $invoice->id }}')" class="btn btn-sm btn-primary">
                                                        <!--begin::Indicator label-->
                                                        <span wire:loading.remove wire:target="selectInvoice('{{ $invoice->id }}')">
                                                        <i class="fas fa-check"></i>
                                                        اختيار
                                                    </span>
                                                        <!--end::Indicator label-->
                                                        <!--begin::Indicator progress-->
                                                        <span wire:loading wire:target="selectInvoice('{{ $invoice->id }}')">
                                                        الرجاء الانتظار
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                        <!--end::Indicator progress-->
                                                    </a>
                                                @endif
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Footer-->

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Apartment-->
                            @empty
                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('admin-assets/media/illustrations/unitedpalms-1/7.png') }}" class="mw-250px">
                                    <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد فواتير مستحقة للدفع!</div>
                                    <div class="fs-6"></div>
                                </div>
                            @endif
                        </div>

                    @else
                        <div class="w-100">
                            <div class="text-gray-500 fw-semibold fs-5 my-4">البحث عن العقود المتاحة</div>

                            <div class="w-100 position-relative mb-5" autocomplete="off">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Input-->
                                <input wire:model="search_contract" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="البحث عن العقود">
                                <!--end::Input-->
                                <!--begin::Spinner-->
                                <span wire:loading.class.remove="d-none" wire:target="search_contract" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                        </span>
                                <!--end::Spinner-->
                                <!--begin::Reset-->
                                <span wire:click="clearSearchApartment" wire:loading.remove wire:target="search_contract" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search_contract) d-none @endif">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                    <!--end::Svg Icon-->
                                        </span>
                                <!--end::Reset-->
                            </div>

                            <div class="mh-350px scroll-y me-n7 pe-7">

                                @forelse($this->contracts ?? [] as $contract)

                                    <!--begin::Apartment-->
                                    <div class="border border-hover-primary p-7 rounded mb-7 @if(!$contract->active) bg-light-danger @endif">
                                        <!--begin::Id-->
                                        <div class="d-flex flex-stack pb-3">
                                            <div class="d-flex">
                                                <p class="text-muted">
                                                    رقم العقد#:
                                                    {{ $contract->id }}
                                                </p>



                                            </div>
                                            <!--begin::Label-->
                                            @if($contract->active)
                                                <span class="badge badge-light-success d-flex align-items-center fs-8 fw-semibold">
                                                        فعّال
                                                    </span>
                                            @else
                                                <span class="badge badge-light-danger d-flex align-items-center fs-8 fw-semibold">
                                                        غير فعّال
                                                    </span>
                                            @endif
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Id-->
                                        <!--begin::Wrapper-->
                                        <div class="p-0">
                                            <!--begin::Section-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Separator-->
                                                <div class="separator separator-dashed border-muted mb-5"></div>
                                                <!--end::Separator-->
                                                <!--begin::Action-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Progress-->
                                                    <div class="d-flex flex-column mw-200px">
                                                        <div class="d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px symbol-circle me-3">
                                                                    <img src="{{ $contract->user->profile_photo_url }}" alt="$contract->user->name">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('admin.users.details', ['user_id' => $contract->user->id]) }}" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                        {{ $contract->user->name }}
                                                                    </a>
                                                                    <span class="text-muted fw-semibold d-block fs-7">
                                                                            {{ $contract->user->cpr }}
                                                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Footer-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Separator-->
                                                <div class="separator separator-dashed border-muted my-5"></div>
                                                <!--end::Separator-->
                                                <!--begin::Action-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Progress-->
                                                    <div class="d-flex flex-column mw-200px">
                                                        <div class="d-flex flex-column">
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Cost-->
                                                                <span class="text-dark fw-bold fs-5">{{ $contract->cost }}</span>
                                                                <span class="text-muted fs-7">/شهري</span>
                                                                <!--end::Cost-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Progress-->
                                                    <!--begin::Button-->
                                                    <a href="{{ route('admin.contracts.details', ['contract_id' => $contract->id]) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                        معاينة
                                                    </a>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <a wire:click="selectContract('{{ $contract->id }}')" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-check"></i>
                                                        اختيار
                                                    </a>
                                                    <!--end::Button-->
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Footer-->

                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Apartment-->
                                @empty
                                    <div class="d-flex flex-column flex-center">
                                        <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-250px">
                                        <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                        <div class="fs-6"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-lg-8 col-md-6">

                    @if(isset($this->selected_invoices['invoices']))

                        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">
                            الفواتير المحددة:
                        </label>


                        <div class="mh-400px scroll-y p2 mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="text-white" style="background-color: #481F66">
                                        <td>الفاتورة</td>
                                        <td>قيمة الفاتورة</td>
                                        <td>القيمة المدفوعة</td>
                                        <td>قيمة الخصم</td>
                                        <td>طريقة الدفع</td>
                                        <td>تاريخ السداد</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($this->selected_invoices['invoices'] ?? [] as $key => $selected_invoice)
                                        <tr wire:key="selected_invoice-{{ $key }}">
                                            <td>{{ $selected_invoice['no'] }}</td>
                                            <td>{{ $selected_invoice['origin_amount'] }}</td>
                                            <td>
                                                <!--begin::Input group-->
                                                <input wire:model="selected_invoices.invoices.{{ $selected_invoice['id'] }}.amount" type="number" step="0.01" class="form-control form-control-sm" />
                                                <!--end::Input group-->
                                            </td>
                                            <td>
                                                <!--begin::Input group-->
                                                <input wire:model="selected_invoices.invoices.{{ $selected_invoice['id'] }}.discount" type="number" step="0.01" class="form-control form-control-sm" />
                                                <!--end::Input group-->
                                            </td>
                                            <td>
                                                <!--begin::Input -->
                                                <select wire:model="selected_invoices.invoices.{{ $key }}.payment_method" class="form-control form-select">
                                                    <option value="">اختيار</option>
                                                    @foreach($this->paymentMethods as $payment_method_key => $payment_method)
                                                        <option value="{{ $payment_method_key }}">{{ $payment_method }}</option>
                                                    @endforeach
                                                </select>
                                                @error('selected_invoices.invoices.'. $key .'.payment_method')
                                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <!--end::Input -->

                                                @if ($this->selected_invoices['invoices'][$key]['payment_method']  == \App\Models\Receipt::PAYMENT_METHOD_CHEQUE or $this->selected_invoices['invoices'][$key]['payment_method'] == \App\Models\Receipt::PAYMENT_METHOD_BANK)
                                                    <!--begin::Input group-->
                                                        <input wire:model.defer="selected_invoices.invoices.{{ $key }}.bank_name" type="text" class="form-control" placeholder="اسم البنك">
                                                        @error('selected_invoices.invoices.'. $key .'.bank_name')
                                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    <!--end::Input group-->
                                                @endif

                                                @if ($this->selected_invoices['invoices'][$key]['payment_method'] == \App\Models\Receipt::PAYMENT_METHOD_CHEQUE)
                                                    <!--begin::Input group-->
                                                        <input wire:model.defer="selected_invoices.invoices.{{ $key }}.cheque_number" type="text" class="form-control" placeholder="رقم الشيك">
                                                        @error('selected_invoices.invoices.'. $key .'.cheque_number')
                                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    <!--end::Input group-->
                                                @endif

                                            </td>
                                            <td>
                                                <!--begin::Input group-->
                                                <div class="form-check">
                                                    <input wire:model="selected_invoices.invoices.{{ $key }}.receipt_date_as_invoice_due" class="form-check-input" type="checkbox" id="receipt_date_as_invoice_due_{{ $key }}" />
                                                    <label class="form-check-label text-black" for="receipt_date_as_invoice_due_{{ $key }}">
                                                        السداد بتاريخ استحقاق الفاتورة
                                                    </label>
                                                    @error('receipt_date_as_invoice_due')
                                                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <!--end::Input group-->
                                            </td>
                                            <td>
                                                <button wire:click="removeInvoice('{{ $selected_invoice['id'] }}')" type="button" class="btn btn-danger btn-sm"><i class="ki-outline ki-trash m-0 p-0"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <thead>
                                    <tr class="text-white" style="background-color: #481F66">
                                        <td>المجموع</td>
                                        <td colspan="100%">{{ $this->selected_invoices['total'] }}</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-lg-4 col-md-6">
                    @if(isset($this->selected_invoices['invoices']))
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">طريقة الدفع</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input -->
                            <select wire:model="payment_method" class="form-control form-select">
                                <option value="">اختيار</option>
                                @foreach($this->paymentMethods as $key => $payment_method)
                                    <option value="{{ $key }}">{{ $payment_method }}</option>
                                @endforeach
                            </select>
                            @error('payment_method')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--end::Input -->
                        </div>
                        <!--end::Input group-->
                    @endif

                    @if ($this->payment_method == \App\Models\Receipt::PAYMENT_METHOD_CHEQUE or $this->payment_method == \App\Models\Receipt::PAYMENT_METHOD_BANK)
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">اسم البنك</span>
                            </label>
                            <!--end::Label-->

                            <input wire:model.defer="bank_name" type="text" class="form-control">
                            @error('bank_name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    @endif

                    @if ($this->payment_method == \App\Models\Receipt::PAYMENT_METHOD_CHEQUE)
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">رقم الشيك</span>
                            </label>
                            <!--end::Label-->

                            <input wire:model.defer="cheque_number" type="text" class="form-control">
                            @error('cheque_number')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    @endif

                    @if(isset($this->selected_invoices['invoices']))
                        <!--begin::Input group-->
                        <div class="form-check">
                            <input wire:model="receipt_date_as_invoice_due" class="form-check-input" type="checkbox" id="receipt_date_as_invoice_due" />
                            <label class="form-check-label text-black" for="receipt_date_as_invoice_due">
                                السداد بتاريخ استحقاق الفاتورة
                            </label>
                            @error('receipt_date_as_invoice_due')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    @endif

                </div>
                <!--end::Col-->

            </div>
            <!--end::Row-->

        </div>
        <!--end::Wrapper-->

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="closeModal">إلغاء</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="closeModal">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">تأكيد العملية</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="save">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form>
</div>
