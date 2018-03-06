@extends('layouts.app')
@section('title')
    Edit Company
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Company: {!! $company->name !!}</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/edit_company_submit') }}" enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}
                            <input type="hidden" name="company_id" value="{{$company->id}}">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name*</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $company->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('web_site') ? ' has-error' : '' }}">
                                <label for="web_site" class="col-md-4 control-label">Website</label>

                                <div class="col-md-8">
                                    <input id="web_site" type="url" class="form-control" name="web_site"
                                           value="{{ $company->web_site }}">

                                    @if ($errors->has('web_site'))
                                        <span class="help-block"><strong>{{ $errors->first('web_site') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('license_number') ? ' has-error' : '' }}">
                                <label for="license_number" class="col-md-4 control-label">License Number*</label>

                                <div class="col-md-8">
                                    <input id="license_number" type="text" class="form-control" name="license_number"
                                           value="{{ $company->license_number }}" required>

                                    @if ($errors->has('license_number'))
                                        <span class="help-block"><strong>{{ $errors->first('license_number') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description*</label>

                                <div class="col-md-8">
                                    <input id="description" type="text" class="form-control" name="description"
                                           value="{{ $company->description }}" required>

                                    @if ($errors->has('description'))
                                        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address*</label>

                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ $company->address }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label text-left">Phone Number*</label>

                                <div class="col-md-8">
                                    <input id="phone" type="tel" class="form-control" name="phone"
                                           value="{{ $company->phone }}" pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                                           title="US based Phone number in the format of : xxx-xxx-xxxx" required>
                                    <sub><i>Please input US based Phone number in the format of : xxx-xxx-xxxx</i></sub>
                                    @if ($errors->has('phone'))
                                        <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('avatar_image') ? ' has-error' : '' }}">
                                <label for="avatar_image" class="col-md-4 control-label">Avatar Image*</label>

                                <div class="col-md-8">
                                    <img class="img-responsive"
                                         src="{{asset('uploads/images/'.$company->avatar_image)}}"/>
                                    <input id="avatar_image" type="file" class="form-control m-t-sm"
                                           name="avatar_image">
                                    <!--i class="text-info">Please choose image with less size of 2MB.</i-->

                                    @if ($errors->has('avatar_image'))
                                        <span class="help-block"><strong>{{ $errors->first('avatar_image') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
