@extends('layouts.app')
@section('title')
    Add Container
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Container for {!! $company_name !!}</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/add_container_submit') }}" enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}

                            <input type="hidden" name="company_id" value="{!! $company_id !!}">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-4 control-label">Details</label>

                                <div class="col-md-8">
                                    <input id="details" type="text" class="form-control" name="details"
                                           value="{{ old('details') }}" required>

                                    @if ($errors->has('details'))
                                        <span class="help-block"><strong>{{ $errors->first('details') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-8">
                                    <input id="price" type="number"  step="0.01" class="form-control" name="price"
                                           value="{{ old('price') }}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-4 control-label">Capacity</label>

                                <div class="col-md-8">
                                    <input id="capacity" type="text" class="form-control" name="capacity"
                                           value="{{ old('capacity') }}" required>

                                    @if ($errors->has('capacity'))
                                        <span class="help-block"><strong>{{ $errors->first('capacity') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-4 control-label">Weight</label>

                                <div class="col-md-8">
                                    <input id="weight" type="text" class="form-control" name="weight"
                                           value="{{ old('weight') }}" required>

                                    @if ($errors->has('weight'))
                                        <span class="help-block"><strong>{{ $errors->first('weight') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image</label>

                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control"
                                           name="image" required>
                                    <i class="text-info">Please choose image with less size of 512KB.</i>
                                    @if ($errors->has('image'))
                                        <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Add New Container
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
