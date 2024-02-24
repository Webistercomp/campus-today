@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div>
            <a href={{route('admin.tryout.create')}} class="btn btn-warning mb-3">Buat baru</a>
        </div>
        <div class="ml-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Filter
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="{{route('admin.tryout.index')}}" method="get">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="w-100">
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Tipe Materi</td>
                                        <td>
                                            <select name="materialTypeId" id="materialTypeId" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($materialTypes as $materialType)
                                                <option value={{$materialType->id}} @if($materialType->id == $materialTypeId) selected @endif>{{$materialType->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Aktif</td>
                                        <td>
                                            <select name="active" id="active" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                <option value="1" @if($active == '1') selected @endif>Aktif</option>
                                                <option value="0" @if($active == '0') selected @endif>Tidak aktif</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($materialTypeId != '' || $active != '')
    <div class="mb-3" style="color: red;">
        Search result : {{$tryouts->count()}} data
    </div>
    @endif
    <div>
        <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Tipe Materi</th>
            <th>Role</th>
            <th>Nama</th>
            <th>Waktu</th>
            <th>Jumlah Pertanyaan</th>
            <th>Aktif</th>
            <th>Detail</th>
        </thead>
        <tbody>
            @foreach ($tryouts as $tryout)
            <tr>
                <td>{{$tryout->id}}</td>
                <td>{{$tryout->materialType->name}}</td>
                <td>{{$tryout->roles}}</td>
                <td>{{$tryout->name}}</td>
                <td>{{$tryout->time}}</td>
                <td>{{$tryout->jumlah_soal}}</td>
                <td>
                    @if ($tryout->active == 1)
                        <span class="badge bg-success">V</span>
                    @else
                        <span class="badge bg-danger">X</span>
                    @endif
                </td>
                <td class="">
                    <a href={{route('admin.tryout.edit', $tryout->id)}} class="badge bg-primary">
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