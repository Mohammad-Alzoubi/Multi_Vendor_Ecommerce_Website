<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.stripe-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Stripe Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $stripSetting->status == 0 ? 'selected' : '' }} value="0">Enable</option>
                        <option {{ $stripSetting->status == 1 ? 'selected' : '' }} value="1">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option {{ $stripSetting->mode == 0 ? 'selected' : '' }} value="0">Sandbox</option>
                        <option {{ $stripSetting->mode == 1 ? 'selected' : '' }} value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option selected disabled>Select</option>
                        @foreach(config('settings.country_list') as $country)
                            <option {{ $stripSetting->country_name == $country ? 'selected' : '' }} value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option selected disabled>Select</option>
                        @foreach(config('settings.currency_list') as $key => $currency)
                            <option {{ $stripSetting->currency_name == $key ? 'selected' : '' }} value="{{ $key }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency rate ( Per {{ $settings->currency_name }} )</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{ $stripSetting->currency_rate }}">
                </div>

                <div class="form-group">
                    <label>Stripe Client Id</label>
                    <input type="text" class="form-control" name="client_id" value="{{ $stripSetting->client_id }}">
                </div>

                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" value="{{ $stripSetting->secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
