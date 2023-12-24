@extends('admin.layouts')

@section('title')
    Latihan Index | Campus Today
@endsection

@section('content')
<div class="container">
    <div>
        <a href={{route('admin.latihan.create')}} class="btn btn-warning mb-3">Create New</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Materi</th>
        <th>Chapter</th>
        <th>Judul Latihan</th>
        <th>Questions</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($latihans as $latihan)
        <tr>
            <td>{{$latihan->id}}</td>
            <td>{{$latihan->chapter->material->title}}</td>
            <td>{{$latihan->chapter->judul}}</td>
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