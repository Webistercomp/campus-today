@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Packet</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.packet.show', $packet->id)}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.packet.update', $packet->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Nama Paket</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$packet->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <select class="custom-select" name="role_id" id="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if ($role->id == $packet->role_id) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Harga sebelum diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_not_discount" name="price_not_discount" value="{{$packet->price_not_discount}}" min="0" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Harga setelah diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_discount" name="price_discount" value="{{$packet->price_discount}}" min="0" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="discount" name="discount" value="{{$packet->discount}}" min="0" max="100" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi Paket</th>
                        <td class="col-8">
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{$packet->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Benefit</th>
                        <td class="col-8">
                            <textarea class="form-control" id="benefits_x" name="benefits_x" placeholder="Contoh: Tryout UM & UTBK, Materi UM & UTBK">{{$packet->benefits_x}}</textarea>
                            <label for="benefits_x" style="font-weight: 400; font-size:12px;">*Bukan benefit (X), Pisahkan dengan koma.</label>
                            <textarea class="form-control" id="benefits_v" name="benefits_v" placeholder="Contoh: Tryout SKD & SKB, Materi SKD & SKB">{{$packet->benefits_v}}</textarea>
                            <label for="benefits_v" style="font-weight: 400; font-size: 12px;">Benefit (V), Pisahkan dengan koma.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tipe paket</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="type" name="type" value="{{$packet->type}}">
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