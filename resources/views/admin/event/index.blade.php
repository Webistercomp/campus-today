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
        <th>Tipe Materi</th>
        <th>Role</th>
        <th>Nama</th>
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
            <td>
                @if ($tryout->active == 1)
                    <span class="badge badge-success">V</span>
                @else
                    <span class="badge badge-danger">X</span>
                @endif
            </td>
            <td>
                <a href={{route('admin.event.edit', $tryout->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection