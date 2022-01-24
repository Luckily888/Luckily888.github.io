@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <h1>KYC / AML Panel </h1>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%;" id="dataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address Proof</th>
                                <th>ID Proof</th>
                                <th>Photo Proof</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->user->name }}</td>
                                    <td>{{ $result->user->email }}</td>
                                    <td><img src="{{ asset($result->address) }}" width="150"></td>
                                    <td><img src="{{ asset($result->id) }}" width="150"></td>
                                    <td><img src="{{ asset($result->photo) }}" width="150"></td>
                                    <td>
                                        <form action="{{route('admin.kyc.update',['id' => $result->uid])}}" method="post">
                                            @csrf
                                            @method('put')
                                            <button name="verified" value="1" class="btn btn-success w-100 mb-2">Accept</button>
                                            <button name="verified" value="0" class="btn btn-danger w-100">Abort</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $(function () {
                        $('#dataTable').dataTable();
                    });
                </script>
            </div>
        </div>
    </div>
@stop