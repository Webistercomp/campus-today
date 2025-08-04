@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container px-2">
    <div class="bg-white rounded-md shadow-md w-full p-3">
        <header class="flex justify-between items-center">
            <h1 class="text-lg">Detail Minat Bakat</h1>
            <div class="flex gap-1">
                <a href={{route('admin.minatbakat.index')}} class="bg-slate-500 text-white px-3 py-2 rounded-sm hover:bg-slate-600 transition-colors duration-150">Kembali</a>
                <a href={{route('admin.minatbakat.edit', $minatbakat->id)}} class="bg-amber-500 text-white-800 px-3 py-2 rounded-sm hover:bg-amber-600 transition-colors duration-150">Edit</a>
                <button class="bg-rose-500 text-white px-3 py-2 rounded-sm hover:bg-rose-600 transition-colors duration-150">Delete</button>
            </div>
        </header>
        <section class="mt-4">
            <table class="table table-zebra table-auto">
                <tbody>
                    <tr class="even:bg-white odd:bg-slate-200">
                        <td class="font-semibold w-1/2">Nama</td>
                        <td>{{$minatbakat->title}}</td>
                    </tr>
                    <tr class="even:bg-white odd:bg-slate-200">
                        <td class="font-semibold w-1/2">Deskripsi</td>
                        <td>{{$minatbakat->desc}}</td>
                    </tr>
                    <tr class="even:bg-white odd:bg-slate-200">
                        <td class="font-semibold w-1/2">Tipe</td>
                        <td>{{$minatbakat->type}}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section>
            <h2 class="text-lg mt-4">Daftar Soal</h2>
            <ol class="list-decimal list-inside">
                @foreach ($minatbakat->minatBakatQuestions as $question)
                    <li class="mb-2 list-inside">
                        {{$question->question}}
                        <ol class="list-inside ml-3 grid grid-cols-2" style="list-style: upper-alpha">
                            @foreach ($question->minatBakatAnswer as $answer)
                                <li class="list-inside">{{$answer->answer}}</li>
                            @endforeach
                        </ol>
                    </li>
                @endforeach
            </ol>
        </section>
    </div>
</div>
@endsection