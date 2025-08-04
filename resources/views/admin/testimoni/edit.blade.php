@extends('admin.layouts')

@section('title')
    Edit Testimoni | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Testimoni</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.testimoni.index')}}" class="btn btn-secondary">Kembali</a>
            <form action={{route('admin.testimoni.delete', $testimoni->id)}} method="post" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.testimoni.update', $testimoni->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Nama</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$testimoni->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Testimoni</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="testimoni" name="testimoni">{{$testimoni->testimoni}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Institusi Sebelumnya</th>
                        <td class="col-8">
                            <div class="form-floating">
                                <input class="form-control" name="institusi_sebelumnya" id="institusi_sebelumnya" value={{$testimoni->institusi_sebelumnya}}>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Institusi Sekarang</th>
                        <td class="col-8">
                            <div class="form-floating">
                                <input class="form-control" name="institusi_sekarang" id="institusi_sekarang" value={{$testimoni->institusi_sekarang}}>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Photo (Pemberi Testimoni)</th>
                        <td class="col-8">
                            <div id="new-image">
                                <img src={{$testimoni->photo}} style="width: 200px; height: 200px; object-fit:cover; border-radius: 50%;">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo">
                                <label class="custom-file-label" for="customFile">Pilih gambar</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Aktif</th>
                        <td class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="active" name="active" @if($testimoni->active == 1) checked @endif>
                                <label class="form-check-label" for="active">
                                  Aktif
                                </label>
                            </div>
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
        $('#photo').change(function(){
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
