@extends('layouts.app')
@section('title')
    Company Containers
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Company Containers</div>
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
                                        <th>Quantity</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($company_containers as $company_container)
                                        <tr>
                                            <td>{!! $company_container->name !!}</td>
                                            <td class="text-center">

                                                @if($_SERVER['HTTP_HOST'] == 'localhost')
                                                    <img class="tb_ct_img"
                                                         src="{{ asset('/uploads/images/'.$company_container->image) }}"/>
                                                @else
                                                    <img class="tb_ct_img"
                                                         src="{{ asset('/public/uploads/images/'.$company_container->image) }}"/>
                                                @endif


                                            </td>
                                            <td>{!! $company_container->capacity !!}</td>
                                            <td>{!! $company_container->quantity !!}</td>
                                            <td>{!! $company_container->weight !!}</td>
                                            <td>{!! $company_container->price !!}</td>
                                            <td>
                                                <a href="{{url('/edit_company_container/'.$company_container->id)}}"
                                                   title="Edit"><i
                                                            class="glyphicon glyphicon-edit"></i></a>
                                                <a href="{{url('/remove_company_container/'.$company_container->id)}}"
                                                   title="Remove"><i
                                                            class="glyphicon glyphicon-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100" class="text-center">No Containers Added</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="row m-t-sm text-right">
                                <a href="{{url('/add_container_to_company/'.$company_id)}}"
                                   class="btn btn-primary">Add
                                    Container</a>
                                <a href="{{url('/companies?active_company='.$company_id)}}"
                                   class="btn btn-warning">Back to Company</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
