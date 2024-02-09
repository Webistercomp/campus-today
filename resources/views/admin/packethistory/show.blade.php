@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Packet History</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.packethistory.index')}}" class="btn btn-secondary">Kembali</a>
            <form class="d-inline-block" action="{{route('admin.packethistory.delete', $packetHistory->id)}}" method="post">
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
                <th>Id</th>
                <td>{{$packetHistory->id}}</td>
            </tr>
            <tr>
                <th>Paket</th>
                <td>{{$packetHistory->packet->name}}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{$packetHistory->user->name}}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td>{{$packetHistory->payment_method}}</td>
            </tr>
            <tr>
                <th>Bukti Pembayaran</th>
                <td>
                    <img src={{$packetHistory->bukti_pembayaran}} width="100%" height="auto">
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td >
                    <div class="d-flex">
                        <div class="mr-2" id="status1">
                            {{$packetHistory->status}}
                        </div>
                        <div class="mr-2" id="status2" style="display: none">
                            <form action={{route('admin.packethistory.updateStatus', $packetHistory->id)}} method="post" style="display:flex;">
                                @csrf
                                <select name="status" id="" class="form-control d-inline-block mr-2" style="min-width: 200px;">
                                    <option value="pending" @if($packetHistory->status == 'pending') selected @endif>pending</option>
                                    <option value="verification" @if($packetHistory->status == 'verification') selected @endif>verification</option>
                                    <option value="success" @if($packetHistory->status == 'success') selected @endif>success</option>
                                    <option value="failed" @if($packetHistory->status == 'failed') selected @endif>failed</option>
                                </select>
                                <button type="submit" class="badge bg-success border-0 px-3" id="saveBtn">
                                    save
                                </button>
                            </form>
                        </div>
                        <div>
                            <button type="button" class="badge bg-primary border-0" id="changeBtn">Change</button>
                        </div>
                    </div>
                    <div style="max-width: 600px; font-size: 10px;">
                        Keterangan: 1)pending=belum upload bukti pembayaran, 2)verification=sudah upload bukti pembayaran dan dalam masa verifikasi admin, 3)success=pembayaran tervalidasi dan user bisa menggunakan paket, 4)failed=pembayaran gagal divalidasi
                    </div>
                </td>
                
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

        $('#changeBtn').click(function() {
            $('#status1').css('display', 'none')
            $('#status2').css('display', 'block')
            $('#changeBtn').css('display', 'none')
        });
        $('#saveBtn').click(function() {
            $('#status1').css('display', 'block')
            $('#status2').css('display', 'none')
            $('#changeBtn').css('display', 'block')
        });
    });
</script>
@endsection