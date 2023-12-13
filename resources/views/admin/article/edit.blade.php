@extends('admin.layouts')

@section('title')
    Edit Article | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Article</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.article.show', $article->id)}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.article.update', $article->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Title</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description" value="{{$article->description}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Body</th>
                        <td class="col-8">
                            <div class="form-floating">
                                <textarea class="form-control" name="body" id="body" placeholder="Badan Artikel"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Image</th>
                        <td class="col-8">
                            <div class="custom-file">
                                <input type="file" class="" id="image" name="image">
                                <label class="custom-file-label" for="customFile">Choose image</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Active</th>
                        <td class="col-8">
                            <div class="form-check">
                                <input type='hidden' value='0' name='active'>
                                <input class="form-check-input" type="checkbox" value="1" id="active" name="active" @if($article->active == 1) checked @endif>
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
@endsection