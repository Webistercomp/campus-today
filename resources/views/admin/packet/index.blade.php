@extends('admin.layouts')

@section('title')
    Packets | Campus Today
@endsection

@section('content')
<div class="container">
    <div>
        <a href={{route('admin.packet.create')}} class="btn btn-warning mb-3">Create New</a>
    </div>
    <table class="table table-striped">
    <thead>
        <th>Id</th>
        <th>Role</th>
        <th>Name</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Type</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach ($packets as $packet)
        <tr>
            <td>{{$packet->id}}</td>
            <td>{{$packet->role->name}}</td>
            <td>{{$packet->name}}</td>
            <td>Rp {{$packet->price_discount ? formatMoney($packet->price_discount) : formatMoney($packet->price_not_discount) }}</td>
            <td>{{$packet->discount ?? 0}}%</td>
            <td>{{$packet->type}}</td>
            <td>
                <a href={{route('admin.packet.show', $packet->id)}}>
                    <i class="fa fa-eye text-center" style="font-size:16px;color:blue"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script>
    function formatMoney(num) {
        var p = num.toFixed(2).split(".");
        return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return num + (num != "-" && i && !(i % 3) ? "," : "") + acc;
        }, "") + "." + p[1];
    }
</script>
@endsection