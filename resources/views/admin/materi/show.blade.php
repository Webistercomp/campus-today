@extends('admin.layouts')

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
            <a href="{{route('admin.materi.edit', $material->id)}}" class="btn btn-warning">Edit</a>
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
        <tbody>
            <tr>
                <th>Tipe Materi</th>
                <td>{{$material->materialType->name}}</td>
            </tr>
            <tr>
                <th>Group</th>
                <td>{{$material->groupType->name}}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>{{$material->roles}}</td>
            </tr>
            <tr>
                <th>Kode</th>
                <td>{{$material->code}}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{$material->title}}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{$material->description}}</td>
            </tr>
            <tr>
                <th>Tipe</th>
                <td>{{$material->type}}</td>
            </tr>
            <tr>
                <th>Total Bab</th>
                <td>{{$material->totalChapter}}</td>
            </tr>
            <tr>
                <th>Tanggal dibuat</th>
                <td>{{$material->created_at}}</td>
            </tr>
            <tr>
                <th>Tanggal diupdate</th>
                <td>{{$material->updated_at}}</td>
            </tr>
        </tbody>
    </table>

    <div class="col-md-6 d-flex align-items-center mt-4">
        <h5>Daftar Bab</h5>
    </div>
    @if($material->chapters->count() == 0)
    <div class="p-2">
        Tidak ada bab, klik tombol edit untuk menambah bab.
    </div>
    @endif
    <ol type="1">
        @foreach ($material->chapters as $chapter)
        <li class="mb-4">
            <div><span style="font-weight: 600">Judul :</span> {{$chapter->judul}}</div>
            <div><span style="font-weight: 600">Subjudul :</span> {{$chapter->subjudul}}</div>
            <div>
                <span style="font-weight: 600">File :</span>
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
            <div>
                <span style="font-weight: 600">Link Video :</span>
                @if($chapter->link != null)
                <a href={{$chapter->link}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                <iframe 
                    width="420" 
                    height="315"
                    src={{$chapter->link}}>
                </iframe>
                @else
                Tidak ada video
                @endif
            </div>
        </li>
        @endforeach
    </ol>
    </div>
</div>
@endsection