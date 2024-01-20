@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container px-2">
    <div class="bg-white rounded-md shadow-md w-full p-3">
        <header class="flex justify-between items-center">
            <h1 class="text-lg">Tes Wartegg</h1>
            <a href={{route('admin.minatbakat.index')}} class="bg-slate-500 text-white px-3 py-2 rounded-sm hover:bg-slate-600 transition-colors duration-150">Kembali</a>
        </header>
        <section class="mt-4">
            <table class="table table-auto table-zebra w-full">
                <thead>
                    <tr>
                        <th class="font-semibold">No.</th>
                        <th class="font-semibold">Username</th>
                        <th class="font-semibold">File URL</th>
                        <th class="font-semibold">Analisis</th>
                        <th class="font-semibold">Status</th>
                        <th class="font-semibold">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($warteggs as $wartegg)
                        <tr class="odd:bg-white odd:hover:bg-slate-200 even:bg-slate-200 even:hover:bg-slate-300 transition-all duration-150">
                            <td>{{$i}}</td>
                            <td>{{$wartegg->name}}</td>
                            <td class="truncate text-ellipsis max-w-xs">{{$wartegg->img_url}}</td>
                            <td class="truncate text-ellipsis max-w-xs">{{$wartegg->analysis}}</td>
                            <td class="font-semibold @if ($wartegg->status == 'pending')
                            {{'text-rose-500'}}
                            @else
                            {{'text-emerald-500'}}
                            @endif">{{$wartegg->status}}</td>
                            <td><a href="{{route('admin.minatbakat.wartegg.show', $wartegg->id)}}" class="badge bg-primary">
                                <i class="fa fa-eye text-center" style="font-size:16px;color:white"></i>
                            </a></td>
                        </tr>
                    @php
                        $i++;    
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
    
@endsection