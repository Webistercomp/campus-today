@extends('admin.layouts')

@section('title')
    Event Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="mb-3">
        <a href={{route('admin.event.create')}} class="btn btn-warning">Buat Baru</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Material Type</th>
        <th>Role</th>
        <th>Name</th>
        <th>Time</th>
        <th>Questions</th>
        <th>Active</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($tryouts as $tryout)
        <tr>
            <td>{{$tryout->id}}</td>
            <td>{{$tryout->materialType->name}}</td>
            <td>{{$tryout->roles}}</td>
            <td>{{$tryout->name}}</td>
            <td>{{$tryout->time}}</td>
            <td>{{$tryout->jumlah_soal}}</td>
            <td>{{$tryout->active ? 'Yes' : 'No'}}</td>
            <td>
                <a href={{route('admin.event.show', $tryout->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection