@extends('admin.layouts')

@section('title')
    Latihan | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Buat latihan baru</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.latihan.index')}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.latihan.store')}}" method="post">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" class="material-type-option">{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_id" id='material_id' disabled="disabled">
                                <option value="" class="material-option-0"></option>
                                @foreach ($materials as $material)
                                    <option value="{{$material->id}}" class={{'material-option-' . $material->material_type_id}}>{{$material->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Bab</th>
                        <td class="col-8">
                            <select class="custom-select" name="chapter_id" id="chapter_id" disabled="disabled">
                                <option value="" class="chapter-option-0"></option>
                                @foreach ($chapters as $chapter)
                                    <option value="{{$chapter->id}}" @class([
                                        'chapter-options',
                                        'chapter-option-' . $chapter->material_id,
                                    ])>{{$chapter->judul}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Nama</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Deskripsi"></textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Aktif</th>
                        <td class="col-8">
                            <input type="checkbox" name="active" checked>
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
        let materialType = document.getElementById("material_type_id");
        materialType.addEventListener("change", function() {
            document.getElementById("material_id").removeAttribute("disabled");
            let materialTypeID = materialType.value;
            let materialTypeOptions = document.getElementsByClassName("material-type-option");
            Array.prototype.forEach.call(materialTypeOptions, function(el) {
                let materialOptions = document.getElementsByClassName("material-option-" + el.value)
                Array.prototype.forEach.call(materialOptions, function(ell) {
                    ell.style.display = "none";
                });
            });
            let materialOptionsVisible = document.getElementsByClassName("material-option-" + materialTypeID);
            Array.prototype.forEach.call(materialOptionsVisible, function(el) {
                el.style.display = "block";
            });
            // disabled the chapter field
            document.getElementById("chapter_id").setAttribute("disabled", "disabled");
        });
        let material = document.getElementById("material_id");
        material.addEventListener("change", function() {
            document.getElementById("chapter_id").removeAttribute("disabled");
            let materialID = material.value;
            console.log(materialID)
            // invisible all chapter
            let chapterOptionsAll = document.getElementsByClassName("chapter-options");
            Array.prototype.forEach.call(chapterOptionsAll, function(el) {
                el.style.display = "none";
            });
            let chapterOptionsVisible = document.getElementsByClassName("chapter-option-" + materialID);
            console.log(chapterOptionsVisible)
            Array.prototype.forEach.call(chapterOptionsVisible, function(el) {
                el.style.display = "block";
            });
        });
    })
</script>
@endsection