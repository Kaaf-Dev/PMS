<div>
    <div class="card card-flush mb-4">
       <!--begin::Card body-->
        <div class="card-body">
            <div>
                <h2>الحالة</h2>
                <!--begin::Select-->
                <select wire:model.defer="ticket.status" class="form-select mb-2">
                    @foreach($this->status_list ?? [] as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
                <!--end::Select-->
                <!--begin::Description-->
                <div class="text-muted fs-7">تحديد حالة طلب الصيانة</div>
                <!--end::Description-->
                <!--begin::Datepicker-->
                <div class="d-none mt-10">
                    <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select publishing date and time</label>
                    <input class="form-control" id="kt_ecommerce_add_category_status_datepicker" placeholder="Pick date & time" />
                </div>
                <!--end::Datepicker-->
            </div>
        </div>

        <div class="card-footer">
            <!--begin::Button-->
            <button wire:click="discard" class="btn btn-light me-3" data-kt-users-modal-action="cancel">
                <span wire:loading.remove wire:target="discard">تراجع</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="discard">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
            <!--end::Button-->

            <!--begin::Button-->
            <button wire:click="save" class="btn btn-primary" data-kt-users-modal-action="submit">
                <span wire:loading.remove wire:target="save">إرسال</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="save">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
            <!--end::Button-->
        </div>
        <!--end::Card body-->

        <!-- todo: add visit_in and visit_at (as option "done!") -->

    </div>
</div>
