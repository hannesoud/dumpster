@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Companies</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            @forelse($companies as $company)

                                @if (session('active_company_id'))
                                    <li @if(session('active_company_id') == $company->id) class="active" @endif>
                                        <a data-toggle="tab"
                                           href="#company_{!! $loop->index !!}">{!! $company->name !!}</a>
                                    </li>
                                @elseif( ! empty($active_company_id) )
                                    <li @if($active_company_id == $company->id) class="active" @endif>
                                        <a data-toggle="tab"
                                           href="#company_{!! $loop->index !!}">{!! $company->name !!}</a>
                                    </li>
                                @else
                                    <li @if($loop->first) class="active" @endif>
                                        <a data-toggle="tab"
                                           href="#company_{!! $loop->index !!}">{!! $company->name !!}</a>
                                    </li>
                                @endif
                            @empty
                                <li class="active"><a data-toggle="tab" href="#company_none">No Company</a></li>
                            @endforelse
                        </ul>

                        <div class="tab-content">
                            @forelse($companies as $company)
                                <div id="company_{!! $loop->index !!}"
                                     class="tab-pane fade
                                    @if (session('active_company_id'))
                                     @if(session('active_company_id') == $company->id)
                                             in active
                                        @endif
                                     @else
                                     @if($loop->first) in active @endif
                                     @endif">

                                    <div class="container-fluid">
                                        <div class="row m-t-sm">
                                            <span class="col-md-4">Company Name:</span>
                                            <span class="col-md-8">{!! $company->name !!}</span>
                                        </div>
                                        <div class="row m-t-sm">
                                        <span class="col-md-8 col-md-offset-4">
                                            @if($company->avatar_id)

                                                @if($_SERVER['HTTP_HOST'] == 'localhost')
                                                    <img src="{{asset('/uploads/images/'.$company->avatar_image)}}"
                                                         class="img-responsive"/>
                                                @else
                                                    <img src="{{asset('/public/uploads/images/'.$company->avatar_image)}}"
                                                         class="img-responsive"/>
                                                @endif

                                            @else
                                                <i class="text-info">Please add avatar image for your company.</i>
                                            @endif
                                        </span>
                                        </div>
                                        <div class="row m-t-sm">
                                            <span class="col-md-4">Company Code:</span>
                                            <span class="col-md-8">{!! $company->code !!}</span>
                                        </div>
                                        <div class="row m-t-sm">
                                            <span class="col-md-4">Company Status:</span>
                                            <span class="col-md-8">
                                            {!! $company->status_name !!}
                                                <br>
                                                @if($company->status == \App\Company::COMPANY_STATUS_REVIEW)
                                                    <i class="text-info">You need to wait until your company is active.</i>
                                                @elseif($company->status == \App\Company::COMPANY_STATUS_ACTIVE)
                                                    <i class="text-info">You can work with our clients.</i>
                                                @elseif($company->status == \App\Company::COMPANY_STATUS_BANNED)

                                                @elseif($company->status == \App\Company::COMPANY_STATUS_PAUSED)

                                                @else
                                                @endif
                                        </span>
                                        </div>
                                        <div class="row m-t-sm">
                                            <div class="col-md-12 text-right">
                                                <a class="btn btn-info"
                                                   href="{{url('/show_company_containers/'.$company->id)}}">
                                                    <i class="glyphicon glyphicon-eye-open"
                                                       style="margin-right:10px;"></i>Show Containers</a>
                                                <a class="btn btn-warning"
                                                   href="{{url('/remove_company/'.$company->id)}}">
                                                    <i class="glyphicon glyphicon-trash"
                                                       style="margin-right:10px;"></i>Remove
                                                    Company</a>
                                                <a class="btn btn-primary"
                                                   href="{{url('/edit_company/'.$company->id)}}">
                                                    <i class="glyphicon glyphicon-edit"
                                                       style="margin-right:10px;"></i>Edit
                                                    Company</a>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row-fluid m-t-md text-center">
                                        <a class="btn btn-primary" href="{{url('/create_company')}}">Create
                                            New
                                            Company</a>
                                    </div>
                                </div>
                            @empty
                                <div id="company_none" class="tab-pane fade in active">
                                    <div class="container-fluid">
                                        <p class="text-center m-t-md">There is no registered
                                            company.</p>
                                        <p class="text-center m-t-sm">Will you please create your
                                            company
                                            now?</p>
                                        <div class="row-fluid m-t-md text-center">
                                            <a class="btn btn-primary"
                                               href="{{url('/create_company')}}">Create
                                                New Company</a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
