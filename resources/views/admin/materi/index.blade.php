@extends('admin.layouts')

@section('title')
    Materi | Campus Today
@endsection

@section('content')
<div class="container">
    <div>
        <a href={{route('admin.materi.create')}} class="btn btn-warning mb-3">Buat baru</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Tipe Materi</th>
        <th>Group</th>
        <th>Judul</th>
        <th>Tipe Pembelajaran</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($materials as $materi)
        <tr>
            <td>{{$materi->id}}</td>
            <td>{{$materi->materialType->name}}</td>
            <td>{{$materi->groupType->name}}</td>
            <td>{{$materi->title}}</td>
            <td>{{$materi->type}}</td>
            <td>
                <a href={{route('admin.materi.edit', $materi->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection