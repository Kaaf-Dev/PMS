<div class="card mb-5 mb-xl-8">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Summary-->
        <!--begin::User Info-->
        <div class="d-flex flex-center flex-column py-5">
            <!--begin::Avatar-->
            <div class="symbol symbol-75px symbol-circle mb-7">
                <div class="symbol-label fs-2 fw-semibold bg-gray text-inverse-gray">
                    <span class="svg-icon svg-icon-3x svg-icon-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            @if ($this->apartment->isTypeHouse)
                                <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"/>
                                <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"/>
                                <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"/>

                            @else
                                <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/>
                                <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/>
                                <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/>
                                <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/>
                                <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/>
                                <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/>
                                <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/>
                                <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/>
                            @endif
                        </svg>
                    </span>
                </div>
            </div>
            <!--end::Avatar-->
            <!--begin::Name-->
            <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $this->apartment->name }}</a>
            <!--end::Name-->
            <div class="mb-9">
                <!--begin::Badge-->
                @if($this->apartment->is_rented)
                    <div class="badge badge-lg badge-light-primary d-inline">مؤجر</div>
                @else
                    <div class="badge badge-lg badge-light-success d-inline">متاح</div>
                @endif
                <!--begin::Badge-->
            </div>
        </div>
        <!--end::User Info-->
        <!--end::Summary-->
        <!--begin::Details toggle-->
        <div class="d-flex flex-stack fs-4 py-3">
            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">المعلومات
                <span class="ms-2 rotate-180">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
															<span class="svg-icon svg-icon-3">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																</svg>
															</span>
                    <!--end::Svg Icon-->
														</span></div>
        </div>
        <!--end::Details toggle-->
        <div class="separator"></div>
        <!--begin::Details content-->
        <div id="kt_user_view_details" class="collapse show">

            <div class="pb-5 fs-6 mt-5">

                <div class="d-flex align-items-center mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                            </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column">
                        <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->property->name }}</a>

                        <span class="text-muted fw-bold">العقار</span>
                    </div>
                    <!--end::Text-->
                </div>

                <div class="d-flex align-items-center mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    @if ($this->apartment->isTypeHouse)
                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"/>
                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"/>
                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"/>

                                    @else
                                        <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/>
                                        <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/>
                                        <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/>
                                    @endif
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column">
                        <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->type_string }}</a>

                        <span class="text-muted fw-bold">نوع الوحدة</span>
                    </div>
                    <!--end::Text-->
                </div>

                <div class="d-flex align-items-center mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="currentColor"/>
                                    <path d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column">
                        <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->cost }}</a>

                        <span class="text-muted fw-bold">الإيجار المقدر / شهري</span>
                    </div>
                    <!--end::Text-->
                </div>

                <div class="d-flex align-items-center mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 7V17H7V7H17ZM20 3H4C3.4 3 3 3.4 3 4V20C3 20.6 3.4 21 4 21H20C20.6 21 21 20.6 21 20V4C21 3.4 20.6 3 20 3Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column">
                        <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->area }}</a>

                        <span class="text-muted fw-bold">المساحة</span>
                    </div>
                    <!--end::Text-->
                </div>

                @if($this->apartment->isTypeHouse)
                <div class="d-flex align-items-center mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column">
                        <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->rooms_count }}</a>

                        <span class="text-muted fw-bold">عدد الغرف</span>
                    </div>
                    <!--end::Text-->
                </div>
                @endif

                @if($this->apartment->isTypeHouse)
                    <div class="d-flex align-items-center mb-7">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M2.07664 11.85L2.87663 10.05C3.07663 9.55003 3.67665 9.35003 4.17665 9.55003L5.07664 9.95002C7.17664 10.85 9.17662 10.85 11.2766 9.95002C14.3766 8.55002 17.4766 8.55002 20.5766 9.95002L21.4766 10.35C21.9766 10.55 22.1766 11.15 21.9766 11.65L21.1766 13.45C20.9766 13.95 20.3766 14.15 19.8766 13.95L18.9766 13.55C16.8766 12.65 14.8766 12.65 12.7766 13.55C9.67662 14.95 6.57663 14.95 3.47663 13.55L2.57664 13.15C2.07664 12.95 1.87664 12.35 2.07664 11.85ZM2.57664 20.05L3.47663 20.45C6.57663 21.85 9.67662 21.85 12.7766 20.45C14.8766 19.55 16.8766 19.55 18.9766 20.45L19.8766 20.85C20.3766 21.05 20.9766 20.85 21.1766 20.35L21.9766 18.55C22.1766 18.05 21.9766 17.45 21.4766 17.25L20.5766 16.85C17.4766 15.45 14.3766 15.45 11.2766 16.85C9.17662 17.75 7.17664 17.75 5.07664 16.85L4.17665 16.45C3.67665 16.25 3.07663 16.45 2.87663 16.95L2.07664 18.75C1.87664 19.25 2.07664 19.85 2.57664 20.05Z" fill="currentColor"/>
                                    <path d="M2.07664 4.94999L2.87663 3.15C3.07663 2.65 3.67665 2.45 4.17665 2.65L5.07664 3.05C7.17664 3.95 9.17662 3.95 11.2766 3.05C14.3766 1.65 17.4766 1.65 20.5766 3.05L21.4766 3.44999C21.9766 3.64999 22.1766 4.25 21.9766 4.75L21.1766 6.55C20.9766 7.05 20.3766 7.25 19.8766 7.05L18.9766 6.65C16.8766 5.75 14.8766 5.75 12.7766 6.65C9.67662 8.05 6.57663 8.05 3.47663 6.65L2.57664 6.25C2.07664 6.05 1.87664 5.44999 2.07664 4.94999Z" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column">
                            <a class="text-dark text-hover-primary fs-6 fw-bold">{{ $this->apartment->bathrooms_count }}</a>

                            <span class="text-muted fw-bold">دورات المياه</span>
                        </div>
                        <!--end::Text-->
                    </div>
                @endif
            </div>

        </div>
        <!--end::Details content-->
    </div>
    <!--end::Card body-->
</div>
