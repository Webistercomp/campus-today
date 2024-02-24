@extends('admin.layouts')

@section('title')
    Latihan | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div>
            <a href={{route('admin.latihan.create')}} class="btn btn-warning mb-3">Buat baru</a>
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
                        <form action="{{route('admin.latihan.index')}}" method="get">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="w-100">
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Materi</td>
                                        <td>
                                            <select name="materialid" id="materialid" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($materials as $material)
                                                <option value={{$material->id}} @if($material->id == $materialid) selected @endif>{{$material->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Bab Materi</td>
                                        <td>
                                            <select name="chapterid" id="chapterid" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($chapters as $chapter)
                                                <option value={{$chapter->id}} @if($chapter->id == $chapterid) selected @endif>{{$chapter->judul}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Active</td>
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
    @if($materialid != '' || $chapterid != '' || $active != '')
    <div class="mb-3" style="color: red;">
        Search result : {{$latihans->count()}} data
    </div>
    @endif
    <div>
        <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Materi</th>
            <th>Bab</th>
            <th>Judul Latihan</th>
            <th>Jumlah Pertanyaan</th>
            <th>Aktif</th>
            <th>Detail</th>
        </thead>
        <tbody>
            @foreach ($latihans as $latihan)
            <tr>
                <td>{{$latihan->id}}</td>
                <td>{{$latihan->chapter->material->title}}</td>
                <td>{{$latihan->chapter->judul}}</td>
                <td>{{$latihan->name}}</td>
                <td>{{$latihan->jumlah_soal}}</td>
                <td>
                    @if ($latihan->active == 1)
                        <span class="badge badge-success">V</span>
                    @else
                        <span class="badge badge-danger">X</span>
                    @endif
                </td>
                <td>
                    <a href={{route('admin.latihan.edit', $latihan->id)}} class="badge bg-primary">
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