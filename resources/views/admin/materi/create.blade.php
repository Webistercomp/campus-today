@extends('admin.layouts')

@section('title')
    Materi | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Buat Materi Baru</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.materi.index')}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.materi.store')}}" method="post" enctype="multipart/form-data">
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
                            @error('material_type_id')
                            <div style="color: red;">{{$message}}</div>
                            @enderror
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
                            @error('group_id')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6">
                            @error('roles')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
                            <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">Daftar role : @foreach ($roles as $role)
                                {{$loop->iteration . ') ' . $role->name . ', '}}  
                            @endforeach . Pisahkan dengan koma, contoh : 1,2,3 atau 3,5,6.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Title</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title">
                            @error('title')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Code</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code">
                            @error('code')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Description</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                            @error('description')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Type</th>
                        <td class="col-8">
                            <select class="custom-select" name="type" id="type">
                                <option value="teks">Teks</option>
                                <option value="video">Video</option>
                            </select>
                            @error('type')
                            <div style="color: red; font-size: 12px;">{{$message}}</div>
                            @enderror
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

<script>
    $(document).ready(function() {
        $('#title').on('keyup', function() {
            var title = $('#title').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })
    });
</script>
@endsection