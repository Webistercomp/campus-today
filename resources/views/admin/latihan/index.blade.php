@extends('admin.layouts')

@section('title')
    Latihan Index | Campus Today
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
        <th>Questions</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($latihans as $latihan)
        <tr>
            <td>{{$latihan->id}}</td>
            <td>{{$latihan->materialType->name}}</td>
            <td>{{$latihan->group->name}}</td>
            <td>{{$latihan->roles}}</td>
            <td>{{$latihan->name}}</td>
            <td>{{$latihan->jumlah_soal}}</td>
            <td>
                <a href={{route('admin.latihan.show', $latihan->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection