@extends('admin.layouts')

@section('title')
Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h5>Detail Tryout</h5>
            </div>
            <div class="col-md-6 text-right mb-3">
                <a href="{{route('admin.tryout.index')}}" class="btn btn-secondary">Kembali</a>
                <a href="{{route('admin.tryout.edit', $tryout->id)}}" class="btn btn-warning">Edit</a>
                <form class="d-inline-block" action="{{route('admin.event.delete', $tryout->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteData">Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteData" tabindex="-1" aria-labelledby="deleteDataLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Yakin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Tipe Materi</th>
                    <td>{{$tryout->materialType->name}}</td>
                </tr>
                <tr>
                    <th>Roles</th>
                    <td>{{$tryout->roles}}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{$tryout->name}}</td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td>{{$tryout->code}}</td>
                </tr>
                <tr>
                    <th>Waktu</th>
                    <td>{{$tryout->time}} Menit</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{$tryout->description}}</td>
                </tr>
                <tr>
                    <th>Aktif</th>
                    <td>{{$tryout->active ? 'Ya' : 'Tidak'}}</td>
                </tr>
                <tr>
                    <th>Tanggal dibuat</th>
                    <td>{{$tryout->created_at}}</td>
                </tr>
                <tr>
                    <th>Tanggal diupdate</th>
                    <td>{{$tryout->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-6 d-flex align-items-center mt-4">
            <h5>Daftar Soal</h5>
        </div>
        @if($tryout->questions->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol edit untuk menambah soal.
        </div>
        @endif
        <ol type="1">
            @foreach ($tryout->questions as $question)
            <li class="mb-4">
                {!!$question->question!!}
                <ol type="A" class="row row-cols-3">
                    @foreach ($question->answers as $answer)
                        <li class="pr-4">{{$answer->answer}}</li>
                    @endforeach
                </ol>
            </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection