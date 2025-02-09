<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title"></div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <button wire:click="exportExcel"
                                class="btn btn-sm btn-flex  btn-success btn-active-color-white fw-bold"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-file-up fs-6 text-white me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>تصدير
                        </button>
                        <!--end::Menu toggle-->
                    </div>
                    <!--end::Filter menu-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div wire:loading.class="table-loading" wire:target="load" class="table-responsive">
                <div class="table-loading-message">
                    Loading...
                </div>

                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="min-w-125px">نوع الإشعار</th>
                        <th class="min-w-125px">رقم الإشعار</th>
                        <th class="min-w-125px">البيان</th>
                        <th class="min-w-125px">التاريخ</th>
                        <th class="min-w-125px">وقت المشاهدة</th>
                        <th class="text-end min-w-100px">الإجراءات</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->

                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">
                    @forelse ($notifications as $index => $notification)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $notification->type }}</td>
                            <td>{{ $notification->id }}</td>
                            <td>{{ $notification->data['message'] ?? '—' }}</td>
                            <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $notification->read_at ? $notification->read_at->format('Y-m-d H:i') : 'غير مقروء' }}</td>
                            <td class="text-end">
                                <button wire:click="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-success">
                                    تعيين كمقروء
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">لا توجد إشعارات جديدة</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Card body-->

    </div>
    <!--end::Card-->
</div>
@push('js')
    <script>
        document.addEventListener('livewire:load', function (event) {
            window.Livewire.hook('message.processed', () => {
                $('.select-multi').select2();

                $('#contract_id').on('change', function (e) {
                    let elementName = $(this).attr('id');
                    var data = $(this).select2("val");
                @this.set(elementName, data)
                    ;
                });
            });
        });
    </script>
@endpush
