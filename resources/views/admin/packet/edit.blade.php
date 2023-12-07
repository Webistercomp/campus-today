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
            <a href="{{route('admin.packet.show', $packet->id)}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.packet.update', $packet->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Name</th>
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
                        <th class="col-4">Price Not Discount</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="price_not_discount" name="price_not_discount" value="{{$packet->price_not_discount}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Price Discount</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="price_discount" name="price_discount" value="{{$packet->price_discount}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Discount</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="discount" name="discount" value="{{$packet->discount}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description" value="{{$packet->description}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Benefits</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="benefits" name="benefits" value="{{$packet->benefits}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Icon</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="icon" name="icon" value="{{$packet->icon}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Type</th>
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