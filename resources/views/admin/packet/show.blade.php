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
            <a href="{{route('admin.packet.index')}}" class="btn btn-secondary">Kembali</a>
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
                <th>Nama</th>
                <td>{{$packet->name}}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{$packet->role->name}}</td>
            </tr>
            <tr>
                <th>Harga sebelum diskon</th>
                <td id="price_not_discount">{{$packet->price_not_discount}}</td>
            </tr>
            <tr>
                <th>Harga setelah diskon</th>
                <td id="price_discount">{{$packet->price_discount ?? '-'}}</td>
            </tr>
            <tr>
                <th>Diskon</th>
                <td id="discount">{{$packet->discount ?? '-'}}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{$packet->description}}</td>
            </tr>
            <tr>
                <th>Benefits X</th>
                <td>
                    <ul>
                        @foreach ($packet->benefits_x as $benefit)
                            <li>{{$benefit}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Benefits V</th>
                <td>
                    <ul>
                        @foreach ($packet->benefits_v as $benefit)
                            <li>{{$benefit}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Tipe paket</th>
                <td>{{$packet->type}}</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        let price_not_discount = $('#price_not_discount').text();
        price_not_discount = new Intl.NumberFormat().format(price_not_discount)
        price_not_discount = 'Rp ' + price_not_discount;
        $('#price_not_discount').text(price_not_discount);
        
        let price_discount = $('#price_discount').text();
        if(price_discount != '-') {
            price_discount = new Intl.NumberFormat().format(price_discount)
            price_discount = 'Rp ' + price_discount;
            $('#price_discount').text(price_discount);
        }

        let discount = $('#discount').text();
        if(discount != '-') {
            discount = discount + '%';
            $('#discount').text(discount);
        }
    });
</script>
@endsection