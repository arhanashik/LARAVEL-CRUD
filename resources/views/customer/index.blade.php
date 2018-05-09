@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-7">
            <h3>Customers</h3>
        </div>

        <div class="col-sm-5">
            <div class="pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="key" id="key" placeholder="Search by id/name/job reference/company">
                    <div class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right">
                <a href="#" class="create-modal btn btn-success btn-sm" width="150px">
                    <i class="glyphicon glyphicon-plus"></i> New Customer
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table table-responsive col-sm-12">
            <table class="table table-bordered" id="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Job Reference</th>
                    <th>Company</th>
                    <th>Note</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>ACTION</th>
                </tr>
                {{ csrf_field() }}
                @foreach($customer as $key => $value)
                    <tr id="customers" class="customer{{ $value->id }}">
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->job_reference }}</td>
                        <td>{{ $value->company_name }}</td>
                        <td>{{ $value->note }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-job_reference="{{$value->job_reference}}" data-company_name="{{ $value->company_name }}" data-note="{{ $value->note }}" data-email="{{ $value->email }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-job_reference="{{$value->job_reference}}" data-company_name="{{ $value->company_name }}" data-note="{{ $value->note }}" data-email="{{ $value->email }}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-job_reference="{{$value->job_reference}}" data-company_name="{{ $value->company_name }}" data-note="{{ $value->note }}" data-email="{{ $value->email }}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{$customer->links()}}
    </div>

    {{--form add customer--}}
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group row add">
                            <label class="control-label col-sm-2">Name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Customer's name here" required>
                                <p id="error-name" class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Job Reference: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="job_reference" name="job_reference" placeholder="Customer's job reference here" required>
                                <p id="error-job_reference" class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Company: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Customer's company here" required>
                                <p id="error-company_name" class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Note: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="note" name="note" placeholder="Customer's note here" required>
                                <p id="error-note" class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Email: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Customer's email here" required>
                                <p id="error-email" class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span>Add Customer
                    </button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--form show customer--}}
    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p id="sid"></p>
                    <p id="sname"></p>
                    <p id="sjob_reference"></p>
                    <p id="scompany_name"></p>
                    <p id="snote"></p>
                    <p id="semail"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--form edit/delete customer--}}
    <div id="myModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2">ID: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group row add">
                            <label class="control-label col-sm-2">Name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nm" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Job Reference: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="j" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Company: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="c" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Note: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nt" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Email: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="e"required>
                            </div>
                        </div>
                    </form>

                    {{-- Form delete customer --}}
                    <div class="deletecontent">
                        Are you really want to delete <span class="name"></span>?
                        <span class="hidden id"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn actionBtn" type="button" id="add" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection