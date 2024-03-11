@extends('admin.layouts')

@section('title')
    Testimoni | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="mb-3">
            <a href={{route('admin.testimoni.create')}} class="btn btn-warning">Buat Baru</a>
        </div>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Nama</th>
                <th>Testimoni</th>
                <th>Aktif</th>
                <th>Detail</th>
            </thead>
            <tbody>
                @foreach ($testimonis as $testimoni)
                <tr>
                    <td>{{$testimoni->id}}</td>
                    <td>{{$testimoni->name}}</td>
                    <td>{{$testimoni->testimoni}}</td>
                    <td>
                        @if($testimoni->active)
                            <span class="badge bg-success">V</span>
                        @else
                            <span class="badge bg-danger">X</span>
                        @endif
                    </td>
                    <td>
                        <a href={{route('admin.testimoni.edit', $testimoni->id)}} class="badge bg-primary">
                            <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection