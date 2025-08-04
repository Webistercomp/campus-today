@extends('admin.layouts')

@section('title')
    Users | Campus Today
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail User</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.user.index')}}" class="btn btn-secondary">Kembali</a>
            <a href="{{route('admin.user.edit', $selectedUser->id)}}" class="btn btn-warning">Edit</a>
            <form class="d-inline-block" action="{{route('admin.user.delete', $selectedUser->id)}}" method="post">
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
                <th>Name</th>
                <td>{{$selectedUser->name ?? '-'}}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>
                    <a href={{route('admin.packet.show', $selectedUser->role->id)}} class="btn bg-primary">{{$selectedUser->role->name ?? '-'}}</a>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$selectedUser->email ?? '-'}}</td>
            </tr>
            <tr>
                <th>Email Verified at</th>
                <td>{{$selectedUser->email_verified_at ?? '-'}}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{$selectedUser->tanggal_lahir ?? '-'}}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td>{{$selectedUser->nohp ?? '-'}}</td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td>{{$selectedUser->pekerjaan ?? '-'}}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{$selectedUser->jenis_kelamin ?? '-'}}</td>
            </tr>
            <tr>
                <th>Kota / Kabupaten</th>
                <td>{{$selectedUser->kota_kabupaten ?? '-'}}</td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td>{{$selectedUser->provinsi ?? '-'}}</td>
            </tr>
            <tr>
                <th>Pendidikan Terakhir</th>
                <td>{{$selectedUser->pendidikan_terakhir ?? '-'}}</td>
            </tr>
            <tr>
                <th>Institusi</th>
                <td>{{$selectedUser->institusi ?? '-'}}</td>
            </tr>
            <tr>
                <th>Joined at</th>
                <td>{{$selectedUser->created_at ?? '-'}}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="card p-3">
        <h5>Grafik Score Tryout</h5>
        @if(count($tryout_histories) == 0)
            <h6 class="mx-auto">User belum pernah mengerjakan tryout</h6>
        @else
            <canvas id="tryout_chart"></canvas>
        @endif
    </div>
</div>
<script>
    const data = {!!json_encode($tryout_histories)!!};

    const ctx = document.getElementById('tryout_chart');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(dt => dt.name),
            datasets: [
                {
                    label: "Score Tryout",
                    data: data.map(dt => dt.score),
                },
            ],
        },
        options: {
            plugins: {
                title: { display: true },
                legend: {
                    display: true,
                },
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: "Tryout",
                        color: "#2A8AC9",
                        font: {
                            size: 20,
                            weight: 600,
                        },
                    },
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: "Score",
                        color: "#2A8AC9",
                        font: {
                            size: 20,
                            weight: 600,
                        },
                    },
                },
            },
        }
    })
</script>
@endsection