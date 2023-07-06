<div>
    <form wire:submit.prevent="submit">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">الموضوع</span>
            </label>
            <!--end::Label-->
            <input wire:model.defer="subject" type="text" class="form-control form-control-solid" />
            @error('subject')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">الفئة</label>
                <select wire:model.defer="selected_ticket_category" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a product" name="product">
                    <option value="">-- اختيار --</option>
                    @foreach($this->ticket_categories ?? [] as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('selected_ticket_category')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="required fs-6 fw-semibold mb-2">عقد الإيجار</label>
                <select wire:model.defer="selected_contract" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a product" name="product">
                    <option value="">-- اختيار --</option>
                    @foreach($this->contracts ?? [] as $contract)
                        <option value="{{ $contract->id }}">(#{{ $contract->id }}): {{ $contract->start_at_human }}</option>
                    @endforeach
                </select>
                @error('selected_contract')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <label class="fs-6 fw-semibold mb-2">الوصف</label>
            <textarea wire:model.defer="description" class="form-control form-control-solid" rows="4" name="description" placeholder="ادخل وصفًا بالتفاصيل للمشكلة"></textarea>
            @error('description')
            <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <label class="fs-6 fw-semibold mb-2">Attachments</label>
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_modal_create_ticket_attachments">
                <!--begin::Message-->
                <div class="dz-message needsclick align-items-center">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-file-up fs-3hx text-primary"></i>
                    <!--end::Icon-->
                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                        <span class="fw-semibold fs-7 text-gray-400">Upload up to 10 files</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="hideMe" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">
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
