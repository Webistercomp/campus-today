@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h5>Detail tryout</h5>
            </div>
            <div class="col-md-6 text-right mb-3">
                <a href="{{route('admin.tryout.index')}}" class="btn btn-secondary">Kembali</a>
                <form class="d-inline-block" action="{{$tryout->is_event == 0 ? route("admin.tryout.delete", $tryout->id) : route("admin.event.delete", $tryout->id)}}" method="post">
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
            <form action="{{route('admin.tryout.update', $tryout->id)}}" method="post">
                @csrf
                @method('PUT')
                <table>
                    <tbody>
                        <tr class="row">
                            <th class="col-4">Tipe Materi</th>
                            <td class="col-8">
                                <select class="custom-select" name="material_type_id" id="material_type_id">
                                    @foreach ($materialTypes as $materialType)
                                        <option value="{{$materialType->id}}" @if ($materialType->id == $tryout->material_type_id) selected @endif>{{$materialType->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Role</th>
                            <td class="col-8">
                                <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6" value={{$tryout->roles}}>
                                <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">Daftar role : @foreach ($roles as $role)
                                    {{$loop->iteration . ') ' . $role->name . ', '}}  
                                @endforeach . Pisahkan dengan koma, contoh : 1,2,3 atau 3,5,6.</label>
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Nama</th>
                            <td class="col-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{$tryout->name}}">
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Kode</th>
                            <td class="col-8">
                                <input type="text" class="form-control" id="code" name="code" value="{{$tryout->code}}">
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Waktu</th>
                            <td class="col-8">
                                <input type="number" class="form-control" id="time" name="time" min="0" step="1" value="{{$tryout->time}}">
                                <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">*Dalam menit</label>
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Deskripsi</th>
                            <td class="col-8">
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="deskripsi">{{$tryout->description}}</textarea>
                            </td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Active</th>
                            <td class="col-8">
                                <input type="checkbox" name="active" @if($tryout->active == 1) checked @endif>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 m-0">
                    <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                </div>
            </form>
        </table>
        
        {{-- SOAL --}}
        <div class="col-md-6 d-flex align-items-center mt-4" id="daftar-soal">
            <h5>Daftar Soal</h5>
        </div>
        @if($tryout->questions->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol "tambah soal" untuk menambah soal.
        </div>
        @endif
        <ol id="question-list" type="1">
            @foreach ($tryout->questions as $question)
            <li class="mb-4">
                <div id={{"div_question_" . $question->id}} class="flex-column">
                    <span style="font-weight: 600">Pertanyaan :</span> 
                    <span class="question">{!!$question->question!!}</span>
                    <p class="m-0" style="font-weight: 600">Tipe soal : <span class="material_type" style="font-weight: 400">@foreach ($groupTypes as $groupType) @if ($groupType->id == $question->group_type_id){{$groupType->name}}@endif @endforeach</span></p>
                </div>
                <p class="m-0" style="font-weight: 600" id={{"p_divider_".$question->id}}>Pilihan jawaban : </p>
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
                <form action={{route('admin.question.update')}} method="post" style="display: inline-block">
                    @csrf
                    <div id={{"input_question_" . $question->id}} style="display:none">
                        <input type="hidden" name="question_id" value={{$question->id}}>
                        <input type="hidden" name="tryout_id" value={{$question->tryout_id}}>
                        <textarea name="question" id="question_{{$question->id}}" class="question form-control ckeditor" placeholder="Badan Artikel">{{$question->question}}</textarea>
                        <div class="mb-2 mt-2">
                            <label for={{"group_type_".$question->id}} class="col-2 m-0 p-0" >
                                Tipe soal :
                            </label>
                            <select name="group_type" id={{"group_type_".$question->id}} class="form-control form-control-sm form-select col-12" aria-label="Default select example">
                                @foreach ($groupTypes as $groupType)
                                <option value={{$groupType->id}} {{($groupType->id == $question->group_type_id ? "selected" : "")}}>{{$groupType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <ol type="A" class="row row-cols-3 p-0 pl-4" id={{"edit_answers_" . $question->id}} style="display:none">
                        <div style="font-weight: 600" class="col-12">
                            Pilihan Jawaban :
                        </div>
                        @foreach ($question->answers as $answer)
                        <li @class(['pr-4']) id={{'input_answer_' . $answer->id}}>
                            <input type="text" name="answers[]" id="question_{{$question->id}}_answer_{{$answer->id}}" class="answer form-control" value="{{$answer->answer}}">
                            <label for="answer_{{$answer->id}}_bobot" class="d-flex align-items-center my-1">
                                <p class="col-4 mb-0">bobot :</p>
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
                            <textarea name="pembahasan" id="pembahasan_{{$question->id}}" class="question form-control ckeditor">{{$question->pembahasan}}</textarea>
                        </div>
                    </div>
                    <button type="button" class="badge bg-warning border-0" onclick="startEditQuestion({{$question->id}})" id={{"editBtn_" . $question->id}}>edit</button>
                    <button type="button" class="badge bg-secondary border-0" onclick="cancelEditQuestion({{$question->id}})" id={{"cancelBtn_" . $question->id}} style="display:none">batal</button>
                    <button type="submit" class="badge bg-primary border-0" onclick="cancelEditQuestion({{$question->id}}, {{$tryout->id}})" id={{"simpanBtn_" . $question->id}} style="display:none">simpan</button>
                </form>
                <form action={{route('admin.question.delete', $question->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger border-0" id={{"hapusBtn_" . $question->id}}>hapus</button>
                </form>
            </li>
            @endforeach
        </ol>
        <input type="hidden" name="data" value="" id="data">
        <div class="d-flex mt-3 m-0 justify-content-end">
            <button id="add-question" type="button" class="btn btn-warning" onclick="addNewQuestion()" >Tambah Soal</button>
        </div>
    </div>
</div>

<style>
    p {
        margin-bottom: 0;
    }
</style>

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
function addNewQuestion(){
    const newQuestionUID = `new_${Date.now()}`;
    const newAnswerArr = new Array(5).fill(0).map((_, i) => { return {id: `new_answers_id_${Date.now()}`, answer: `Jawaban ${i+1}`, bobot: 0}});
    const questionList_OL = document.getElementById('question-list');
    const newQuestion_LI = document.createElement('li');
    newQuestion_LI.classList.add('mb-4');
    newQuestion_LI.innerHTML = `
        <div id="div_question_${newQuestionUID}" class="flex-column">
            <span style="font-weight: 600">Pertanyaan :</span> 
            <span class="question">Pertanyaan Baru</span>
            <p class="m-0" style="font-weight: 600">Tipe soal : <span class="material_type" style="font-weight: 400"></span></p>
        </div>
        <p class="m-0" style="font-weight: 600" id="p_divider_${newQuestionUID}">Pilihan jawaban : </p>
        <ol type="A" class="row row-cols-3" id="div_answers_${newQuestionUID}">
            ${newAnswerArr.map(ans => `
                <li @class(['pr-4']) id="div_answer_${ans.id}">
                    <span class="answer">${ans.answer}</span>
                </li>
            `).join('')}
        </ol>
        <div id="div_pembahasan_${newQuestionUID}" class="flex-column">
            <span style="font-weight: 600">Pembahasan : </span>
            <span class="pembahasan"></span>
        </div>
        <form action={{route('admin.question.update')}} method="post" style="display: inline-block">
            @csrf
            <div id="input_question_${newQuestionUID}" style="display:none">
                <input type="hidden" name="question_id" value="${newQuestionUID}">
                <input type="hidden" name="tryout_id" value={{$tryout->id}}>
                <textarea name="question" id="question_${newQuestionUID}" class="question form-control ckeditor new-input" placeholder="Badan Artikel">Pertanyaan Baru</textarea>
                <div class="mb-2 mt-2">
                    <label for="group_type_${newQuestionUID}" class="col-2 m-0 p-0" >
                        Tipe soal :
                    </label>
                    <select name="group_type" id="group_type_${newQuestionUID}" class="form-control form-control-sm form-select col-12" aria-label="Default select example">
                        @foreach ($groupTypes as $groupType)
                        <option value={{$groupType->id}} >{{$groupType->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <ol type="A" class="row row-cols-3 p-0 pl-4" id="edit_answers_${newQuestionUID}" style="display:none">
                <div style="font-weight: 600" class="col-12">
                    Pilihan Jawaban :
                </div>
                ${newAnswerArr.map(ans => `
                    <li @class(['pr-4']) id="input_answer_${ans.id}">
                        <input type="text" name="answers[]" id="question_${newQuestionUID}_answer_${ans.id}" class="answer form-control" value="${ans.answer}">
                        <label for="answer_${ans.id}_bobot" class="d-flex align-items-center my-1">
                            <p class="col-4 mb-0">bobot :</p>
                            <input type="number" name="bobot[]" id="answer_${ans.id}_bobot" class="form-control form-control-sm col-8" value="${ans.bobot}" min="0" max="5">
                        </label>
                    </li>        
                `).join('')}
            </ol>
            <div id="input_pembahasan_${newQuestionUID}" style="display:none" class="mt-2">
                <div style="font-weight: 600">
                    Pembahasan
                </div>
                <div>
                    <textarea name="pembahasan" id="pembahasan_${newQuestionUID}" class="question form-control ckeditor"></textarea>
                </div>
            </div>
            <button type="button" class="badge bg-warning border-0" onclick="startEditQuestion('${newQuestionUID}')" id="editBtn_${newQuestionUID}">edit</button>
            <button type="button" class="badge bg-secondary border-0" onclick="cancelEditQuestion('${newQuestionUID}')" id="cancelBtn_${newQuestionUID}" style="display:none">batal</button>
            <button type="submit" class="badge bg-primary border-0" onclick="cancelEditQuestion('${newQuestionUID}', {{$tryout->id}})" id="simpanBtn_${newQuestionUID}" style="display:none">simpan</button>
        </form>
        <button type="submit" class="badge bg-danger border-0" onclick="deleteNewQuestion('${newQuestionUID}')">hapus</button>
    `;
    questionList_OL.append(newQuestion_LI);
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
    pembahasanDiv.style.display = "block"
}

function deleteNewQuestion(idQuestion){
    const newQuestion_Li = document.querySelector(`#div_question_${idQuestion}`);
    const parent = newQuestion_Li.parentNode;
    parent.remove();
}
</script>
<script>
$(document).ready(function () {
    let questions = {!!json_encode($tryout->questions->toArray())!!}
    const baseDeleteURL = `{!!route('admin.question.delete', "question_ID")!!}`;
    const baseEditURL = `{!!route('admin.question.update')!!}`;
    const tryout_id = `{!!$tryout->id!!}`;
    const groupTypes = {!!json_encode($groupTypes->toArray())!!};
    
    $('#name').on('keyup', function() {
        var title = $('#name').val();
        var code = title.replace(/\s+/g, '_').toLowerCase();
        $('#code').val(code);
    })
});
</script>
@endsection