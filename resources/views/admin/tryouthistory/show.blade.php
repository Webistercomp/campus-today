@extends('admin.layouts')

@section('title')
Tryouts History | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h5>Detail Tryout</h5>
            </div>
            <div class="col-md-6 text-right mb-3">
                <a href="{{route('admin.tryouthistory.index')}}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Id</th>
                    <td>{{$tryoutHistory->id}}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>
                        <a href={{route('admin.user.show', $tryoutHistory->user->id)}} class="btn btn-primary">{{$tryoutHistory->user->name}}</a>
                    </td>
                </tr>
                <tr>
                    <th>Tryout</th>
                    <td>
                        <a href={{route('admin.tryout.show', $tryoutHistory->tryout->id)}} class="btn btn-primary">{{$tryoutHistory->tryout->name}}</a>
                    </td>
                </tr>
                <tr>
                    <th>Waktu Mulai Mengerjakan</th>
                    <td>{{$tryoutHistory->start_timestamp}}</td>
                </tr>
                <tr>
                    <th>Waktu Selesai Mengerjakan</th>
                    <td>{{$tryoutHistory->finish_timestamp}}</td>
                </tr>
                <tr>
                    <th>Skor</th>
                    <td>{{$tryoutHistory->score}}</td>
                </tr>
                <tr>
                    <th>Tanggal dibuat</th>
                    <td>{{$tryoutHistory->created_at}}</td>
                </tr>
                <tr>
                    <th>Tanggal diupdate</th>
                    <td>{{$tryoutHistory->updated_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection