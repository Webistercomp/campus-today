@extends('admin.layouts')

@section('title')
    Users | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail User</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.user.show', $selectedUser->id)}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.user.update', $selectedUser->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Name</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$selectedUser->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <select class="custom-select" name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if ($role->id == $selectedUser->role_id) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Email</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="email" name="email" value="{{$selectedUser->email}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Email Verified at</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="email_verified_at" name="email_verified_at" value="{{$selectedUser->email_verified_at}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tanggal Lahir</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{$selectedUser->tanggal_lahir}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">No. HP</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="nohp" name="nohp" value="{{$selectedUser->nohp}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Pekerjaan</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{$selectedUser->pekerjaan}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Jenis Kelamin</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{$selectedUser->jenis_kelamin}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Kota / Kabupaten</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="kota_kabupaten" name="kota_kabupaten" value="{{$selectedUser->kota_kabupaten}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Provinsi</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{$selectedUser->provinsi}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Pendidikan Terakhir</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{$selectedUser->pendidikan_terakhir}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Institusi</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="institusi" name="institusi" value="{{$selectedUser->institusi}}">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3 m-0">
                <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection