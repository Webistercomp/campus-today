@extends('admin.layouts')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
@endsection

@section('title')
    Materi | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Materi</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.materi.index')}}" class="btn btn-secondary">Kembali</a>
            <form class="d-inline-block" action="{{route('admin.materi.delete', $material->id)}}" method="post">
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
        <form action="{{route('admin.materi.update', $material->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" @if ($materialType->id == $material->material_type_id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Group</th>
                        <td class="col-8">
                            <select class="custom-select" name="group_id" id="group_id">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}" @if ($group->id == $material->group_id) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6" value={{$material->roles}}>
                            <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">Daftar role : @foreach ($roles as $role)
                                {{$loop->iteration . ') ' . $role->name . ', '}}  
                            @endforeach . Pisahkan dengan koma, contoh : 1,2,3 atau 3,5,6.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Judul</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title" value="{{$material->title}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Kode</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code" value="{{$material->code}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Deskripsi">{{$material->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tipe Pembelajaran</th>
                        <td class="col-8">
                            <select class="custom-select" name="type" id="type">
                                <option value="teks" @if ($material->type == 'teks') selected @endif>Teks</option>
                                <option value="video" @if ($material->type == 'video') selected @endif>Video</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3 m-0">
                <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
            </div>
        </form>
        <div class="col-md-6 d-flex align-items-center mt-4" id="daftar-soal">
            <h5>Daftar Materi Bab</h5>
        </div>
        @if($material->chapters->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol "tambah bab" untuk menambah materi bab.
        </div>
        @endif
        <ol id="chapter-list" type="1">
            @foreach ($material->chapters as $chapter)
            <li class="mb-4">
                <div id={{"judul_chapter_" . $chapter->id}} class="flex-column">
                    <span style="font-weight: 600">Judul : </span>
                    <span class="judul">{{$chapter->judul}}</span>
                </div>
                <div id={{"subjudul_chapter_" . $chapter->id}} class="flex-column">
                    <span style="font-weight: 600">Subjudul : </span>
                    <span class="subjudul">{{$chapter->subjudul}}</span>
                </div>
                <div id={{"body_chapter_" . $chapter->id}} class="flex-column">
                    <span style="font-weight: 600">Body : </span>
                    <span class="body">{!!$chapter->body!!}</span>
                </div>
                <div id={{"file_chapter_" . $chapter->id}}>
                    <span style="font-weight: 600">File : </span>
                    @if($chapter->file != null)
                    <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                    <iframe
                        src={{asset("storage/materi/file/" . $chapter->file)}}
                        height="200px"
                        loading="lazy"
                        title="PDF-file"
                    ></iframe>
                    @else
                    Tidak ada file
                    @endif
                </div>
                <div id={{"video_chapter_" . $chapter->id}}>
                    <span style="font-weight: 600">Video : </span>
                    @if($chapter->link != null)
                    <a href={{$chapter->link}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                    <div class="video-container">
                        <video width="500px" 
                            height="auto" 
                            controls="controls">
                            <source 
                                    src={{$chapter->link}}
                                    type="video/mp4" />
                        </video>
                    </div>
                    <style>
                        .video-container {
                        position: block;
                        }
                        .video-container iframe {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        }
                    </style>
                    @else
                    Tidak ada video
                    @endif
                </div>
                <form action={{route('admin.chapter.update', $chapter->id)}} method="post" style="display: inline-block; width: 100%;" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id={{"input_chapter_" . $chapter->id}} style="display:none">
                        <input type="hidden" name="chapter_id" value={{$chapter->id}}>
                        <input type="hidden" name="material_id" value={{$chapter->material_id}}>
                        <div>
                            <span style="font-weight: 600; display: block;">Judul : </span>    
                            <input type="text" name="judul" id="input_judul_{{$chapter->id}}" class="form-control" value="{{$chapter->judul}}" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Subjudul : </span>
                            <input type="text" name="subjudul" id="input_subjudul_{{$chapter->id}}" class="form-control" value="{{$chapter->subjudul}}" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Body : </span>
                            <textarea type="text" name="body" id="input_body_{{$chapter->id}}" class="form-control ckeditor" style="display: block">{{$chapter->body}}</textarea>
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">File : </span>
                            @if($chapter->file == null)
                            File materi kosong
                            @else
                            <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                            <iframe
                                src={{asset("storage/materi/file/" . $chapter->file)}}
                                height="200px"
                                loading="lazy"
                                title="PDF-file"
                            ></iframe>
                            @endif
                            <input type="file" name="file" id="input_file_{{$chapter->id}}" class="form-control" value="{{$chapter->file}}" style="display: block" onchange="changePDF({{$chapter->id}})">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Video : </span>
                            @if($chapter->link != null)
                            <a href={{$chapter->link}} target="_blank" class="badge bg-primary">Open in new tab</a> 
                            <br>
                            <div class="video-container">
                                <video width="500px" 
                                    height="auto" 
                                    controls="controls">
                                    <source 
                                            src={{$chapter->link}}
                                            type="video/mp4" />
                                </video>
                            </div>
                            @endif
                            <input type="file" name="video" id="input_video_{{$chapter->id}}" class="form-control" value="{{$chapter->link}}" style="display: block">
                            <div style="font-size: 14px; margin-bottom: 10px">*Maksimal ukuran video : 1GB</div>
                        </div>
                    </div>
                    <button type="button" class="badge bg-warning border-0" onclick="startEditChapter({{$chapter->id}})" id={{"editBtn_" . $chapter->id}}>Edit</button>
                    <button type="button" class="badge bg-secondary border-0" onclick="cancelEditChapter({{$chapter->id}})" id={{"cancelBtn_" . $chapter->id}} style="display:none">Batal</button>
                    <button type="submit" class="badge bg-primary border-0" onclick="cancelEditChapter({{$chapter->id}}, {{$chapter->material_id}})" id={{"simpanBtn_" . $chapter->id}} style="display:none">Simpan</button>
                </form>
                <form action={{route('admin.chapter.delete', $chapter->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger border-0" id={{"hapusBtn_" . $chapter->id}}>Hapus</button>
                </form>
                <form action={{route('admin.chapterFile.delete', $chapter->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger border-0" id={{"hapusFileBtn_" . $chapter->id}}>Hapus File</button>
                </form>
                <form action={{route('admin.chapterVideo.delete', $chapter->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger border-0" id={{"hapusVideoBtn_" . $chapter->id}}>Hapus Video</button>
                </form>
            </li>
            @endforeach
        </ol>
        <input type="hidden" name="data" value="" id="data">
        <div class="d-flex mt-3 m-0 justify-content-end">
            <button id="add-chapter" type="button" class="btn btn-warning" onclick="addNewChapter({{$material->id}})">Tambah Bab</button>
        </div>
    </div>
</div>

<style>
    p {
        margin-bottom: 0;
    }
</style>

{{-- ckeditor --}}
<script>
    let inputs = document.querySelectorAll( '.ckeditor' )
    inputs.forEach(input => {
        CKEDITOR.replace(input.id, {
            filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    })
</script>

<script>
    $(document).ready(function() {
        $('#title').on('keyup', function() {
            var title = $('#title').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })
    });

    function addNewChapter(materialID){
        const newChapterUID = 'new_chapter_' + Date.now();
        const chapter_list_OL = document.querySelector('#chapter-list');
        const chapter_LI = document.createElement('li');
        chapter_LI.classList.add('mb-4');
        chapter_LI.setAttribute('id', `chapter_${newChapterUID}_LI`);
        chapter_LI.innerHTML = `
            <div id="judul_chapter_${newChapterUID}" class="flex-column">
                <span style="font-weight: 600">Judul : </span>
                <span class="judul">Judul Bab Baru</span>
            </div>
            <div id="subjudul_chapter_${newChapterUID}" class="flex-column">
                <span style="font-weight: 600">Subjudul : </span>
                <span class="subjudul">Subjudul Bab Baru</span>
            </div>
            <div id="body_chapter_" class="flex-column">
                <span style="font-weight: 600">Body : </span>
                <span class="body">Body baru</span>
            </div>
            <div id="file_chapter_${newChapterUID}">
                <span style="font-weight: 600">File : </span>
                Tidak ada file
            </div>
            <div id="video_chapter_${newChapterUID}">
                <span style="font-weight: 600">Video : </span>
                Tidak ada video
            </div>
            <form action="{{route('admin.chapter.create')}}" method="POST" style="display: inline-block; width: 100%;" enctype="multipart/form-data">
                @csrf
                <div id="input_chapter_${newChapterUID}" style="display:none">
                    <input type="hidden" name="chapter_id" value="${newChapterUID}"">
                    <input type="hidden" name="material_id" value="${materialID}">
                    <div>
                        <span style="font-weight: 600; display: block;">Judul : </span>    
                        <input type="text" name="judul" id="input_judul_${newChapterUID}" class="form-control" placeholder="Judul Bab Baru" style="display: block">
                    </div>
                    <div>
                        <span style="font-weight: 600; display: block">Subjudul : </span>
                        <input type="text" name="subjudul" id="input_subjudul_${newChapterUID}" class="form-control" placeholder="Subjudul Bab Baru" style="display: block">
                    </div>
                    <div>
                        <span style="font-weight: 600; display: block">Body : </span>
                        <textarea type="text" name="body" id="input_body_${newChapterUID}" class="form-control new-ckeditor" style="display: block"></textarea>
                    </div>
                    <div>
                        <span style="font-weight: 600; display: block">File : </span>
                        File materi kosong
                        <input type="file" name="file" id="input_file_${newChapterUID}" class="form-control" style="display: block" onchange="changePDF(${newChapterUID})">
                    </div>
                    <div>
                        <span style="font-weight: 600; display: block">Video : </span>
                        <input type="file" name="video" id="input_video_${newChapterUID}" class="form-control" style="display: block">
                    </div>
                </div>
                <button type="button" class="badge bg-warning border-0" onclick="startEditChapter('${newChapterUID}')" id="editBtn_${newChapterUID}">edit</button>
                <button type="button" class="badge bg-secondary border-0" onclick="cancelEditChapter('${newChapterUID}')" id="cancelBtn_${newChapterUID}" style="display:none">batal</button>
                <button type="submit" class="badge bg-primary border-0" onclick="cancelEditChapter('${newChapterUID}')" id="simpanBtn_${newChapterUID}" style="display:none">simpan</button>
            </form>
            <button type="submit" class="badge bg-danger border-0" id="hapusBtn_${newChapterUID}" onclick="deleteNewChapter('${newChapterUID}')" >hapus</button>
        `;
        chapter_list_OL.append(chapter_LI);
        let bodies = document.querySelectorAll('.new-ckeditor');
        bodies.forEach((body) => {
            CKEDITOR.replace(body.id, {filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'})
        })
    }

    function startEditChapter(idQuestion) {
        let inputChapter = document.querySelector(`#input_chapter_${idQuestion}`)
        let divJudul = document.querySelector(`#judul_chapter_${idQuestion}`)
        let divSubjudul = document.querySelector(`#subjudul_chapter_${idQuestion}`)
        let divFile = document.querySelector(`#file_chapter_${idQuestion}`)
        let divVideo = document.querySelector(`#video_chapter_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        inputChapter.style.display = "block"
        divJudul.style.display = "none"
        divSubjudul.style.display = "none"
        divFile.style.display = "none"
        divVideo.style.display = "none"
        cancelBtn.style.display = "inline-block"
        simpanBtn.style.display = "inline-block"
        editBtn.style.display = "none"
    }

    function cancelEditChapter(idQuestion) {
        let inputChapter = document.querySelector(`#input_chapter_${idQuestion}`)
        let divJudul = document.querySelector(`#judul_chapter_${idQuestion}`)
        let divSubjudul = document.querySelector(`#subjudul_chapter_${idQuestion}`)
        let divFile = document.querySelector(`#file_chapter_${idQuestion}`)
        let divVideo = document.querySelector(`#video_chapter_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        inputChapter.style.display = "none"
        divJudul.style.display = "block"
        divSubjudul.style.display = "block"
        divFile.style.display = "block"
        divVideo.style.display = "block"
        cancelBtn.style.display = "none"
        simpanBtn.style.display = "none"
        editBtn.style.display = "inline-block"
    }

    function deleteNewChapter(idChapter){
        const newQuestion_Li = document.querySelector(`#chapter_${idChapter}_LI`);
        newQuestion_Li.remove();
    }
</script>
@endsection