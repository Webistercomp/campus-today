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
            <a href="{{route('admin.packet.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.packet.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Nama</th>
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
                        <th class="col-4">Price Sebelum Diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_not_discount" name="price_not_discount" step="1" min="0">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Price Setelah Diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="price_discount" name="price_discount" step="1" min="0">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Diskon</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Benefit</th>
                        <td class="col-8">
                            <textarea class="form-control" id="benefits_x" name="benefits_x" placeholder="Tryout UM & UTBK, Materi UM & UTBK"></textarea>
                            <label for="benefits_x" style="font-weight: 400; font-size:12px;">*Bukan benefit (X), Pisahkan dengan koma.</label>
                            <textarea class="form-control" id="benefits_v" name="benefits_y" placeholder="Tryout SKD & SKB, Materi SKD & SKB"></textarea>
                            <label for="benefits_y" style="font-weight: 400; font-size: 12px;">Benefit (V), Pisahkan dengan koma.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Icon</th>
                        <td class="col-8">
                            <div id="new-image" style="display: none;">
                                <img src="" alt="" class="rounded" style="width: 200px; height: auto;">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="icon" name="icon">
                                <label class="custom-file-label" for="icon">Pilih gambar</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tipe Belajar</th>
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
<script>
    $(document).ready(function() {
        $('#icon').change(function(){
            let input = this;
            let url = $(this).val();
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#new-image img').attr('src', e.target.result);
                    console.log(e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
                $('#new-image').css('display', 'block');
            }
        });
    })
</script>
@endsection