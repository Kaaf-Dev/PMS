<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row p-7">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                    <!--begin::Ticket view-->
                    <div class="mb-0">
                        <!--begin::Comments-->
                        <div class="mb-15">

                            <!--begin::Content-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h1 class="text-gray-800 fw-semibold mb-10">
                                    التعليقات

                                    <div wire:loading wire:target="load">
                                        <span class="spinner-border spinner-border-sm align-middle"></span>
                                    </div>

                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Content-->

                            @if ($replies)
                                @forelse($replies ?? [] as $reply)
                                    <!--begin::Comment-->
                                    <div class="mb-9">
                                        <!--begin::Card-->
                                        <div class="card card-bordered w-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Wrapper-->
                                                <div class="w-100 d-flex flex-stack mb-8">
                                                    <!--begin::Container-->
                                                    <div class="d-flex align-items-center f">
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-column fw-semibold fs-5 text-gray-600 text-dark">
                                                            <!--begin::Text-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Username-->
                                                                <a class="text-gray-800 fw-bold text-hover-primary fs-5 me-3">
                                                                    {{ $reply->author_name }}
                                                                </a>
                                                                <!--end::Username-->
                                                                <span class="badge badge-light-{{ $reply->author_class }}">{{ $reply->author_string }}</span>
                                                            </div>
                                                            <!--end::Text-->
                                                            <!--begin::Date-->
                                                            <span class="text-muted fw-semibold fs-6">{{ $reply->updated_at_human }}</span>
                                                            <!--end::Date-->
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Container-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Desc-->
                                                <p class="fw-normal fs-5 text-gray-700 m-0">
                                                    {{ $reply->content }}
                                                </p>
                                                <!--end::Desc-->

                                                <!--begin::Details-->
                                                <div class="mb-0">
                                                    <!--begin::Description-->
                                                    <div class="fs-5 fw-normal text-gray-800">
                                                        @foreach($reply->attachments ?? [] as $attachment)
                                                            <div class="separator my-4"></div>
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-sm-center mb-7">
                                                                <!--begin::Content-->
                                                                <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                                                    <!--begin::Title-->
                                                                    <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                                                        <a href="{{ $attachment->url }}" target="_blank" class="text-gray-800 fw-bold text-hover-primary fs-6">مرفق</a>
                                                                        <span class="text-muted fw-semibold d-block pt-1">{{ $attachment->file_name }}</span>
                                                                    </div>
                                                                    <!--end::Title-->
                                                                    <!--begin::Section-->
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="{{ $attachment->url }}" target="_blank" class="btn btn-icon btn-light btn-sm border-0">
                                                    <span>
                                                        <i class="ki-outline ki-eye fs-2 text-primary"></i>
                                                    </span>
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Content-->
                                                            </div>
                                                            <!--end::Item-->
                                                        @endforeach

                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Details-->

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Comment-->
                                @empty
                                @endforelse
                            @endif

                            @livewire('admin.ticket.details.add-reply', ['ticket' => $this->ticket_id])

                        </div>
                        <!--end::Comments-->
                    </div>
                    <!--end::Ticket view-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
