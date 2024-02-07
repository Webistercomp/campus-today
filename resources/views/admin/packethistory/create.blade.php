@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Buat Baru</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.packethistory.index')}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.packethistory.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Nama Paket</th>
                        <td class="col-8">
                            <select class="custom-select" name="packet_id" id="packet_id">
                                @foreach ($packets as $packet)
                                    <option value="{{$packet->id}}">{{$packet->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Nama User</th>
                        <td class="col-8">
                            <select class="custom-select" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Payment Method</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="payment_method" name="payment_method" placeholder="Gopay, Shopeepay, Transfer Bank">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Bukti Pembayaran</th>
                        <td class="col-8">
                            <div>
                                <img id="bukti_pembayaran_image" alt="" width="300px" style="display: none" class="rounded my-2">
                            </div>
                            <div>
                                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran">
                            </div>
                            @error('bukti_pembayaran')
                                <div class="error">{{ $message }}asdasdasdasdads</div>
                            @enderror
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Status</th>
                        <td class="col-8">
                            <select class="custom-select" name="status" id="status">
                                <option value="pending">Pending</option>
                                <option value="verification">Verifikasi</option>
                                <option value="success">Success</option>
                                <option value="failed">Failed</option>
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
<script>
    $(document).ready(function() {
        $('#bukti_pembayaran').change(function(){
            let input = this;
            let url = $(this).val();
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#bukti_pembayaran_image').attr('src', e.target.result);
                    console.log(e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
                $('#bukti_pembayaran_image').css('display', 'block');
            }
        });
    })
</script>
@endsection