<div>
    <form wire:submit.prevent="submit">

        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">التكلفة</span>
                </label>
                <!--end::Label-->
                <input wire:model.defer="maintenance_amount" type="text" class="form-control form-control-solid" />
                @error('maintenance_amount')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <label class="fs-6 fw-semibold mb-2">ملخص الصيانة</label>
            <textarea wire:model.defer="notes" class="form-control form-control-solid" rows="4" name="description" placeholder="ادخل وصف الصيانة"></textarea>
            @error('description')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
        </div>
        <!--end::Input group-->

       <!--begin::Input group-->
        <div class="fv-row mb-8">
            <label class="fs-6 fw-semibold mb-2">إرفاق مرفقات</label>

            <div class="input-group input-group-solid mb-5">
                <input wire:model="attachment" type="file" class="form-control form-control-solid" />
                <span class="input-group-text">
                    <span wire:loading wire:target="attachment">
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </span>

            </div>
            @error('attachment')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
        </div>
        <!--end::Input group-->

        @if($attachments)
            <!--begin::Input group-->
            <div class="fv-row mb-8">
                <label class="fs-6 fw-semibold mb-2">المرفقات</label>

                <div class="card-body pt-3">
                    @foreach($attachments ?? [] as $key => $attachment)
                        <!--begin::Item-->
                        <div class="d-flex align-items-sm-center mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-60px me-4">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-solid ki-file fs-2x text-primary"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Content-->
                            <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                <!--begin::Title-->
                                <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">مرفق</a>
                                    <span class="text-muted fw-semibold d-block pt-1">{{ $attachment->getClientOriginalName() }}</span>
                                </div>
                                <!--end::Title-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <a wire:click="cancelAttachment('{{ $key }}')" class="btn btn-icon btn-light btn-sm border-0">

                                        <span wire:loading.remove wire:target="cancelAttachment">
                                            <i class="ki-outline ki-trash fs-2 text-danger"></i>
                                        </span>
                                        <!--begin::Indicator progress-->
                                        <span wire:loading wire:target="cancelAttachment">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        <!--end::Indicator progress-->

                                    </a>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                    @endforeach
                </div>

                @error('attachments')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <!--end::Input group-->

            <div class="separator separator-dashed"></div>

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
    </form>

</div>
