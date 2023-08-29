<div>
    @if($this->maintenance_invoice)
        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span>الحالة</span>
                </label>
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <div class="badge badge-{{ $this->maintenance_invoice->status_class }}">{{ $this->maintenance_invoice->status_string }}</div>
                </label>
                <!--end::Label-->
            </div>
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span>التكلفة</span>
                </label>
                <!--end::Label-->
                <input value="{{ $this->maintenanceInvoice->maintenance_amount_human }}" type="text" class="form-control form-control-solid" readonly />
            </div>

            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span>القيمة المعتمدة</span>
                </label>
                <!--end::Label-->
                <input value="{{ $this->maintenanceInvoice->amount_human ?? '(غير محدد)' }}" type="text" class="form-control form-control-solid" readonly />
            </div>
        </div>

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <label class="fs-6 fw-semibold mb-2">ملخص الصيانة</label>
            <textarea class="form-control form-control-solid" rows="4" readonly>{{ $this->maintenanceInvoice->notes }}</textarea>
        </div>
        <!--end::Input group-->

        @if($this->maintenance_invoice->attachments)
            <!--begin::Details-->
            <div class="mb-0">
                <!--begin::Description-->
                <div class="fs-5 fw-normal text-gray-800">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th></th>
                            <th></th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($this->maintenance_invoice->attachments ?? [] as $attachment)
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <div class="symbol symbol-60px me-4">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-solid ki-file fs-2x text-primary"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                            <a href="{{ $attachment->url }}" target="_blank" class="text-gray-800 fw-bold text-hover-primary fs-6">مرفق</a>
                                            <span class="text-muted fw-semibold d-block pt-1">{{ $attachment->file_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ $attachment->url }}" target="_blank" class="btn btn-icon btn-light btn-sm border-0">
                                            <span>
                                                <i class="ki-outline ki-eye fs-2 text-primary"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <!--end::Item-->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Description-->
            </div>
            <!--end::Details-->
        @endif

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="hideMe" type="button" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">
                إلغاء
            </button>
            <button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
                <span wire:loading.remove wire:target="submit">تأكيد</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="submit">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    @endif
</div>
