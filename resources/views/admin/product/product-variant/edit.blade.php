@extends('admin.layouts.master')


@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update: {{$variant->name}}</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.products-variant.update', $variant->id)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{$variant->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1" {{$variant->status ? 'selected':''}}>Active</option>
                                        <option value="0" {{$variant->status == 0 ? 'selected':''}}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection


