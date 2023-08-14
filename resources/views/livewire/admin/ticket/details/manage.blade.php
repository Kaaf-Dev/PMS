<div>

    <div class="card card-flush mb-4">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="">
                <h2 class="mb-4">موعد الزيارة</h2>
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

                @if($this->ticket->hasVisitAvailablityTime())
                    <!--begin::Details-->
                    <div class="mt-8">

                        <!--begin::Alert-->
                        <div class="alert alert-primary d-flex align-items-center border border-dashed border-primary p-5">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column">
                              <!--begin::Content-->
                                <span>
                                            الوقت المتاح للزيارة

                                            @if ($this->ticket->visit_availability_start)
                                        من الساعة
                                        <b>
                                                {{ $this->ticket->visit_availability_start_human }}
                                                </b>
                                    @endif

                                    @if ($this->ticket->visit_availability_end)
                                        لغاية الساعة
                                        <b>
                                                {{ $this->ticket->visit_availability_end_human }}
                                                </b>
                                    @endif
                                             بحسب رغبة المستأجر.
                                        </span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Alert-->

                    </div>
                    <!--end::Details-->
                @endif


            </div>
        </div>
        <!--end::Card body-->
    </div>

</div>
