<div>
    @if($this->ticket)

        @if($this->ticket->isVerificationCodeSent)
            <div class="mb-10">
                <label class="mb-4" for="verification_code">
                    رمز التأكيد
                </label>
                <input wire:model.defer="verification_code" id="verification_code" class="form-control form-control mb-4
                    @error('verification_code') border border-danger text-danger @enderror
                " placeholder="* * * * * *"/>
                @error('verification_code')
                    <div class="text-danger mb-4">{{ $message }}</div>
                @enderror
                <span class="text-gray-700">
                    في حال عدم استلام رمز التأكيد يمكنك إعادة إرسال الرمز مرة أخرى
                    <span wire:click="sendVerificationCode" class="text-primary cursor-pointer">
                        من هنا
                    </span>
                    <span wire:loading wire:target="sendVerificationCode">
                        <span class="spinner-border spinner-border-sm align-middle"></span>
                    </span>
                </span>
            </div>

            <button wire:click="finishTicket" class="btn btn-success w-100 my-2">
                <span wire:loading.remove wire:target="finishTicket">تأكيد العملية</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="finishTicket">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>

        @else
            <div wire:click="sendVerificationCode" class="alert alert-warning border border-warning border-dasheds">
                في حال الانتهاء من أعمال الصيانة المطلوبة سيم إرسال رمز تأكيد إلى المستأجر
                لتأكيد الطلب وانهائه
            </div>
            <button wire:click="sendVerificationCode" class="btn btn-success w-100 my-2">
                <span wire:loading.remove wire:target="sendVerificationCode">إرسال رمز التأكيد</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="sendVerificationCode">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        @endif

            <button wire:click="closeMe" class="btn btn-light w-100 my-2">
                <span wire:loading.remove wire:target="closeMe">عودة</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="closeMe">
					<span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>

    @endif
</div>
