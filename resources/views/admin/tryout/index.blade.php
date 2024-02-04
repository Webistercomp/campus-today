@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <a href={{route('admin.tryout.create')}} class="btn btn-warning mb-3">Buat baru</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Tipe Materi</th>
        <th>Role</th>
        <th>Nama</th>
        <th>Waktu</th>
        <th>Jumlah Pertanyaan</th>
        <th>Aktif</th>
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
            <td>
                @if ($tryout->active == 1)
                    <span class="badge bg-success">V</span>
                @else
                    <span class="badge bg-danger">X</span>
                @endif
            </td>
            <td class="">
                <a href={{route('admin.tryout.edit', $tryout->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection