@extends('admin.layouts')

@section('title')
    Articles | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="mb-3">
            <a href={{route('admin.article.create')}} class="btn btn-warning">Buat Baru</a>
        </div>
        <div class="ml-auto">
            <form action={{route('admin.article.index')}} method="get" class="d-flex">
                <input type="text" name="title" class="form-control" value={{$title}}>
                <button type="submit" class="border-0 btn bg-primary ml-1">
                    Search
                </button>
            </form>
        </div>
    </div>
    @if($title && $title != '')
    <div class="mb-3" style="color: red;">
        Search result : {{$articles->count()}} data
    </div>
    @endif
    <div>
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Cover</th>
                <th>Aktif</th>
                <th>Detail</th>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{$article->id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->description}}</td>
                    <td>
                        <div style="height: 50px; width: 100px; overflow: hidden; ">
                            <img src={{$article->image}} alt="" style="width: 100%; height: 100%;">
                        </div>
                    </td>
                    <td>
                        @if($article->active)
                            <span class="badge bg-success">V</span>
                        @else
                            <span class="badge bg-success">X</span>
                        @endif
                    </td>
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
</div>
@endsection