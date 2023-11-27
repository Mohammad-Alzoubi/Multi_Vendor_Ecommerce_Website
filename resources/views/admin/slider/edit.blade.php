@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">

            <form action="{{route('admin.slider.update', $slider->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Slider</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Preview</label>
                                        <br>
                                        <img width="100px" src="{{asset($slider->banner)}}" alt="asdf">
                                        <input type="file" name="banner" class="form-control mt-3" value="{{$slider->banner}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Type</label>
                                        <input type="text" name="type" class="form-control" value="{{$slider->type}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{$slider->title}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Starting Price</label>
                                        <input type="text" name="starting_price" class="form-control"
                                               value="{{$slider->starting_price}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Button Url</label>
                                        <input type="text" name="btn_url" class="form-control"
                                               value="{{$slider->btn_url}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Serial</label>
                                        <input type="text" name="serial" class="form-control" value="{{$slider->serial}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" name="status" class="form-control">
                                            <option value="1" {{$slider->status == 1 ? 'selected': ''}}>Active
                                            </option>
                                            <option value="0" {{$slider->status == 0 ? 'selected': ''}}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@stop
