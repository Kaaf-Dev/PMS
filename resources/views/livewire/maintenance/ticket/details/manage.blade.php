<div>
    <div class="card card-flush mb-4">
       <!--begin::Card body-->
        <div class="card-body">
            <div class="">
                <h2>موعد الزيارة</h2>
                <!--begin::Select-->
                <!--begin::Input-->

                <input wire:model.defer="ticket.visit_at" class="form-control mb-2" placeholder="تحديد موعد الزيارة" id="kt_visit_at"/>
                @push('js')
                    <script>
                        $("#kt_visit_at").flatpickr({
                            enableTime: true,
                            dateFormat: "Y-m-d H:i",
                        });
                    </script>
                @endpush


                <!--end::Input-->
                <!--end::Select-->
                <!--begin::Description-->
                <div class="text-muted fs-7">تحديد موعد الزيارة للعقار</div>
                <!--end::Description-->
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
                <span wire:loading.remove wire:target="save">حفظ</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="save">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
            <!--end::Button-->
        </div>
        <!--end::Card body-->

    </div>
</div>
