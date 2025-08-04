@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="d-flex w-100">
        <div>
            <a href={{route('admin.packethistory.create')}} class="btn btn-warning mb-3">Buat baru</a>
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
                        <form action="{{route('admin.packethistory.index')}}" method="get">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="w-100">
                                    <tr class="mb-3">
                                        <td style="font-weight: 600">Tanggal Pembayaran</td>
                                        <td>
                                            <select name="tanggal_pembayaran" id="" class="form-control" style="min-width: 200px;">
                                                <option value="all">all</option>
                                                <option value="today">today</option>
                                                <option value="week">this week</option>
                                                <option value="month">this month</option>
                                                <option value="year">this year</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="mb-3"> 
                                        <td style="font-weight: 600">Paket</td>
                                        <td>
                                            <div class="input-group">
                                                <select name="packet" id="" class="form-control" style="min-width: 200px;">
                                                    <option value="all">all</option>
                                                    @foreach ($packets as $packet)
                                                        <option value="{{$packet->id}}">{{$packet->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="mb-3"> 
                                        <td style="font-weight: 600">Status</td>
                                        <td>
                                            <div class="input-group">
                                                <select name="status" id="" class="form-control" style="min-width: 200px;">
                                                    <option value="all">all</option>
                                                    <option value="pending">pending</option>
                                                    <option value="verification">verification</option>
                                                    <option value="success">success</option>
                                                    <option value="failed">failed</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="mb-3"> 
                                        <td style="font-weight: 600">Nama User</td>
                                        <td>
                                            <input type="text" name="namauser" id="namauser" class="form-control" value={{$requestnamauser}}>
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
        Search result : {{$packetHistories->count()}} data
    </div>
    <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Tanggal Pembayaran</th>
            <th>Paket</th>
            <th>User</th>
            <th>Payment Method</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Detail</th>
        </thead>
        <tbody>
            @foreach ($packetHistories as $packetHistory)
            <tr>
                <td>{{$packetHistory->id}}</td>
                <td>{{$packetHistory->created_at ?? '-'}}</td>
                <td>{{$packetHistory->packet->name ?? '-'}}</td>
                <td>{{$packetHistory->user->name ?? '-'}}</td>
                <td>{{$packetHistory->payment_method ?? '-'}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="badge bg-primary border-0" data-toggle="modal" data-target={{'#buktipembayaran' . $packetHistory->id}}>
                        <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id={{'buktipembayaran' . $packetHistory->id}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src={{$packetHistory->bukti_pembayaran}} alt="" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($packetHistory->status == 'pending')
                        <span class="badge bg-warning text-dark">{{$packetHistory->status}}</span>
                    @elseif($packetHistory->status == 'verification')
                        <span class="badge bg-info">{{$packetHistory->status}}</span>
                    @elseif($packetHistory->status == 'success')
                        <span class="badge bg-success">{{$packetHistory->status}}</span>
                    @else
                        <span class="badge bg-danger">{{$packetHistory->status}}</span>
                    @endif
                </td>
                <td>
                    <a href={{route('admin.packethistory.show', $packetHistory->id)}} class="badge bg-primary">
                        <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection