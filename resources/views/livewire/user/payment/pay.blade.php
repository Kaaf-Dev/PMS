<div class="card">
    <div class="card-body">
        @if($this->invoice)

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-7 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                    <span class="required">قيمة الفاتورة المستحقة</span>
                </label>
                <!--end::Label-->
                <input type="number" class="form-control form-control-solid" value="{{ $this->invoice->unPaidAmount }}" readonly/>
                @error('invoice_id')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input group-->
            <form wire:submit.prevent="pay">
                @csrf
                <!--begin::Radio group-->
                <div class="mb-5" data-kt-buttons="true">
                    <!--begin::Radio button-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 {{$this->payment_type == 1 ? 'active' : ''}}">
                        <!--end::Description-->
                        <div class="d-flex align-items-center me-2">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                <input wire:model="payment_type" class="form-check-input" type="radio" name="plan" value="1"/>
                            </div>
                            <!--end::Radio-->

                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                    BenefitPay
                                </h2>
                                <div class="fw-semibold opacity-50">
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Description-->

                        <!--begin::Price-->
                        <div class="ms-5">
                    <span class="fs-2x fw-bold">
                        <img src="{{asset('user-assets/media/logos/benefit-pay.svg')}}" width="20">
                    </span>
                        </div>
                        <!--end::Price-->
                    </label>
                    <!--end::Radio button-->

                    <!--begin::Radio button-->
                    <label
                        class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 {{$this->payment_type == 2 ? 'active' : ''}}">
                        <!--end::Description-->
                        <div class="d-flex align-items-center me-2">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                <input wire:model="payment_type" class="form-check-input" type="radio" name="plan" checked="checked" value="2"/>
                            </div>
                            <!--end::Radio-->

                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <h2 class="d-flex align-items-center fs-2 fw-bold flex-wrap">
                                    Credit / Debit
                                    <span class="badge badge-light-success ms-2 fs-7">Most popular</span>
                                </h2>
                                <div class="fw-semibold opacity-50">
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Description-->

                        <!--begin::Price-->
                        <div class="ms-5 d-flex align-items-center gap-3">
                        <span class="fs-2x fw-bold">
                            <img src="{{asset('user-assets/media/logos/visa_cards.svg')}}" width="50">
                        </span>
                            <span class="fs-2x fw-bold">
                            <img src="{{asset('user-assets/media/logos/apple_pay.svg')}}" width="40" alt="Apple Pay">
                        </span>
                        </div>
                        <!--end::Price-->
                    </label>
                    <!--end::Radio button-->

                </div>
                <!--end::Radio group-->



                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="{{route('user.dashboard')}}" class="btn btn-light me-3">الرجوع
                    </a>
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                        <span wire:loading.remove class="indicator-label">دفع</span>
                        <span wire:loading class="indicator-progress">الرجاء الانتظار
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        @endif

        <div wire:ignore>
            <script>
                document.addEventListener("livewire:load", () => {
                    window.livewire.on('benefit-by-benefit-pay', function (params) {
                        console.log(1);
                        InApp.open(
                            params,
                            function (success) {
                                window.livewire.emit('benefit-pay-success-payment', success);
                            },
                            function (error) {
                                console.log(error);
                            },
                            function (cancel) {
                                console.log(cancel);
                            },
                        );
                    });
                });
            </script>
        </div>

    </div>
</div>
