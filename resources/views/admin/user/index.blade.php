@extends('admin.layouts')

@section('title')
    Users | Campus Today
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Phone</th>
        <th>Tanggal Lahir</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->nohp}}</td>
            <td>{{$user->tanggal_lahir}}</td>
            <td>
                <a href={{route('admin.user.show', $user->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection