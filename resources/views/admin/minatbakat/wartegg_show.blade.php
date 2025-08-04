@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container px-2 pb-8">
    <div class="bg-white rounded-md shadow-md w-full p-3">
        <header class="flex justify-between items-center">
            <h1 class="text-lg">Detail Tes Wartegg</h1>
            <div class="flex gap-1">
                <a href="{{route('admin.minatbakat.show', 'wartegg')}}" class="bg-slate-500 text-white px-3 py-2 rounded-sm hover:bg-slate-600 transition-colors duration-150">Kembali</a>
                <form action="{{route('admin.minatbakat.wartegg.delete', $wartegg->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-500 text-white px-3 py-2 rounded-sm hover:bg-rose-600 transition-colors duration-150">Hapus</button>
                </form>
            </div>
        </header>
        <section class="mt-4">
            <img src="{{$wartegg->img_url}}" alt="{{$wartegg->filename}}" class="w-full aspect-auto max-w-3xl mx-auto">
            <div>
                <form action="{{route('admin.minatbakat.wartegg.update', $wartegg->id)}}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-1">
                        <label for="analisis">Analisis</label>
                        <textarea class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" name="analisis" id="analisis" cols="30" rows="5">{{$wartegg->analysis}}</textarea>
                    </div>
                    <div class="flex flex-col gap-1 items-start">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="px-2 py-2 border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300">
                            <option value="pending" @if ($wartegg->status == 'pending')
                                {{ 'selected' }}
                            @endif>Pending</option>
                            <option value="completed" @if ($wartegg->status == 'completed')
                                {{ 'selected' }}
                            @endif>Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-sm hover:bg-blue-600 transition-colors duration-150 self-end">Simpan</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection