<div>
    <!--begin::Form-->
    <form wire:submit.prevent="save()" class="form">
        @csrf
        <!--begin::Scroll-->
        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
             data-kt-scroll-dependencies="#kt_modal_update_role_header"
             data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="fs-5 fw-bold form-label mb-2">
                    <span class="required">تحديد المستخدمين</span>
                </label>
                <!--end::Label-->
                <select id="user_role_selected" wire:model.defer="user_role_selected" class="form-select" data-control="select2" data-placeholder="الرجاء التحديد" multiple data-dropdown-parent="#kt_modal_admin_add_user_role">
                    <option></option>
                    @foreach($this->admins as $admin)
                        <option value="{{$admin->id}}">{{$admin->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Scroll-->
        <script wire:ignore>
            document.addEventListener('livewire:load', function (event) {
                window.Livewire.hook('message.processed', () => {
                    $('#user_role_selected').select2();

                    $('#user_role_selected').on('change', function (e) {
                        let elementName = $(this).attr('id');
                        var data = $(this).select2("val");
                        @this.set(elementName, data);
                    });
                });
            });
        </script>
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <!--begin::Button-->
            <button wire:click="discard" type="button" class="btn btn-light me-3">

                <span wire:loading.remove wire:target="discard">تجاهل</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="discard">
                    <span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->

            </button>
            <!--end::Button-->

            <!--begin::Button-->
            <button type="submit" class="btn btn-primary">
                <span wire:loading.remove>حفظ</span>
                <span wire:loading>الرجاء الإنتظار</span>
                <!--begin::Indicator progress-->
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
