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

            <!--begin::Input group-->
            <div class="fv-row mt-4 mb-8">
                <label class="fs-6 fw-semibold mb-2">إضافة مرفقات مع التعليق</label>

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

        @endcan
    </div>
    @error('reply')
    <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
    <!--end::Input group-->

</div>
