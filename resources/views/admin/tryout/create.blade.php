@extends('admin.layouts')

@section('title')
    Tryouts Create | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Create New Tryout</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.tryout.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.tryout.store')}}" method="post">
            @csrf
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Material Type</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}">{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Group</th>
                        <td class="col-8">
                            <select class="custom-select" name="group_id" id="group_id">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <select class="custom-select" name="roles" id="roles">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Name</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Code</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Time</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="time" name="time" min="1" step="1">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="description" name="description">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Active</th>
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
@endsection