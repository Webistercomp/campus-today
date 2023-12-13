@extends('admin.layouts')

@section('title')
    Materials | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Material</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.materi.show', $material->id)}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.materi.update', $material->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Material Type</th>
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
                            <input type="text" class="form-control" id="roles" name="roles" value="{{$material->roles}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Code</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code" value="{{$material->code}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Title</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title" value="{{$material->title}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description" value="{{$material->description}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Type</th>
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
    </div>
</div>
@endsection