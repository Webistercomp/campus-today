@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail tryout</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.tryout.show', $tryout->id)}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.tryout.update', $tryout->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Material Type</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" @if ($materialType->id == $tryout->material_type_id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Group</th>
                        <td class="col-8">
                            <select class="custom-select" name="group_id" id="group_id">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}" @if ($group->id == $tryout->group_id) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <select class="custom-select" name="roles" id="roles">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if ($role->id == $tryout->role_id) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Name</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$tryout->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Code</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code" value="{{$tryout->code}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Time</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="time" name="time" value="{{$tryout->time}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description" value="{{$tryout->description}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Active</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="active" name="active" value="{{$tryout->active}}">
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