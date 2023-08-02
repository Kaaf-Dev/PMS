<div>

    <div class="card card-flush mb-4">
        <div class="card-body">
            <!--begin::Summary-->
            <!--begin::User Info-->
            <div class="d-flex align-items-center me-5 me-xl-13 mb-5">
                <!--begin::Symbol-->
                <div class="symbol symbol-60px symbol-circle me-3">
                    <img src="{{ $this->ticket->contract->user->profile_photo_url }}" class="" alt="">
                </div>
                <!--end::Symbol-->

                <!--begin::Info-->
                <div class="m-0">
                    <span class="fw-semibold text-gray-400 d-block fs-7">المستأجر</span>
                    <a href="{{ route('admin.users.details', ['user_id' => $this->ticket->contract->user->id]) }}" class="fw-bold text-gray-800 text-hover-primary fs-6">
                        {{ $this->ticket->contract->user->name }}
                    </a>
                </div>
                <!--end::Info-->
            </div>
            <!--end::User Info-->
            <!--end::Summary-->

            <div class="separator separator-dashed my-8"></div>

            <div class="">
                <!--begin::Input group-->
                <div class="mb-4">
                    <label class="fs-6 form-label fw-bold text-dark">شركة الصيانة </label>
                    <!--begin::Select-->
                    <select wire:model.defer="ticket.maintenance_company_id" class="form-select form-select">
                        <option value="">غير محدد</option>
                        @foreach($this->maintenance_companies ?? [] as $maintenance_company)
                            <option value="{{ $maintenance_company->id }}">{{ $maintenance_company->name }}</option>
                        @endforeach
                    </select>
                    @error('ticket.maintenance_company_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="text-muted fs-7">تعيين شركة صيانة لمتابعة الطلب</div>
                    @if(!$this->ticket->maintenance_company_id)
                        <div class="alert alert-danger border border-danger border-dashed mt-4">
                            لم يتم تحديد شركة صيانة بعد!
                        </div>
                    @endif
                    <!--end::Select-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-4">
                    <label class="fs-6 form-label fw-bold text-dark">الفئة</label>
                    <!--begin::Select-->
                    <select wire:model.defer="ticket.ticket_category_id" class="form-select mb-2">
                        <option value="">غير محدد</option>
                        @foreach($this->ticket_categories ?? [] as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('ticket.ticket_category_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <!--end::Select-->
                    @if(!$this->ticket->ticket_category_id)
                        <div class="alert alert-danger border border-danger border-dashed mt-4">
                            لم يتم تحديد فئة للتذكرة بعد!
                        </div>
                    @endif
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-4">
                    <label class="fs-6 form-label fw-bold text-dark">الأولوية</label>
                    <!--begin::Select-->
                    <select wire:model.defer="ticket.priority" class="form-select mb-2">
                        <option value="">غير محدد</option>
                        @foreach($this->priority_list ?? [] as $key => $priority)
                            <option value="{{ $key }}">{{ $priority }}</option>
                        @endforeach
                    </select>
                    @error('ticket.priority')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <!--end::Select-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-4">
                    <label class="fs-6 form-label fw-bold text-dark">الحالة</label>
                    <!--begin::Select-->
                    <select wire:model.defer="ticket.status" class="form-select mb-2">
                        @foreach($this->status_list ?? [] as $key => $status)
                            <option value="{{ $key }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('ticket.status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="text-muted fs-7">تحديد حالة طلب الصيانة</div>
                    <!--end::Select-->
                </div>
                <!--end::Input group-->

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

    </div>

</div>
