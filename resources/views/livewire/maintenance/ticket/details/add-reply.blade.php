<div>

    <!--begin::Input group-->
    <div class="mb-0">
        @can('reply', $this->ticket)
            <textarea wire:model.defer="reply" class="form-control form-control-solid placeholder-gray-600 fw-bold fs-4 ps-9 pt-7" rows="6" name="message" placeholder="إضافة جديد..">

        </textarea>
            <!--begin::Submit-->
            <button wire:click="sendReply" class="btn btn-primary mt-n20 mb-20 position-relative float-end me-7">
                <span wire:loading.remove wire:target="sendReply">إرسال</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="sendReply">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->

            </button>
            <!--end::Submit-->
        @endcan
    </div>
    @error('reply')
    <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
    <!--end::Input group-->

</div>
