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
            <a href="{{route('admin.packet.index')}}" class="btn btn-secondary">Back</a>
            <a href="{{route('admin.packet.edit', $packet->id)}}" class="btn btn-warning">Edit</a>
            <form class="d-inline-block" action="{{route('admin.packet.delete', $packet->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteData">Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="deleteData" tabindex="-1" aria-labelledby="deleteDataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{$packet->name}}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{$packet->role->name}}</td>
            </tr>
            <tr>
                <th>Price Not Discount</th>
                <td>{{$packet->price_not_discount}}</td>
            </tr>
            <tr>
                <th>Price Discount</th>
                <td>{{$packet->price_discount ?? '-'}}</td>
            </tr>
            <tr>
                <th>Discount</th>
                <td>{{$packet->discount ?? '-'}}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{$packet->description}}</td>
            </tr>
            <tr>
                <th>Benefits</th>
                <td>{{$packet->benefits}}</td>
            </tr>
            <tr>
                <th>Icon</th>
                <td>{{$packet->icon ?? '-'}}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{$packet->type}}</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection