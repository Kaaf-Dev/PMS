<div>
    <form wire:submit.prevent="export" class="form fv-plugins-bootstrap5 fv-plugins-framework">

        <!-- From Year -->
        <div class="d-flex flex-column mb-6 fv-row">
            <label class="fs-6 fw-semibold mb-2">من سنة</label>
            <select wire:model.defer="from_year" class="form-select">
                <option value="">الكل</option>
                @foreach($this->years as $year)
                    <option value="{{ $year['id'] }}">{{ $year['year'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- To Year -->
        <div class="d-flex flex-column mb-8 fv-row">
            <label class="fs-6 fw-semibold mb-2">إلى سنة</label>
            <select wire:model.defer="to_year" class="form-select">
                <option value="">الكل</option>
                @foreach($this->years as $year)
                    <option value="{{ $year['id'] }}">{{ $year['year'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Actions -->
        <div class="text-center">
            <button type="button" wire:click="closeModal" class="btn btn-light me-3">
                <i class="bi bi-arrow-down"></i> عودة
            </button>

            <button type="button" class="btn btn-success me-2" wire:click="exportExcel">
                <span wire:loading.remove wire:target="exportExcel">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Excel
                </span>
                <span wire:loading wire:target="exportExcel">
                    الرجاء الانتظار
                    <span class="spinner-border spinner-border-sm ms-2"></span>
                </span>
            </button>

            <button type="button" class="btn btn-warning" wire:click="exportPDF">
                <span wire:loading.remove wire:target="exportPDF">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </span>
                <span wire:loading wire:target="exportPDF">
                    الرجاء الانتظار
                    <span class="spinner-border spinner-border-sm ms-2"></span>
                </span>
            </button>
        </div>
    </form>
</div>
