@extends('admin.layouts')

@section('title')
    Users | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="ml-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Filter
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="{{route('admin.user.index')}}" method="get">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="w-100">
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Role</td>
                                        <td>
                                            <select name="role" id="role" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                @foreach($roles as $role)
                                                <option value={{$role->id}} @if($role->id == $requestroleid) selected @endif>{{$role->name}}</option>
                                                @endforeach
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
    <div class="mb-3" style="color: red;">
        Search result : {{$users->count()}} data
    </div>
    <div class="mt-3">
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Tanggal Lahir</th>
                <th>Detail</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->nohp}}</td>
                    <td>{{$user->tanggal_lahir}}</td>
                    <td>
                        <a href={{route('admin.user.show', $user->id)}}>
                            <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection