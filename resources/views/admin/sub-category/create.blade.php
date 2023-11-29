@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Sub Category</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Sub Category</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sub-category.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control" name="category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected': ''}}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1" {{old('status') == 1 ? 'selected':''}}>Active</option>
                                        <option value="0" {{old('status') == 0 ? 'selected':''}}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
