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
                        <form method="POST" action="{{ url('/edit_company_container_submit') }}"
                              enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}

                            <input type="hidden" name="company_container_id" value="{!! $company_container->id !!}">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" disabled
                                           value="{!! $company_container->name !!}">
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-8">
                                    <input id="price" type="number" step="0.01" class="form-control" name="price"
                                           value="{!! $company_container->price !!}">

                                    @if ($errors->has('price'))
                                        <span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-8">
                                    <input id="quantity" type="number" step="1" class="form-control" name="quantity"
                                           min="1" value="{!! $company_container->quantity !!}" required>

                                    @if ($errors->has('quantity'))
                                        <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Update Container
                                    </button>
                                    <a href="{{url('/show_company_containers').'/'.$company_id}}" class="btn btn-warning">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection