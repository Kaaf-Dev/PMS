<div>

    <div class="card card-flush mb-4">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="">
                <h2 class="mb-4">موعد الزيارة</h2>
                @if($this->ticket->is_change_visit_at)
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
                @endif

                <!--end::Input-->
                <!--end::Select-->
                @if($this->ticket->visit_at)
                    <div class="alert alert-info my-4">
                        موعد الزيارة المحدد:
                        <strong>
                            {{ $this->ticket->visit_in_date_human }}
                            ({{ $this->ticket->visit_in_human }})
                        </strong>
                    </div>
                @else
                    <div class="alert alert-info my-4">
                        لم يتم تحديد موعد للزيارة بعد...
                    </div>
                @endif

                @if($this->ticket->visited_at)
                    <div class="alert alert-primary border border-primary border-dashed my-4">
                        تمت الزيارة بتاريخ
                        <strong>{{ $this->ticket->visited_at_date_human }}
                            ({{ $this->ticket->visited_at_human }})
                        </strong>
                    </div>
                @endif

            </div>
        </div>

        <!--end::Card body-->

        @if($this->ticket->is_change_visit_at)
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
        @endif

    </div>

</div>
