@extends('layouts.app')
@section('title')
    Add Company Container
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Containers to {!! $company_name !!}</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ url('/add_company_container_submit') }}"
                              enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}

                            <input type="hidden" name="company_id" value="{!! $company_id !!}">

                            <div class="form-group">
                                <label for="container_id" class="col-md-4 control-label">Choose Containers</label>

                                <div class="col-md-8">
                                    <select id="container_id" name="container_id" required class="form-control">
                                        @forelse($containers as $container)
                                            <option value="{{$container->id}}">{!! $container->name !!}</option>
                                        @empty
                                            <option>-- No Containers to Select --</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-8">
                                    <input id="quantity" type="number" step="1" class="form-control" name="quantity"
                                           min="1" value="1" required>

                                    @if ($errors->has('quantity'))
                                        <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Add Container
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
