@extends('layouts.app')
@section('title')
    Edit Container
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Container for {!! $company_name !!}</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/edit_container_submit') }}" enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}

                            <input type="hidden" name="company_id" value="{!! $company_id !!}">
                            <input type="hidden" name="container_id" value="{!! $container->id !!}">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{!! $container->name !!}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-4 control-label">Details</label>

                                <div class="col-md-8">
                                    <input id="details" type="text" class="form-control" name="details"
                                           value="{!! $container->details !!}" required>

                                    @if ($errors->has('details'))
                                        <span class="help-block"><strong>{{ $errors->first('details') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-8">
                                    <input id="price" type="number" step="0.01" class="form-control" name="price"
                                           value="{!! $container->price !!}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-4 control-label">Capacity</label>

                                <div class="col-md-8">
                                    <input id="capacity" type="text" class="form-control" name="capacity"
                                           value="{!! $container->capacity !!}" required>

                                    @if ($errors->has('capacity'))
                                        <span class="help-block"><strong>{{ $errors->first('capacity') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-8">
                                    <input id="quantity" type="number" step="1" class="form-control" name="quantity"
                                           min="1" value="{!! $container->quantity !!}" required>

                                    @if ($errors->has('quantity'))
                                        <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-4 control-label">Weight Limit</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="weight" type="number" step="0.1" class="form-control" name="weight"
                                               value="{!! $container->weight !!}" required min="1">
                                        <div class="input-group-addon">
                                            <span class="input-group-text">ton</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('weight'))
                                        <span class="help-block"><strong>{{ $errors->first('weight') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image</label>

                                <div class="col-md-8">
                                    @if($_SERVER['HTTP_HOST'] == 'localhost')
                                        <img src="{{ asset('/uploads/images/'.$container->image) }}"
                                             class="img-responsive">
                                    @else
                                        <img src="{{ asset('public/uploads/images/'.$container->image) }}"
                                             class="img-responsive">
                                    @endif
                                    <input id="image" type="file" class="form-control" name="image">

                                    @if ($errors->has('image'))
                                        <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                    @endif
                                        <span id="show_error" class="text-danger" style="display:none;">Please choose other file.</span>
                                        <span class="text-info">Maximum File Size : 4MB </span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        Update Container
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $("#image").change(function () {
            if (fileExtValidate(this)) { // file extension validation function
                if (fileSizeValidate(this)) { // file size validation function
                    $('#submit').prop('disabled', false);
                    $('#show_error').hide();
                } else {
                    $('#submit').prop('disabled', true);
                }
            } else {
                $('#submit').prop('disabled', true);
            }
        });
        // function for  validate file extension
        var validExt = ".png, .gif, .jpeg, .jpg";
        function fileExtValidate(fdata) {
            var filePath = fdata.value;
            var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
            var pos = validExt.indexOf(getFileExt);
            if (pos < 0) {
                alert("This file is not allowed, please upload valid file.");
                $('#show_error').show();
                return false;
            } else {
                return true;
            }
        }
        //function for validate file size: 4MB
        //var maxSize = 4;
        var maxSize = 1024*1024*4;
        function fileSizeValidate(fdata) {
            if (fdata.files && fdata.files[0]) {
                //var fsize = Math.ceil((fdata.files[0].size / 1024 )/1024);
                var fsize = fdata.files[0].size;//Math.ceil((fdata.files[0].size / 1024 )/1024);
                if (fsize > maxSize) {
                    alert('Maximum file size exceed, This file size is bigger than 4MB.');
                    $('#show_error').show();
                    return false;
                } else {
                    return true;
                }
            }
        }
    </script>
@endsection