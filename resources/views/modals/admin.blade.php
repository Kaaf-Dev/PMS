@foreach( getAdminGlobalModals() as $modal )
    <!--begin::Modal - Create Property-->
    <div class="modal fade" id="{{ $modal['modal_id'] }}" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog {{ $modal['details']['modal_dialog_class'] ?? '' }}">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0">
                    <!--begin::Modal title-->
                    <h2>{{ $modal['details']['title'] }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon -->
                        <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body  py-lg-10 px-lg-10">
                    @livewire($modal['livewire_component'])
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Property-->
@endforeach

<script>
    let admin_global_modals = @json( getAdminGlobalModals() );
    admin_global_modals.forEach( function (modal) {
        window[modal.modal_id] = new bootstrap.Modal(document.getElementById(modal.modal_id));
    });
</script>

@foreach( getAdminGlobalModals() as $modal )
    @php
        echo '
        <script>
                Livewire.on("'. $modal['emit_show'] .'", params => {
                    '.$modal['modal_id'] . '.show();
                })

                Livewire.on("'. $modal['emit_hide'] .'", () => {
                    '.$modal['modal_id'] . '.hide();
                })

        </script>';
    @endphp
@endforeach
