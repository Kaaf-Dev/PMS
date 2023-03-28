<div>
    @if($this->invoice)
        <form wire:submit.prevent="save" id="kt_invoice_form">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column align-items-start flex-xxl-row">
                <!--begin::Input group-->
                <div class="d-flex align-items-center flex-equal fw-row me-4 order-2" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Specify invoice date" data-kt-initialized="1">
                    <!--begin::Date-->
                    <div class="fs-6 fw-bold text-gray-700 text-nowrap">Date:</div>
                    <!--end::Date-->

                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center w-150px">
                        <!--begin::Datepicker-->
                        <input wire:ignore id="kt_td_picker_date" class="form-control form-control-transparent fw-bold pe-5 flatpickr-input" placeholder="Select date" name="invoice_date" type="text" readonly="readonly">
                        <script wire:ignore>

                            $("#kt_td_picker_date_only").flatpickr();

                        </script>
                        <!--end::Datepicker-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-down fs-4 position-absolute ms-4 end-0"></i>                        <!--end::Icon-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Enter invoice number" data-kt-initialized="1">
                    <span class="fs-2x fw-bold text-gray-800">فاتورة #</span>
                    <input wire:model.defer="invoice.no" type="text" class="form-control form-control-flush fw-bold text-muted fs-3 w-125px" placehoder="...">
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Specify invoice due date" data-kt-initialized="1">
                    <!--begin::Date-->
                    <div class="fs-6 fw-bold text-gray-700 text-nowrap">Due Date:</div>
                    <!--end::Date-->

                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center w-150px">
                        <!--begin::Datepicker-->
                        <input class="form-control form-control-transparent fw-bold pe-5 flatpickr-input" placeholder="Select date" name="invoice_due_date" type="text" readonly="readonly">
                        <!--end::Datepicker-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-down fs-4 position-absolute end-0 ms-4"></i>                        <!--end::Icon-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Top-->

            <!--begin::Separator-->
            <div class="separator separator-dashed my-10"></div>
            <!--end::Separator-->

            <!--begin::Wrapper-->
            <div class="mb-0">
                <!--begin::Row-->
                <div class="row gx-10 mb-5">
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Bill From</label>

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" placeholder="Name">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" placeholder="Email">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <textarea name="notes" class="form-control form-control-solid" rows="3" placeholder="Who is this invoice from?"></textarea>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Bill To</label>

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" placeholder="Name">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <input type="text" class="form-control form-control-solid" placeholder="Email">
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <textarea name="notes" class="form-control form-control-solid" rows="3" placeholder="What is this invoice for?"></textarea>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Table wrapper-->
                <div class="table-responsive mb-10">
                    <!--begin::Table-->
                    <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                            <th class="min-w-300px w-475px">Item</th>
                            <th class="min-w-100px w-100px">QTY</th>
                            <th class="min-w-150px w-150px">Price</th>
                            <th class="min-w-100px w-150px text-end">Total</th>
                            <th class="min-w-75px w-75px text-end">Action</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                        <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                            <td class="pe-7">
                                <input type="text" class="form-control form-control-solid mb-2" name="name[]" placeholder="Item name">

                                <input type="text" class="form-control form-control-solid" name="description[]" placeholder="Description">
                            </td>

                            <td class="ps-0">
                                <input type="text" class="form-control form-control-solid" min="1" name="quantity[]" placeholder="1" value="1" data-kt-element="quantity">
                            </td>

                            <td>
                                <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0.00" value="0.00" data-kt-element="price">
                            </td>

                            <td class="pt-8 text-end text-nowrap">
                                $<span data-kt-element="total">0.00</span>
                            </td>

                            <td class="pt-5 text-end">
                                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                    <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                    </button>
                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->

                        <!--begin::Table foot-->
                        <tfoot>
                        <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                            <th class="text-primary">
                                <button class="btn btn-link py-1" data-kt-element="add-item">Add item</button>
                            </th>

                            <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="fs-5">Subtotal</div>

                                    <button class="btn btn-link py-1" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Coming soon" data-kt-initialized="1">Add tax</button>

                                    <button class="btn btn-link py-1" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Coming soon" data-kt-initialized="1">Add discount</button>
                                </div>
                            </th>

                            <th colspan="2" class="border-bottom border-bottom-dashed text-end">
                                $<span data-kt-element="sub-total">0.00</span>
                            </th>
                        </tr>

                        <tr class="align-top fw-bold text-gray-700">
                            <th></th>

                            <th colspan="2" class="fs-4 ps-0">Total</th>

                            <th colspan="2" class="text-end fs-4 text-nowrap">
                                $<span data-kt-element="grand-total">0.00</span>
                            </th>
                        </tr>
                        </tfoot>
                        <!--end::Table foot-->
                    </table>
                </div>
                <!--end::Table-->

                <!--begin::Item template-->
                <table class="table d-none" data-kt-element="item-template">
                    <tbody><tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                        <td class="pe-7">
                            <input type="text" class="form-control form-control-solid mb-2" name="name[]" placeholder="Item name">

                            <input type="text" class="form-control form-control-solid" name="description[]" placeholder="Description">
                        </td>

                        <td class="ps-0">
                            <input type="text" class="form-control form-control-solid" min="1" name="quantity[]" placeholder="1" data-kt-element="quantity">
                        </td>

                        <td>
                            <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0.00" data-kt-element="price">
                        </td>

                        <td class="pt-8 text-end">
                            $<span data-kt-element="total">0.00</span>
                        </td>

                        <td class="pt-5 text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                            </button>
                        </td>
                    </tr>
                    </tbody></table>

                <table class="table d-none" data-kt-element="empty-template">
                    <tbody><tr data-kt-element="empty">
                        <th colspan="5" class="text-muted text-center py-10">
                            No items
                        </th>
                    </tr>
                    </tbody></table>
                <!--end::Item template-->

                <!--begin::Notes-->
                <div class="mb-0">
                    <label class="form-label fs-6 fw-bold text-gray-700">Notes</label>

                    <textarea name="notes" class="form-control form-control-solid" rows="3" placeholder="Thanks for your business"></textarea>
                </div>
                <!--end::Notes-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Actions-->
            <div class="text-center">
                <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                    عودة
                </button>

                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-danger">
                    <!--begin::Indicator label-->
                    <span wire:loading.remove wire:target="save">تأكيد العملية</span>
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
    @endif
</div>
