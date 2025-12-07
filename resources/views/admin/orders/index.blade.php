@extends('admin.layouts.base')
@extends('admin.layouts.head')
@section('title')
    Order
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Order</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check form-check-muted m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </div>
                                </th>
                                <th> Client Name </th>
                                <th> Order No </th>
                                <th> Product Cost </th>
                                <th> Project </th>
                                <th> Payment Mode </th>
                                <th> Start Date </th>
                                <th> Payment Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
