<div>
    @if($this->contract)

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold">
                <span class="required">المحامي</span>
            </label>
            @error('selected_lawyer')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
            <!--end::Label-->
            @if($this->selected_lawyer)
                <div class="w-100">
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-2 mt-4">

                        <div class="d-flex align-items-center p-3 mb-2">
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <a href="{{ route('admin.users.details', ['user_id' => $this->selected_lawyer->id]) }}" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">
                                    {{ $this->selected_lawyer->name }}
                                </a>
                                <!--end::Name-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Button-->
                            <a wire:click="selectLawyer()" class="btn btn-icon btn-bg-light btn-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                <!--end::Svg Icon-->
                            </a>
                            <!--end::Button-->
                        </div>

                    </div>
                </div>
            @else
                <div class="w-100">
                    <div class="text-gray-500 fw-semibold fs-5">يمكنك البحث ضمن قائمة المحاميين:</div>

                    <div class="w-100 position-relative my-5" autocomplete="off">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon -->
                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Input-->
                        <input wire:model="search" type="text" class="form-control form-control-lg form-control-solid px-15" placeholder="البحث في بيانات المحامي..">
                        <!--end::Input-->
                        <!--begin::Spinner-->
                        <span wire:loading.class.remove="d-none" wire:target="search" class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none">
                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                        </span>
                        <!--end::Spinner-->
                        <!--begin::Reset-->
                        <span wire:click="clearSearchLawyer" wire:loading.remove wire:target="search" class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 @if(!$search) d-none @endif">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <!--end::Reset-->
                    </div>

                    <div class="mh-475px scroll-y me-n7 pe-7">

                        @forelse($lawyers ?? [] as $user)
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="{{ route('admin.users.details', ['user_id' => $user->id]) }}" class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">
                                            {{ $user->name }}
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">{{ $user->cpr }}</span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">{{ $user->email }}</div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <a wire:click="selectLawyer('{{ $user->id }}')" class="btn btn-sm btn-primary">اختيار</a>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Property-->
                        @empty
                            <div class="d-flex flex-column flex-center">
                                <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}" class="mw-250px">
                                <div class="fs-3 fw-bolder text-dark mb-4">No data found.</div>
                                <div class="fs-6"></div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <!--end::Input group-->
    @endif

    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">

        @if($this->selected_lawyer)
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span>مبلغ المديونية</span>
                </label>
                <!--end::Label-->

                <!--begin::Input-->
                <div class="input-group mb-5">
                    <input type="number" class="form-control form-control-solid" wire:model.defer="amount">
                    <span class="input-group-text">د.ب.</span>
                </div>
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">المنفذ له</span>
                </label>
                <!--end::Label-->

                <!--begin::Input-->
                <input wire:model.defer="first_side" type="text" class="form-control">
                <!--end::Input-->
                @error('first_side')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">المنفذ ضده</span>
                </label>
                <!--end::Label-->

                <!--begin::Input-->
                <input wire:model.defer="second_side" type="text" class="form-control">
                <!--end::Input-->
                @error('second_side')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input group-->


            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">عنوان القضية</span>
                </label>
                <!--end::Label-->

                <!--begin::Input-->
                <input wire:model.defer="case_title" type="text" class="form-control">
                <!--end::Input-->
                @error('case_title')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">القرار المطلوب تنفيذه</span>
                </label>
                <!--end::Label-->
                <textarea wire:model.defer="required_case" class="form-control"></textarea>

                @error('required_case')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end::Input group-->
        @endif

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">تأكيد</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="save">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->

    </form>

</div>
