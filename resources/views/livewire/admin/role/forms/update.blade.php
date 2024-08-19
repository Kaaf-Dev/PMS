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
                    <span class="required">اسم الصلاحية</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="Role.name" class="form-control form-control-solid" placeholder="ادخل اسم الصلاحية" name="role_name"/>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Permissions-->
            <div class="fv-row">
                <!--begin::Label-->
                <label class="fs-5 fw-bold form-label mb-2">الأذونات </label>
                <!--end::Label-->
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                        <!--begin::Table row-->
                        @foreach($this->permissions as $permission)
                            <tr>
                                <td class="text-gray-800">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input wire:model.defer="role_permission.{{$permission->id}}" class="form-check-input" type="checkbox" value="{{$permission->id}}"/>
                                        <label class="form-check-label text-gray-800" for="flexCheckDefault">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Permissions-->
        </div>
        <!--end::Scroll-->
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
