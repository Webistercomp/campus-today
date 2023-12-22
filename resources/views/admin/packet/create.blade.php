@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Create New Packet</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.packet.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.packet.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Name</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <select class="custom-select" name="role_id" id="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Price Not Discount</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_not_discount" name="price_not_discount" step="1" min="0">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Price Discount</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_discount" name="price_discount" step="1" min="0">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Discount</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Benefits</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="benefits_x" name="benefits_x" placeholder="X">
                            <label for="benefits_x" class="font-weight: 500!important">Input not benefit (X), Pisahkan dengan koma</label>
                            <input type="text" class="form-control" id="benefits_v" name="benefits_y" placeholder="V">
                            <label for="benefits_y" class="font-weight: 500!important">Input benefit (v), Pisahkan dengan koma</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Icon</th>
                        <td class="col-8">
                            <input type="file" class="form-control" id="icon" name="icon">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Type</th>
                        <td class="col-8">
                            <select class="custom-select" name="type" id="type">
                                <option value="mandiri">Mandiri</option>
                                <option value="bimbel">Bimbel</option>
                            </select>
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