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

            </div>
        </div>
        <!--end::Card body-->
    </div>

</div>
