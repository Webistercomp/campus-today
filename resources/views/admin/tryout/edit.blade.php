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
            <a href="{{route('admin.tryout.show', $tryout->id)}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.tryout.update', $tryout->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" @if ($materialType->id == $tryout->material_type_id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6" value={{$tryout->roles}}>
                            <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">Daftar role : @foreach ($roles as $role)
                                {{$loop->iteration . ') ' . $role->name . ', '}}  
                            @endforeach . Pisahkan dengan koma, contoh : 1,2,3 atau 3,5,6.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Nama</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$tryout->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Kode</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code" value="{{$tryout->code}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Waktu</th>
                        <td class="col-8">
                            <input type="number" class="form-control" id="time" name="time" min="0" step="1" value="{{$tryout->time}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="deskripsi">{{$tryout->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Active</th>
                        <td class="col-8">
                            <input type="checkbox" name="active" @if($tryout->active == 1) checked @endif>
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
        $('#name').on('keyup', function() {
            var title = $('#name').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })
    });
</script>
@endsection