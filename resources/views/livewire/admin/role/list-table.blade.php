<div wire:init="fetch">
    <!--begin::Content-->
    <div class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                @forelse($roles as $role)
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{$role->name}}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <!--begin::Users-->
                                <div class="fw-bold text-gray-600 mb-5">إجمالي المستخدمين الذين لديهم هذه الصلاحية: {{$role->admins_count}}</div>
                                <!--end::Users-->
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">
                                    @foreach($role->permissions as $permission)
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>
                                            {{$permission->name}}
                                        </div>
                                    @endforeach
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer flex-wrap pt-0">
                                <a href="{{route('admin.details', $role->id)}}" class="btn btn-light btn-active-primary my-1 me-2">معاينة</a>
                                <button wire:click="showAdminUpdateRole({{$role->id}})" type="button" class="btn btn-light btn-active-light-primary my-1" data-bs-toggle="modal">
                                    تعديل الصلاحيات
                                </button>
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                @empty

                @endforelse

                <!--begin::Add new card-->
                <div class="ol-md-4">
                    <!--begin::Card-->
                    <div class="card h-md-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Button-->
                            <button wire:click="showCreateRole()" type="button"
                                    class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal">
                                <!--begin::Illustration-->
                                <img src="{{asset('admin-assets/media/illustrations/sketchy-1/4.png')}}" alt=""
                                     class="mw-100 mh-150px mb-7"/>
                                <!--end::Illustration-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-3 text-gray-600 text-hover-primary">إضافة صلاحية جديدة</div>
                                <!--end::Label-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!--begin::Add new card-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
