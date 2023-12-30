@extends('admin.layouts')

@section('title')
    Tryouts | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail tryout</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.tryout.show', $tryout->id)}}" class="btn btn-secondary">Kembali</a>
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
        <div class="col-md-6 d-flex align-items-center mt-4" id="daftar-soal">
            <h5>Daftar Soal</h5>
        </div>
        <ol id="question-list" type="1">
            @foreach ($tryout->questions as $question)
            <li class="mb-4">
                <div id={{"div_question_" . $question->id}}>
                    <span class="question">{{$question->question}}</span>
                </div>
                <p class="m-0">Pilihan jawaban: </p>
                <ol type="A" class="row row-cols-3" id={{"div_answers_" . $question->id}}>
                    @foreach ($question->answers as $answer)
                    <li @class(['pr-4']) id={{'div_answer_' . $answer->id}}>
                        <span class="answer">{{$answer->answer}}</span>
                    </li>
                    @endforeach
                </ol>
                <form action={{route('admin.question.update')}} method="post" style="display: inline-block">
                    @csrf
                    <div id={{"input_question_" . $question->id}} style="display:none">
                        <input type="hidden" name="question_id" value={{$question->id}}>
                        <input type="text" name="question" id="question_{{$question->id}}" class="question form-control" value="{{$question->question}}">
                    </div>
                    <ol type="A" class="row row-cols-3" id={{"edit_answers_" . $question->id}} style="display:none">
                        @foreach ($question->answers as $answer)
                        <li @class(['pr-4']) id={{'input_answer_' . $answer->id}}>
                            <input type="text" name="answers[]" id="question_{{$question->id}}_answer_{{$answer->id}}" class="answer form-control" value="{{$answer->answer}}">
                        </li>
                        @endforeach
                    </ol>
                    
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
            <button id="add-question" type="button" class="btn btn-warning">Tambah Soal</button>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    let questions = {!!json_encode($tryout->questions->toArray())!!}
    let question_counter = questions.at(-1).id + 1
    let answer_counter = questions.at(-1).answers.at(-1).id + 1

    $('#add-question').on('click', () => {
        const questionWrapper = document.querySelector('#question-list');
        const question = document.createElement("li")
        const qInput = document.createElement("input")
        const qText = document.createElement("p")
        const answerWrapper = document.createElement("ol")

        qInput.type = "text"
        qInput.name = `question_${question_counter}`
        qInput.setAttribute("placeholder", `Soal ke-${question_counter}`)
        qInput.setAttribute("value", ``)
        qInput.id = `question_${question_counter}`
        qInput.classList.add("question", "form-control")
        question.appendChild(qInput)

        qText.innerText = "Pilihan jawaban: "
        qText.classList.add("m-0")
        question.appendChild(qText)

        answerWrapper.type = "A"
        answerWrapper.classList.add("row", "row-cols-3")
        for (let i = 1; i <= 5; i++) {
            const answer = document.createElement("li")
            const answerInput = document.createElement("input")
            answerInput.type = "text"
            answerInput.name = `question_${question_counter}_answer_${answer_counter}`
            answerInput.classList.add(`answer`, 'form-control')
            answerInput.setAttribute("id", `question_${question_counter}_answer_${answer_counter}`)
            answerInput.setAttribute("placeholder", `Jawaban ${i}`)
            answerInput.setAttribute("value", ``)
            answer.classList.add("pr-4")
            answer.appendChild(answerInput)
            answerWrapper.appendChild(answer)
            answer_counter++
        }
        question.classList.add("mb-4")
        question.appendChild(answerWrapper)
        questionWrapper.appendChild(question)
        question_counter++
    })
});

function startEditQuestion(idQuestion) {
    let questionInput = document.querySelector(`#input_question_${idQuestion}`)
    let questionDiv = document.querySelector(`#div_question_${idQuestion}`)
    let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
    let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
    let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
    let editAnswers = document.querySelector(`#edit_answers_${idQuestion}`)
    let divAnswers = document.querySelector(`#div_answers_${idQuestion}`)
    questionInput.style.display = "block"
    questionDiv.style.display = "none"
    cancelBtn.style.display = "inline-block"
    simpanBtn.style.display = "inline-block"
    editBtn.style.display = "none"
    editAnswers.style.display = "flex"
    divAnswers.style.display = "none"
}

function cancelEditQuestion(idQuestion) {
    let questionInput = document.querySelector(`#input_question_${idQuestion}`)
    let questionDiv = document.querySelector(`#div_question_${idQuestion}`)
    let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
    let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
    let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
    let editAnswers = document.querySelector(`#edit_answers_${idQuestion}`)
    let divAnswers = document.querySelector(`#div_answers_${idQuestion}`)
    questionInput.style.display = "none"
    questionDiv.style.display = "block"
    cancelBtn.style.display = "none"
    simpanBtn.style.display = "none"
    editBtn.style.display = "inline-block"
    editAnswers.style.display = "none"
    divAnswers.style.display = "flex"
}
</script>
@endsection