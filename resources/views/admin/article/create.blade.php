@extends('admin.layouts')

@section('title')
    Artikel | Campus Today
@endsection

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Buat Baru Artikel</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.article.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Judul</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Isi Artikel</th>
                        <td class="col-8">
                            <div class="form-floating">
                                <textarea class="form-control" name="body" id="body" placeholder="Badan Artikel"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Gambar (Cover)</th>
                        <td class="col-8">
                            <div id="new-image" style="display: none;">
                                <img src="" alt="" class="rounded" style="width: 200px; height: auto;">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="customFile">Pilih gambar</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Aktif</th>
                        <td class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="active" name="active">
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
        $('#image').change(function(){
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

    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection