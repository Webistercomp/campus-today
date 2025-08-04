@extends('admin.layouts')

@section('title')
    Tryouts History | Campus Today
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>User</th>
        <th>Tryout</th>
        <th>Skor</th>
        <th>Durasi</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($tryoutHistories as $tryoutHistory)
        <tr>
            <td>{{$tryoutHistory->id}}</td>
            <td>{{$tryoutHistory->user->name}}</td>
            <td>{{$tryoutHistory->tryout->name}}</td>
            <td>{{$tryoutHistory->score}}</td>
            <td>{{$tryoutHistory->duration}}</td>
            <td class="">
                <a href={{route('admin.tryouthistory.show', $tryoutHistory->id)}} class="badge bg-primary">
                    <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection