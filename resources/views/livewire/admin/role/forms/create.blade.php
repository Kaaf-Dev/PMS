<div>
    <!--begin::Form-->
    <form id="kt_modal_update_role_form" class="form">
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
                <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name"
                       value="Developer"/>
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
                        <tr>
                            <td class="text-gray-800">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"/>
                                    <label class="form-check-label text-gray-800" for="flexCheckDefault">
                                        Default
                                    </label>
                                </div>
                            </td>

                        </tr>
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
            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
																<span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
