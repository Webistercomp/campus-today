@extends('admin.layouts')

@section('title')
    Materi | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div>
            <a href={{route('admin.materi.create')}} class="btn btn-warning mb-3">Buat baru</a>
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
                        <form action="{{route('admin.materi.index')}}" method="get">
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
                                            <select name="tipemateri" id="tipemateri" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($materialTypes as $materialType)
                                                <option value={{$materialType->id}} @if($materialType->id == $tipemateri) selected @endif>{{$materialType->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Group</td>
                                        <td>
                                            <select name="grouptype" id="grouptype" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($groupTypes as $group)
                                                <option value={{$group->id}} @if($group->id == $grouptype) selected @endif>{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Tipe Pembelajaran</td>
                                        <td>
                                            <select name="tipepembelajaran" id="tipepembelajaran" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                <option value="teks" @if($tipepembelajaran == 'teks') selected @endif>teks</option>
                                                <option value="video" @if($tipepembelajaran == 'video') selected @endif>video</option>
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
    @if($tipemateri != '' || $grouptype != '' || $tipepembelajaran != '')
    <div class="mb-3" style="color: red;">
        Search result : {{$materials->count()}} data
    </div>
    @endif
    <div>
        <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Tipe Materi</th>
            <th>Group</th>
            <th>Judul</th>
            <th>Tipe Pembelajaran</th>
            <th>Detail</th>
        </thead>
        <tbody>
            @foreach ($materials as $materi)
            <tr>
                <td>{{$materi->id}}</td>
                <td>{{$materi->materialType->name}}</td>
                <td>{{$materi->groupType->name}}</td>
                <td>{{$materi->title}}</td>
                <td>{{$materi->type}}</td>
                <td>
                    <a href={{route('admin.materi.edit', $materi->id)}} class="badge bg-primary">
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