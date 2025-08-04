@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="px-2">
    <div class="bg-white rounded-md shadow-md w-full p-3">
        <header class="flex justify-between items-center">
            <h1 class="text-lg">Edit Minat Bakat</h1>
            <a href={{route('admin.minatbakat.show', $minatbakat->type)}} class="bg-slate-500 text-white px-3 py-2 rounded-sm hover:bg-slate-600 transition-colors duration-150">Kembali</a>
        </header>
        <section class="mt-4">
            {{$minatbakat->title}}
            <form action={{route('admin.minatbakat.update', $minatbakat->id)}} method="POST" class="flex flex-col">
                @csrf
                @method('PUT')
                <table class="w-full table-auto">
                    <tbody>
                        <tr>
                            <td class="font-semibold w-1/3">Nama</td>
                            <td>
                                <input class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" type="text" name="title" id="title" value="{{$minatbakat->title}}" />
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold w-1/3">Deskripsi</td>
                            <td>
                                <textarea class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" name="desc" id="desc" cols="30" rows="2">{{$minatbakat->desc}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold w-1/3">Tipe</td>
                            <td>
                                <input class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" type="text" name="type" id="type" value="{{$minatbakat->type}}" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded-sm hover:bg-blue-600 transition-all duration-150 self-end mt-6">Simpan</button>
            </form>
        </section>
        <section class="flex flex-col">
            <h2 class="text-lg mt-4">Daftar Soal</h2>
            <ol class="list-decimal list-inside" id="question_wrapper">
                @foreach ($minatbakat->minatBakatQuestions as $question)
                    <li class="mb-2" id="question_{{$question->id}}_wrapper" style="display: list-item;">
                        {{$question->question}}
                        <ol class="list-inside ml-3 grid grid-cols-2" style="list-style: upper-alpha">
                            @foreach ($question->minatBakatAnswer as $answer)
                                <li class="list-inside">{{$answer->answer}}</li>
                            @endforeach
                        </ol>
                        <div class="pl-3 flex gap-1 items-stretch">
                            <button class="text-white bg-amber-500 rounded-sm px-2 text-sm hover:bg-amber-600 transition-all duration-150" onclick="startEditQuestion('{{$question->id}}')">edit</button>
                            <form action="{{route('admin.minatbakat.question.delete', $question->id)}}" method="POST" class="flex">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="minatbakat_id" id="minatbakat_id" value="{{$minatbakat->id}}">
                                <button type="submit" class="text-white bg-rose-500 rounded-sm px-2 text-sm hover:bg-rose-600 transition-all duration-150">hapus</button>
                            </form>
                        </div>
                    </li>
                    <li id="question_{{$question->id}}_edit_wrapper" style="display: none;">
                        Pertanyaan
                        <form action="{{route("admin.minatbakat.question.update", $question->id)}}" method="POST" class="ml-3" style="display: inline" >
                            @csrf
                            @method("PUT")
                            <input type="hidden" name="minatbakat_id" id="minatbakat_id" value="{{$minatbakat->id}}">
                            <input type="hidden" name="question_id" id="question_id" value="{{$question->id}}">
                            <input class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" type="text" name="question" id="question" value="{{$question->question}}">
                            <p class="ml-3">Pilihan jawaban:</p>
                            <ol class="grid grid-cols-2 gap-x-8 list-inside ml-9">
                                @foreach ($question->minatBakatAnswer as $answer)
                                    <li class="list-inside" style="list-style: upper-alpha;">
                                        <textarea name="answers[]" id="question_{{$question->id}}_answer_{{$answer->id}}" class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" cols="30" rows="">{{$answer->answer}}</textarea>
                                        <label for="answer_{{$answer->id}}_bobot" class="flex gap-2 items-center mt-2" >
                                            <span class="min-w-fit">bobot :</span>
                                            <input class="px-2 py-1 w-fit border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" name="bobot[]" type="number" min="0" max="5" value="{{$answer->bobot}}">
                                        </label>
                                    </li>    
                                @endforeach
                            </ol>
                            <div class="ml-3">
                                <button type="button" class="text-white bg-slate-500 rounded-sm px-2 text-sm hover:bg-slate-600 transition-all duration-150" onclick="cancelEditQuestion('{{$question->id}}')">batal</button>
                                <button type="submit" class="text-white bg-blue-500 rounded-sm px-2 text-sm hover:bg-blue-600 transition-all duration-150" onclick="startEditQuestion('{{$question->id}}')">simpan</button>
                            </div>
                        </form>
                        <form action="{{route('admin.minatbakat.question.delete', $question->id)}}" method="POST" class="pl-3">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="minatbakat_id" id="minatbakat_id" value="{{$minatbakat->id}}">
                            <button type="submit" class="text-white bg-rose-500 rounded-sm px-2 text-sm hover:bg-rose-600 transition-all duration-150">hapus</button>
                        </form>
                    </li>
                @endforeach
            </ol>
            <button class="px-3 py-2 bg-amber-500 text-white rounded-sm hover:bg-amber-600 transition-all duration-150 self-end mt-6" onclick="addQuestion()" >Tambah Soal</button>
        </section>
    </div>
</div>
<script>
$(document).ready(function () {
    
});

function addQuestion(){
    const questionUID = `new_${Date.now()}`
    const questionWrapper_ol = document.querySelector('#question_wrapper');
    const newQuestion_li = document.createElement('li');
    const newQuestionEdit_li = document.createElement('li');
    newQuestion_li.innerHTML = `
                        Pertanyaan Baru (belum disimpan)
                        <ol class="list-inside ml-3 grid grid-cols-2" style="list-style: upper-alpha">
                            @foreach ($question->minatBakatAnswer as $answer)
                                <li class="list-inside">Jawaban</li>
                            @endforeach
                        </ol>
                        <div class="pl-3">
                            <button class="text-white bg-amber-500 rounded-sm px-2 text-sm hover:bg-amber-600 transition-all duration-150" onclick="startEditQuestion('${questionUID}')">edit</button>
                            <button class="text-white bg-rose-500 rounded-sm px-2 text-sm hover:bg-rose-600 transition-all duration-150" onclick="deleteNewQuestion('${questionUID}')">hapus</button>
                        </div>`
    newQuestion_li.setAttribute('id', `question_${questionUID}_wrapper`);
    newQuestion_li.classList.add('mb-2');
    newQuestion_li.style.display = 'list-item';

    newQuestionEdit_li.innerHTML = `
                        Pertanyaan
                        <form action="{{route('admin.minatbakat.question.create')}}" method="POST" class="ml-3" style="display: inline" >
                            @csrf
                            <input type="hidden" name="minatbakat_id" id="minatbakat_id" value="{{$minatbakat->id}}">
                            <input type="hidden" name="question_id" id="question_id" value="${questionUID}">
                            <input class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" type="text" name="question" id="question" value="Pertanyaan Baru">
                            <p class="ml-3">Pilihan jawaban:</p>
                            <ol class="grid grid-cols-2 gap-x-8 list-inside ml-9">
                                @foreach ($question->minatBakatAnswer as $answer)
                                    <li class="list-inside" style="list-style: upper-alpha;">
                                        <textarea name="answers[]" id="question_${questionUID}_answer_{{$answer->id}}" class="px-2 py-2 w-full border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" cols="30" rows="">Jawaban</textarea>
                                        <label for="answer_{{$answer->id}}_bobot" class="flex gap-2 items-center mt-2" >
                                            <span class="min-w-fit">bobot :</span>
                                            <input class="px-2 py-1 w-fit border-[1px] text-slate-800 border-slate-300 rounded-md outline-none focus-within:outline-none focus-within:border-blue-300 transition-all duration-300" name="bobot[]" type="number" min="0" max="5" value="0">
                                        </label>
                                    </li>    
                                @endforeach
                            </ol>
                            <div class="ml-3">
                                <button type="button" class="text-white bg-slate-500 rounded-sm px-2 text-sm hover:bg-slate-600 transition-all duration-150" onclick="cancelEditQuestion('${questionUID}')">batal</button>
                                <button type="submit" class="text-white bg-blue-500 rounded-sm px-2 text-sm hover:bg-blue-600 transition-all duration-150" onclick="startEditQuestion('${questionUID}')">simpan</button>
                            </div>
                        </form>
                        <div class="pl-3">
                            <button class="text-white bg-rose-500 rounded-sm px-2 text-sm hover:bg-rose-600 transition-all duration-150" onclick="deleteNewQuestion('${questionUID}')">hapus</button>
                        </div>`;
    newQuestionEdit_li.setAttribute('id', `question_${questionUID}_edit_wrapper`);
    newQuestionEdit_li.style.display = 'none';

    questionWrapper_ol.append(newQuestion_li, newQuestionEdit_li);
}

function startEditQuestion(questionID){
    let questionWrapper = document.querySelector(`#question_${questionID}_wrapper`);
    let questionEditWrapper = document.querySelector(`#question_${questionID}_edit_wrapper`);
    questionWrapper.style.display = "none";
    questionEditWrapper.style.display = "list-item";
}

function cancelEditQuestion(questionID){
    let questionWrapper = document.querySelector(`#question_${questionID}_wrapper`);
    let questionEditWrapper = document.querySelector(`#question_${questionID}_edit_wrapper`);
    questionWrapper.style.display = "list-item";
    questionEditWrapper.style.display = "none";
}

function deleteNewQuestion(questionID){
    let newQuestion_Li = document.querySelector(`#question_${questionID}_wrapper`);
    let newQuestionEdit_li = document.querySelector(`#question_${questionID}_edit_wrapper`);
    newQuestion_Li.remove();
    newQuestionEdit_li.remove();
}
</script>
@endsection