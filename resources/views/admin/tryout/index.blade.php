@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <a href={{route('admin.tryout.create')}} class="btn btn-warning mb-3">Create New</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Material Type</th>
        <th>Group</th>
        <th>Role</th>
        <th>Name</th>
        <th>Time</th>
        <th>Questions</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($tryouts as $tryout)
        <tr>
            <td>{{$tryout->id}}</td>
            <td>{{$tryout->materialType->name}}</td>
            <td>{{$tryout->group_id}}</td>
            <td>{{$tryout->roles}}</td>
            <td>{{$tryout->name}}</td>
            <td>{{$tryout->time}}</td>
            <td>{{$tryout->jumlah_soal}}</td>
            <td class="">
                <a href={{route('admin.tryout.show', $tryout->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection