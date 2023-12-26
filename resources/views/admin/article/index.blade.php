@extends('admin.layouts')

@section('title')
    Articles | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="mb-3">
        <a href={{route('admin.article.create')}} class="btn btn-warning">Buat Baru</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Aktif</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>{{$article->description}}</td>
            <td>{{$article->active}}</td>
            <td>
                <a href={{route('admin.article.show', $article->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection