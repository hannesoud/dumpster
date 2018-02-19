@extends('layouts.app')
@section('title')
    Create Company
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Company</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/create_company_submit') }}" enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}


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

                            <div class="form-group{{ $errors->has('web_site') ? ' has-error' : '' }}">
                                <label for="web_site" class="col-md-4 control-label">Website</label>

                                <div class="col-md-8">
                                    <input id="web_site" type="url" class="form-control" name="web_site"
                                           value="{{ old('web_site') }}" required>

                                    @if ($errors->has('web_site'))
                                        <span class="help-block"><strong>{{ $errors->first('web_site') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('license_number') ? ' has-error' : '' }}">
                                <label for="license_number" class="col-md-4 control-label">License Number</label>

                                <div class="col-md-8">
                                    <input id="license_number" type="text" class="form-control" name="license_number"
                                           value="{{ old('license_number') }}" required>

                                    @if ($errors->has('license_number'))
                                        <span class="help-block"><strong>{{ $errors->first('license_number') }}</strong></span>
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

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label text-left">Phone Number</label>

                                <div class="col-md-8">
                                    <input id="phone" type="tel" class="form-control" name="phone"
                                           value="{{ old('phone') }}" pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                                           title="US based Phone number in the format of : xxx-xxx-xxxx" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password"
                                           value="{{ old('password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation" class="col-md-4 control-label">Confirm
                                    Password</label>

                                <div class="col-md-8">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           value="{{ old('password_confirmation') }}"
                                           name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('avatar_image') ? ' has-error' : '' }}">
                                <label for="avatar_image" class="col-md-4 control-label">Avatar Image</label>

                                <div class="col-md-8">
                                    <input id="avatar_image" type="file" class="form-control"
                                           name="avatar_image" required>
                                    <i class="text-info">Please choose image with less size of 512KB.</i>
                                    @if ($errors->has('avatar_image'))
                                        <span class="help-block"><strong>{{ $errors->first('avatar_image') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Create
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
