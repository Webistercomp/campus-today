@extends('admin.layouts')

@section('title')
    Articles | Campus Today
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Active</th>
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
                <a href={{route('admin.article.show', $article->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection