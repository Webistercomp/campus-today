@extends('admin.layouts')

@section('title')
    Artikel | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Artikel</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.article.index')}}" class="btn btn-secondary">Kembali</a>
            <a href="{{route('admin.article.edit', $article->id)}}" class="btn btn-warning">Edit</a>
            <form class="d-inline-block" action="{{route('admin.article.delete', $article->id)}}" method="post">
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
                <th>Judul</th>
                <td>{{$article->title}}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{$article->description}}</td>
            </tr>
            <tr>
                <th>Gambar (Cover)</th>
                <td>
                    @if($article->image)
                    <img src={{asset('storage/images/article/' . $article->image)}} alt="" width="200px" height="auto" class="rounded">
                    @else
                    <img src={{asset('static/default-image-article.jpg')}} alt="" width="200px" height="auto" class="rounded">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Isi Artikel</th>
                <td>{!!$article->body!!}</td>
            </tr>
            <tr>
                <th>Aktif</th>
                <td>{{$article->active ? 'Ya' : 'Tidak'}}</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection