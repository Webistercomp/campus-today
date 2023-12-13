@extends('admin.layouts')

@section('title')
    Material | Campus Today
@endsection

@section('content')
<div class="container">
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Material Type</th>
        <th>Group</th>
        <th>Code</th>
        <th>Title</th>
        <th>Type</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($materials as $materi)
        <tr>
            <td>{{$materi->id}}</td>
            <td>{{$materi->materialType->name}}</td>
            <td>{{$materi->group_id}}</td>
            <td>{{$materi->code}}</td>
            <td>{{$materi->title}}</td>
            <td>{{$materi->type}}</td>
            <td>
                <a href={{route('admin.materi.show', $materi->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection