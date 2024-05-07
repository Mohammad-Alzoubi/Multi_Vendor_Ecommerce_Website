@extends('admin.layouts.master')

@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/modules/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Payment Settings</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Paypal</a>
                                        <a class="list-group-item list-group-item-action" id="list-stripe-list" data-toggle="list" href="#list-stripe" role="tab">Stripe</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Logo and Favicon</a>

                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.payment-settings.sections.paypal-setting')
                                        @include('admin.payment-settings.sections.stripe-setting')

                                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                             aria-labelledby="list-messages-list">
                                            In quis non esse eiusmod sunt fugiat magna pariatur officia anim ex officia
                                            nostrud amet nisi pariatur eu est id ut exercitation ex ad reprehenderit
                                            dolore nostrud sit ut culpa consequat magna ad labore proident ad qui et
                                            tempor exercitation in aute veniam et velit dolore irure qui ex magna ex
                                            culpa enim anim ea mollit consequat ullamco exercitation in.
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script src="{{asset('backend/assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
@endpush


