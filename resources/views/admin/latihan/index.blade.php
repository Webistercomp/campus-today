@extends('admin.layouts')

@section('title')
    Latihan | Campus Today
@endsection

@section('content')
<div class="container">
    <div>
        <a href={{route('admin.latihan.create')}} class="btn btn-warning mb-3">Buat baru</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Materi</th>
        <th>Bab</th>
        <th>Judul Latihan</th>
        <th>Jumlah Pertanyaan</th>
        <th>Aktif</th>
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
                @if ($latihan->active == 1)
                    <span class="badge badge-success">V</span>
                @else
                    <span class="badge badge-danger">X</span>
                @endif
            </td>
            <td>
                <a href={{route('admin.latihan.edit', $latihan->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection