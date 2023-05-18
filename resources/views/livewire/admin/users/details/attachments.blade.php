<div>
    <div class="card mb-5 mb-xl-8">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h3 class="fw-bold mb-1">المرفقات</h3>
                <div class="fs-6 text-gray-400">قائمة المرفقات المتعلقة بحساب المستأجر</div>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9 pt-3">
            <!--begin::Files-->
            <div class="d-flex flex-column mb-9">

                @foreach($attachments_list as $attachment_type => $attachments)
                    @if($attachment_type and $attachment_type != 'common')
                        @if(!($User->{'is_'.$attachment_type}))
                            @continue
                        @endif
                    @endif

                    @foreach($attachments as $attachment)
                            <!--begin::File-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('admin-assets/media/svg/files/pdf.svg') }}"/>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-semibold">
                                    <span class="fs-6 fw-bold text-dark text-hover-primary">
                                        {{ $attachment['title'] }}
                                    </span>
                                    <div class="text-gray-400">
                                        @if(isset($User->{$attachment['attribute']}))
                                            <a href="{{ $User->getAttachmentDiskPath($attachment['attribute']) }}" target="_blank">معاينة المستند</a>
                                        @else
                                            <a>لا يوجد مستند</a>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button"
                                        class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"
                                        data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                             height="24px" viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5"
                                                      rx="1" fill="currentColor"/>
                                                <rect x="14" y="5" width="5" height="5"
                                                      rx="1" fill="currentColor"
                                                      opacity="0.3"/>
                                                <rect x="5" y="14" width="5" height="5"
                                                      rx="1" fill="currentColor"
                                                      opacity="0.3"/>
                                                <rect x="14" y="14" width="5" height="5"
                                                      rx="1" fill="currentColor"
                                                      opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                     data-kt-menu="true" id="">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">رفع ملف جديد</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold">{{ $attachment['title'] }}: </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <input wire:model="{{ $attachment['attribute'] }}" type="file" class="form-control mb-4" accept=".pdf">
                                            </div>
                                            <!--end::Input-->
                                            <button wire:click="save('{{ $attachment['attribute'] }}')" class="btn btn-primary btn-sm w-100 mb-4">
                                                <span wire:loading.remove wire:target="save">
                                                    <i class="fas fa-save"></i>
                                                    حفظ
                                                </span>
                                                <span wire:loading wire:target="save">
                                                    <i class="fas fa-spin fa-spinner"></i>
                                                    الرجاء الانتظار
                                                </span>
                                            </button>

                                            @error($attachment['attribute'])
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                    @endforeach

                @endforeach


            </div>
            <!--end::Files-->
        </div>
        <!--end::Card body -->
    </div>
</div>
