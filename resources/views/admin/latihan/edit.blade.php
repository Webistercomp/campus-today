@extends('admin.layouts')

@section('title')
    Latihan | Campus Today
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="p-3 card">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Edit Latihan</h5>
        </div>
        <div class="mb-3 text-right col-md-6">
            <a href="{{route('admin.latihan.index')}}" class="btn btn-secondary">Kembali</a>
            <form class="d-inline-block" action="{{route('admin.latihan.delete', $latihan->id)}}" method="post">
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
        <form action="{{route('admin.latihan.update', $latihan->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" class="material-type-option" @if($materialTypeID == $materialType->id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_id" id='material_id'>
                                <option value="" class="material-option-0"></option>
                                @foreach ($materials as $material)
                                    <option value="{{$material->id}}" class={{'material-option-' . $material->material_type_id}} @if($materialID == $material->id) selected @endif>{{$material->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Bab</th>
                        <td class="col-8">
                            <select class="custom-select" name="chapter_id" id="chapter_id">
                                <option value="" class="chapter-option-0"></option>
                                @foreach ($chapters as $chapter)
                                    <option value="{{$chapter->id}}" @class([
                                        'chapter-options',
                                        'chapter-option-' . $chapter->material_id,
                                    ]) @if($chapterID == $chapter->id) selected @endif>{{$chapter->judul}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Nama</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$latihan->name}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Deskripsi">{{$latihan->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Aktif</th>
                        <td class="col-8">
                            <input type="checkbox" name="active" @if($latihan->active == 1) checked @endif>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="m-0 mt-3 row">
                <button type="submit" class="ml-auto btn btn-primary">Simpan</button>
            </div>
        </form>
        <div class="mt-4 col-md-6 d-flex align-items-center" id="daftar-soal">
            <h5>Daftar Soal</h5>
        </div>
        @if($latihan->questions->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol "tambah soal" untuk menambah soal.
        </div>
        @endif
        <ol id="question-list" type="1">
            @foreach ($latihan->questions as $question)
            <li class="mb-4">
                <div id={{"div_question_" . $question->id}} class="flex-column">
                    <span style="font-weight: 600">Pertanyaan : </span>
                    <span class="question">{!!$question->question!!}</span>
                    <p class="m-0"  style="font-weight: 600">Tipe soal : <span class="material_type" style="font-weight: 400">@foreach ($groupTypes as $groupType) @if ($groupType->id == $question->group_type_id){{$groupType->name}}@endif @endforeach</span></p>
                </div>
                <p class="m-0" style="font-weight: 600" id={{"p_divider_".$question->id}}>Pilihan jawaban: </p>
                <ol type="A" class="row row-cols-3" id={{"div_answers_" . $question->id}}>
                    @foreach ($question->answers as $answer)
                    <li @class(['pr-4']) id={{'div_answer_' . $answer->id}}>
                        <span class="answer">{{$answer->answer}}</span>
                    </li>
                    @endforeach
                </ol>
                <div id={{"div_pembahasan_" . $question->id}} class="flex-column">
                    <span style="font-weight: 600">Pembahasan : </span>
                    <span class="pembahasan">{!!$question->pembahasan!!}</span>
                </div>
                <form action={{route('admin.questionLatihan.update')}} method="post" style="display: inline-block">
                    @csrf
                    <div id={{"input_question_" . $question->id}} style="display:none">
                        <input type="hidden" name="question_id" value={{$question->id}}>
                        <input type="hidden" name="latihan_id" value={{$question->latihan_id}}>
                        <textarea name="question" id="question_{{$question->id}}" class="question form-control ckeditor" placeholder="Badan Artikel">{{$question->question}}</textarea>
                        <div class="mt-2 mb-2">
                            <label for={{"group_type_".$question->id}} class="m-0 col-2" >
                                Tipe soal :
                            </label>
                            <select name="group_type" id={{"group_type_".$question->id}} class="form-control form-control-sm form-select col-12" aria-label="Default select example">
                                @foreach ($groupTypes as $groupType)
                                <option value={{$groupType->id}} {{($groupType->id == $question->group_type_id ? "selected" : "")}}>{{$groupType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <ol type="A" class="row row-cols-3" id={{"edit_answers_" . $question->id}} style="display:none">
                        <div style="font-weight: 600" class="col-12">
                            Pilihan Jawaban :
                        </div>
                        @foreach ($question->answers as $answer)
                        <li @class(['pr-4']) id={{'input_answer_' . $answer->id}}>
                            <input type="text" name="answers[]" id="question_{{$question->id}}_answer_{{$answer->id}}" class="answer form-control" value="{{$answer->answer}}">
                            <label for="answer_{{$answer->id}}_bobot" class="my-1 d-flex align-items-center">
                                <p class="mb-0 col-4">bobot :</p>
                                <input type="number" name="bobot[]" id="answer_{{$answer->id}}_bobot" class="form-control form-control-sm col-8" value="{{$answer->bobot}}" min="0" max="5">
                            </label>
                        </li>
                        @endforeach
                    </ol>
                    <div id={{"input_pembahasan_" . $question->id}} style="display:none" class="mt-2">
                        <div style="font-weight: 600">
                            Pembahasan
                        </div>
                        <div>
                            <textarea type="text" name="pembahasan" id="pembahasan_{{$question->id}}" class="question form-control ckeditor" rows="4">{{$question->pembahasan}}</textarea>
                        </div>
                    </div>
                    <button type="button" class="border-0 badge bg-warning" onclick="startEditQuestion({{$question->id}})" id={{"editBtn_" . $question->id}}>edit</button>
                    <button type="button" class="border-0 badge bg-secondary" onclick="cancelEditQuestion({{$question->id}})" id={{"cancelBtn_" . $question->id}} style="display:none">batal</button>
                    <button type="submit" class="border-0 badge bg-primary" onclick="cancelEditQuestion({{$question->id}}, {{$latihan->id}})" id={{"simpanBtn_" . $question->id}} style="display:none">simpan</button>
                </form>
                <form action={{route('admin.questionLatihan.delete', $question->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 badge bg-danger" id={{"hapusBtn_" . $question->id}}>hapus</button>
                </form>
            </li>
            @endforeach
        </ol>
        <input type="hidden" name="data" value="" id="data">
        <div class="m-0 mt-3 d-flex justify-content-end">
            <button id="add-question" type="button" class="btn btn-warning" onclick="addQuestion()">Tambah Soal</button>
        </div>
    </div>
</div>

<style>
    p {
        margin-bottom: 0;
    }
</style>

{{-- ckeditor --}}
<script>
    let inputs = document.querySelectorAll( '.ckeditor' )
    inputs.forEach(input => {
        CKEDITOR.replace(input.id, {
            filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    })
</script>

<script>
    $(document).ready(function () {
        // custom select option (by user previous input)
        let materialType = document.getElementById("material_type_id");
        materialType.addEventListener("change", function() {
            document.getElementById("material_id").removeAttribute("disabled");
            let materialTypeID = materialType.value;
            let materialTypeOptions = document.getElementsByClassName("material-type-option");
            Array.prototype.forEach.call(materialTypeOptions, function(el) {
                let materialOptions = document.getElementsByClassName("material-option-" + el.value)
                Array.prototype.forEach.call(materialOptions, function(ell) {
                    ell.style.display = "none";
                });
            });
            let materialOptionsVisible = document.getElementsByClassName("material-option-" + materialTypeID);
            Array.prototype.forEach.call(materialOptionsVisible, function(el) {
                el.style.display = "block";
            });
            // disabled the chapter field
            document.getElementById("chapter_id").setAttribute("disabled", "disabled");
        });
        let material = document.getElementById("material_id");
        material.addEventListener("change", function() {
            document.getElementById("chapter_id").removeAttribute("disabled");
            let materialID = material.value;
            console.log(materialID)
            // invisible all chapter
            let chapterOptionsAll = document.getElementsByClassName("chapter-options");
            Array.prototype.forEach.call(chapterOptionsAll, function(el) {
                el.style.display = "none";
            });
            let chapterOptionsVisible = document.getElementsByClassName("chapter-option-" + materialID);
            console.log(chapterOptionsVisible)
            Array.prototype.forEach.call(chapterOptionsVisible, function(el) {
                el.style.display = "block";
            });
        });

        // edit questions
        let questions = {!!json_encode($latihan->questions->toArray())!!}
        const baseDeleteURL = `{!!route('admin.questionLatihan.delete', "question_ID")!!}`;
        const baseEditURL = `{!!route('admin.questionLatihan.update')!!}`;
        const latihan_id = `{!!$latihan->id!!}`;
        const groupTypes = {!!json_encode($groupTypes->toArray())!!};
        
        $('#name').on('keyup', function() {
            var title = $('#name').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })
    });

    function addQuestion(){
        const newQuestionID = `new_${Date.now()}`;
        const newAnswerArr = new Array(5).fill(0).map((_, i) => { return {id: `new_answers_id_${Date.now()}`, answer: `Jawaban ${i+1}`, bobot: 0}});
        const question_list_OL = document.getElementById('question-list');
        const newQuestion_LI = document.createElement('li');
        newQuestion_LI.classList.add("mb-4");
        newQuestion_LI.innerHTML = `<div id="div_question_${newQuestionID}" class="flex-column">
                    <span style="font-weight: 600">Pertanyaan : </span>
                    <span class="question">Pertanyaan Baru</span>
                    <p class="m-0"  style="font-weight: 600">Tipe soal : <span class="material_type" style="font-weight: 400">Pilih tipe soal</span></p>
                </div>
                <p class="m-0" style="font-weight: 600" id="p_divider_${newQuestionID}">Pilihan jawaban: </p>
                <ol type="A" class="row row-cols-3" id="div_answers_${newQuestionID}">
                    ${newAnswerArr.map(ans => `
                        <li @class(['pr-4']) id="div_answer_${ans.id}">
                            <span class="answer">${ans.answer}</span>
                        </li>
                    `).join('')}
                </ol>
                <div id="div_pembahasan_${newQuestionID}" class="flex-column">
                    <span style="font-weight: 600">Pembahasan : </span>
                    <span class="pembahasan"></span>
                </div>
                <form action={{route('admin.questionLatihan.update')}} method="post" style="display: inline-block">
                    @csrf
                    <div id="input_question_${newQuestionID}" style="display:none">
                        <input type="hidden" name="question_id" value="${newQuestionID}">
                        <input type="hidden" name="latihan_id" value={{$latihan->id}}>
                        <textarea name="question" id="question_${newQuestionID}" class="question form-control ckeditor" placeholder="Badan Artikel">Pertanyaan Baru</textarea>
                        <div class="mt-2 mb-2">
                            <label for="group_type_${newQuestionID}" class="m-0 col-2" >
                                Tipe soal :
                            </label>
                            <select name="group_type" id="group_type_${newQuestionID}" class="form-control form-control-sm form-select col-12" aria-label="Default select example">
                                @foreach ($groupTypes as $groupType)
                                <option value={{$groupType->id}}>{{$groupType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <ol type="A" class="row row-cols-3" id="edit_answers_${newQuestionID}" style="display:none">
                        <div style="font-weight: 600" class="col-12">
                            Pilihan Jawaban :
                        </div>
                        ${newAnswerArr.map(ans => `
                            <li @class(['pr-4']) id="input_answer_${ans.id}">
                                <input type="text" name="answers[]" id="question_${newQuestionID}_answer_${ans.id}" class="answer form-control" value="${ans.answer}">
                                <label for="answer_${ans.id}_bobot" class="my-1 d-flex align-items-center">
                                    <p class="mb-0 col-4">bobot :</p>
                                    <input type="number" name="bobot[]" id="answer_${ans.id}_bobot" class="form-control form-control-sm col-8" value="${ans.bobot}" min="0" max="5">
                                </label>
                            </li>
                        `).join('')}
                    </ol>
                    <div id="input_pembahasan_${newQuestionID}" style="display:none" class="mt-2">
                        <div style="font-weight: 600">
                            Pembahasan
                        </div>
                        <div>
                            <textarea type="text" name="pembahasan" id="pembahasan_${newQuestionID}" class="question form-control ckeditor" rows="4"></textarea>
                        </div>
                    </div>
                    <button type="button" class="border-0 badge bg-warning" onclick="startEditQuestion('${newQuestionID}')" id="editBtn_${newQuestionID}">edit</button>
                    <button type="button" class="border-0 badge bg-secondary" onclick="cancelEditQuestion('${newQuestionID}')" id="cancelBtn_${newQuestionID}" style="display:none">batal</button>
                    <button type="submit" class="border-0 badge bg-primary" onclick="cancelEditQuestion('${newQuestionID}', {{$latihan->id}})" id="simpanBtn_${newQuestionID}" style="display:none">simpan</button>
                </form>
                <button type="submit" class="border-0 badge bg-danger" id="hapusBtn_${newQuestionID}" onclick="deleteNewQuestion('${newQuestionID}')">hapus</button>`;
        question_list_OL.append(newQuestion_LI);
        const newInputsCKEDITOR = new Array(...document.querySelectorAll('.ckeditor')).filter(input => input.id.includes('new'));
        newInputsCKEDITOR.forEach(input => {
            CKEDITOR.replace(input.id, {
                filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            })
        });
    }
    
    function startEditQuestion(idQuestion) {
        let questionInput = document.querySelector(`#input_question_${idQuestion}`)
        let questionDiv = document.querySelector(`#div_question_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        let editAnswers = document.querySelector(`#edit_answers_${idQuestion}`)
        let divAnswers = document.querySelector(`#div_answers_${idQuestion}`)
        let pDivider = document.querySelector(`#p_divider_${idQuestion}`)
        let pembahasanInput = document.querySelector(`#input_pembahasan_${idQuestion}`)
        let pembahasanDiv = document.querySelector(`#div_pembahasan_${idQuestion}`)
        questionInput.style.display = "block"
        questionDiv.style.display = "none"
        cancelBtn.style.display = "inline-block"
        simpanBtn.style.display = "inline-block"
        editBtn.style.display = "none"
        editAnswers.style.display = "flex"
        divAnswers.style.display = "none"
        pDivider.innerText = "Pertanyaan"
        pembahasanInput.style.display = "block"
        pembahasanDiv.style.display = "none"
    }

    function cancelEditQuestion(idQuestion) {
        let questionInput = document.querySelector(`#input_question_${idQuestion}`)
        let questionDiv = document.querySelector(`#div_question_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        let editAnswers = document.querySelector(`#edit_answers_${idQuestion}`)
        let divAnswers = document.querySelector(`#div_answers_${idQuestion}`)
        let pDivider = document.querySelector(`#p_divider_${idQuestion}`)
        let pembahasanInput = document.querySelector(`#input_pembahasan_${idQuestion}`)
        let pembahasanDiv = document.querySelector(`#div_pembahasan_${idQuestion}`)
        questionInput.style.display = "none"
        questionDiv.style.display = "flex"
        cancelBtn.style.display = "none"
        simpanBtn.style.display = "none"
        editBtn.style.display = "inline-block"
        editAnswers.style.display = "none"
        divAnswers.style.display = "flex"
        pDivider.innerText = "Pilihan jawaban :"
        pembahasanInput.style.display = "none"
        pembahasanDiv = "block"
    }

    function deleteNewQuestion(idQuestion){
        const newQuestion_Li = document.querySelector(`#div_question_${idQuestion}`);
        const parent = newQuestion_Li.parentNode;
        parent.remove();
    }
    </script>
@endsection