@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="container px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 h-full w-full">
            <div class="bg-blue-500 flex flex-col rounded-md shadow-md justify-between overflow-clip">
                <h1 class="text-lg text-white p-4">Tes Wartegg</h1>
                <div class="px-4 pb-2 flex flex-col gap-2 items-end">
                    <p class="text-white bg-rose-500 py-1 px-2 rounded-sm"><span class="font-semibold">{{$wartegg->pending}}</span> Pending</p>
                    <p class="text-white bg-emerald-500 py-1 px-2 rounded-sm"><span class="font-semibold">{{$wartegg->completed}}</span> Completed</p>
                </div>
                <a href={{route('admin.minatbakat.show', "wartegg")}} class="bg-blue-600 py-1 text-white flex gap-2 items-center justify-center group">
                    <p class="group-hover:text-blue-200">More Info <i class="fas fa-arrow-circle-right"></i></p>
                </a>
            </div>
            <div class="bg-emerald-500 flex flex-col rounded-md shadow-md justify-between overflow-clip">
                <h1 class="text-lg text-white p-4">Tes Analogi Verbal</h1>
                <div class="px-4 pb-2 flex flex-col gap-2 items-end justify-start h-full">
                    <p class="bg-white !text-emerald-500 py-1 px-2 rounded-md"><span class="text-lg font-semibold">{{$tav}}</span> Soal</p>
                </div>
                <a href={{route('admin.minatbakat.show', "tav")}} class="bg-emerald-600 py-1 text-white flex gap-2 items-center justify-center group">
                    <p class="group-hover:text-emerald-200">More Info <i class="fas fa-arrow-circle-right"></i></p>
                </a>
            </div>
            <div class="bg-amber-500 flex flex-col rounded-md shadow-md justify-between overflow-clip">
                <h1 class="text-lg text-white p-4">Tes EPPS</h1>
                <div class="px-4 pb-2 flex flex-col gap-2 items-end justify-start h-full">
                    <p class="bg-white !text-amber-500 py-1 px-2 rounded-md"><span class="text-lg font-semibold">{{$epps}}</span> Soal</p>
                </div>
                <a href={{route('admin.minatbakat.show', "epps")}} class="bg-amber-600 py-1 text-white flex gap-2 items-center justify-center group">
                    <p class="group-hover:text-amber-200">More Info <i class="fas fa-arrow-circle-right"></i></p>
                </a>
            </div>
            <div class="bg-rose-500 flex flex-col rounded-md shadow-md justify-between overflow-clip">
                <h1 class="text-lg text-white p-4">Tes Matematika</h1>
                <div class="px-4 pb-2 flex flex-col gap-2 items-end justify-start h-full">
                    <p class="bg-white !text-rose-500 py-1 px-2 rounded-md"><span class="text-lg font-semibold">{{$mtk}}</span> Soal</p>
                </div>
                <a href={{route('admin.minatbakat.show', "mtk")}} class="bg-rose-600 py-1 text-white flex gap-2 items-center justify-center group">
                    <p class="group-hover:text-rose-200">More Info <i class="fas fa-arrow-circle-right"></i></p>
                </a>
            </div>
        </div>
    </div>
@endsection