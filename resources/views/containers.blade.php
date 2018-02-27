@extends('layouts.app')
@section('title')
    Containers
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Containers</div>
                    <div class="panel-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="container-fluid">
                            <div class="row m-t-sm">
                                <table class="table-bordered table-responsive col-md-12 text-center">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Capacity</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($containers as $container)
                                        <tr>
                                            <td>{!! $container->name !!}</td>
                                            <td class="text-center">
                                                <img class="tb_ct_img"
                                                     src="{{ asset('/uploads/images/'.$container->image) }}"/>
                                            </td>
                                            <td>{!! $container->capacity !!}</td>
                                            <td>{!! $container->weight !!}</td>
                                            <td>{!! $container->price !!}</td>
                                            <td>{!! $container->status_str !!}</td>
                                            <td>
                                                <a href="{{url('/edit_container/'.$company_id.'/'.$container->id)}}"
                                                   title="Edit"><i
                                                            class="glyphicon glyphicon-edit"></i></a>
                                                <a href="{{url('/remove_container/'.$company_id.'/'.$container->id)}}"
                                                   title="Remove"><i
                                                            class="glyphicon glyphicon-trash"></i></a>
                                                @if($container->status == \App\Container::CONTAINER_STATUS_ACTIVE)
                                                    <a href="{{url('/hide_container/'.$company_id.'/'.$container->id)}}"
                                                       title="Hide"><i
                                                                class="glyphicon glyphicon-eye-close"></i></a>
                                                @else
                                                    <a href="{{url('/show_container/'.$company_id.'/'.$container->id)}}"
                                                       title="Show"><i
                                                                class="glyphicon glyphicon-eye-open"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100" class="text-center">No Containers</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row m-t-sm text-right">
                                <a href="{{url('/companies?active_company='.$company_id)}}"
                                   class="btn btn-primary">Back to Company</a>
                                <a href="{{url('/add_container/'.$company_id)}}"
                                   class="btn btn-primary">Add
                                    Container</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
