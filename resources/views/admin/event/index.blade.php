@extends('admin.layouts')

@section('title')
    Event Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Material Type</th>
        <th>Group</th>
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
            <td>{{$tryout->group_id}}</td>
            <td>{{$tryout->roles}}</td>
            <td>{{$tryout->name}}</td>
            <td>{{$tryout->time}}</td>
            <td>{{$tryout->jumlah_soal}}</td>
            <td>{{$tryout->active}}</td>
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