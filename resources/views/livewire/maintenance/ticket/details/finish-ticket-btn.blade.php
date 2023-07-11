<div>
    @if ($this->ticket->finishable)
        <div class="card card-flush mb-4">
            <a wire:click="finishTicket" class="btn btn-success">
                <i class="ki-solid ki-double-check-circle fs-1">
                </i>
                طلب اعتماد الصيانة من المستأجر
            </a>
        </div>
    @else
    @endif
</div>
