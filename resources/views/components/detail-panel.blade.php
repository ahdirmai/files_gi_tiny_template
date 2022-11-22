<div class="info-panel">
    <div class="info-content p-3 border-left">
        <div class="d-flex align-items-center mb-3">
            <div class="flex-fill">
                <span class="circle circle-sm bg-white mr-2">
                    <span class="fe fe-image fe-12 text-success"></span>
                </span>
                <span class="h6">Creative Logo.PNG</span>
            </div>
            <span class="btn close-info">
                <i class="fe fe-x"></i>
            </span>
        </div>
        <ul class="nav nav-tabs nav-fill mb-3" id="file-detail" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-detail" data-toggle="tab" href="#detail" role="tab"
                    aria-controls="detail" aria-selected="true">Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-activity" data-toggle="tab" href="#activity" role="tab"
                    aria-controls="activity" aria-selected="false">Activities</a>
            </li>
        </ul>
        <div class="tab-content" id="file-tabs">
            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="tab-detail">
                <img src="{{ asset('/assets/products/p4.jpg') }}" alt="..." class="img-fluid rounded">
                <ul class="avatars-list my-4 mx-0">
                    <li>
                        <a href="#!" class="avatar avatar-sm">
                            <img alt="..." class="avatar-img rounded-circle"
                                src="{{asset('assets/avatars/face-2.jpg') }}">
                        </a>
                    </li>
                    <li>
                        <a href="#!" class="avatar avatar-sm">
                            <img alt="..." class="avatar-img rounded-circle"
                                src="{{asset('assets/avatars/face-4.jpg') }}">
                        </a>
                    </li>
                </ul>
                <dl class="row my-4 small">
                    <dt class="col-6 text-muted">Owner</dt>
                    <dd class="col-6">Whilemina Pate</dd>
                    <dt class="col-6 text-muted">Type</dt>
                    <dd class="col-6">Image</dd>
                    <dt class="col-6 text-muted">Size</dt>
                    <dd class="col-6">32M</dd>
                    <dt class="col-6 text-muted">Location</dt>
                    <dd class="col-6"><a href="#" class="text-muted">Design File</a></dd>
                    <dt class="col-6 text-muted">Created at</dt>
                    <dd class="col-6">Aug 20, 2020</dd>
                    <dt class="col-6 text-muted">Last update</dt>
                    <dd class="col-6">Aug 21, 2020</dd>
                </dl>
            </div>
            <!-- .tab-pane -->
            <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="tab-activity">
                <div class="timeline">
                    <div class="pb-3 timeline-item item-primary">
                        <div class="pl-5 small">
                            <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted mx-1">have
                                    uploaded</span><strong>Tinydash</strong></div>
                            <span class="badge badge-pill badge-dark">1h ago</span>
                        </div>
                    </div>
                    <div class="pb-3 timeline-item item-warning">
                        <div class="pl-5 small">
                            <div class="mb-3"><strong>@Fletcher</strong><span
                                    class="text-muted mx-1">shared</span><strong>Tiny
                                    Admin</strong></div>
                            <ul class="avatars-list mb-2">
                                <li>
                                    <a href="#!" class="avatar avatar-sm">
                                        <img alt="..." class="avatar-img rounded-circle"
                                            src="{{asset('assets/avatars/face-1.jpg') }}">
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" class="avatar avatar-sm">
                                        <img alt="..." class="avatar-img rounded-circle"
                                            src="{{asset('assets/avatars/face-4.jpg') }}">
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" class="avatar avatar-sm">
                                        <img alt="..." class="avatar-img rounded-circle"
                                            src="{{asset('assets/avatars/face-3.jpg') }}">
                                    </a>
                                </li>
                            </ul>
                            <span class="badge badge-pill badge-dark">1h ago</span>
                        </div>
                    </div>
                    <div class="pb-3 timeline-item item-success">
                        <div class="pl-5 small">
                            <div class="mb-2"><strong>@Kelley Sonya</strong><span class="text-muted small mx-1">has
                                    commented
                                    on</span><strong>Advanced table</strong></div>
                            <div class="card d-inline-flex mb-2">
                                <div class="card-body bg-light py-2 px-3"> Lorem ipsum dolor
                                    sit
                                    amet, consectetur adipiscing elit. </div>
                            </div>
                            <span class="badge badge-pill badge-dark">1h ago</span>
                        </div>
                    </div>
                </div>
                <!-- / .timeline -->
            </div>
            <!-- .tab-pane -->
        </div>
        <!-- .tab-content -->
    </div>
</div>
