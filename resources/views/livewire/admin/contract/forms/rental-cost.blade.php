<div>

    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-5">
                    <!--begin::Table head-->
                    <thead>
                    <tr>
                        <th class="p-0 w-50px"></th>
                        <th class="p-0 min-w-auto"></th>
                        <th class="p-0 min-w-auto"></th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @forelse($this->selected_apartments ?? [] as $selected_apartment_id => $selected_apartment)
                        <tr>
                            <td>
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-45px">
                                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                                        {!! $selected_apartment->apartment->icon_svg !!}
                                    </span>
                                </div>
                                <!--end::Avatar-->
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $selected_apartment->apartment->name }}
                                </a>
                                <span class="text-muted fw-semibold d-block fs-7">
                                    {{ $selected_apartment->apartment->property->name }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="input-group mb-5">
                                    <input wire:model.defer="selected_apartments.{{ $selected_apartment_id }}.cost" class="form-control form-control-sm"/>
                                    <span class="input-group-text" id="basic-addon2">د.ب.</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-info">
                                    لا يوجد عقارات  لهذا العقد
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>

            @error('contract.cost')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">حفظ</span>
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
