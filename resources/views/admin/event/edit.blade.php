@extends('admin.layouts')

@section('title')
    Event Tryout | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail event tryout</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.event.show', $tryout->id)}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.event.update', $tryout->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                <option value="" selected></option>
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" @if($tryout->material_type_id == $materialType->id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Roles</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6" value="{{$tryout->roles}}">
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
                            <label for="time" style="font-weight: 400; font-size: 12px;">*Berupa angka (dalam menit)</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description">{{$tryout->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tanggal dan Waktu Mulai</th>
                        <td class="col-8">
                            <input type="datetime-local" class="form-control" name="start_datetime" id="start_datetime" value="{{$tryout->start_datetime}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tanggal dan Waktu Selesai</th>
                        <td class="col-8">
                            <input type="datetime-local" class="form-control" name="end_datetime" id="end_datetime" value="{{$tryout->end_datetime}}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Aktif</th>
                        <td class="col-8">
                            <input type="checkbox" name="active" @if($tryout->active) checked @endif>
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
        @if($tryout->questions->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol "tambah soal" untuk menambah soal.
        </div>
        @endif
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
        $('#name').on('keyup', function() {
            var title = $('#name').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })

        let questions = {!!json_encode($tryout->questions->toArray())!!}
        const baseDeleteURL = `{!!route('admin.question.delete', "question_ID")!!}`;
        const baseEditURL = `{!!route('admin.question.update')!!}`;
        const tryout_id = `{!!$tryout->id!!}`;
        
        
        $('#name').on('keyup', function() {
            var title = $('#name').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })

        $('#add-question').on('click', () => {
            const questionUID = `new_${Date.now()}`
            const answerUID = [];
            for (let i = 1; i <= 5; i++) {
                answerUID.push(`new_${Date.now()}`)
            }
            const questionsList_Ol = document.querySelector('#question-list');
            
            const question_Li = document.createElement("li");
            question_Li.classList.add("mb-4");

            const question_Div = document.createElement("div");
            question_Div.setAttribute("id", `div_question_${questionUID}`);

            const question_Span = document.createElement("span");
            question_Span.classList.add("question");
            question_Span.innerText = `Pertanyaan`;

            question_Div.appendChild(question_Span);

            const answersChoice_P = document.createElement("p");
            answersChoice_P.innerText = "Pilihan jawaban: ";
            answersChoice_P.classList.add("m-0")

            const answers_Ol = document.createElement("ol");
            for (let i = 1; i <= 5; i++) {
                const answer_Li = document.createElement("li");

                const answer_Span = document.createElement("span");
                answer_Span.innerText = `Jawaban ${i}`;
                answer_Span.classList.add("answer");

                answer_Li.setAttribute("id", `div_answer_${answerUID[i]}`);
                answer_Li.classList.add("pr-4");
                answer_Li.appendChild(answer_Span);
                
                answers_Ol.append(answer_Li);
            }
            answers_Ol.setAttribute("type", "A");
            answers_Ol.classList.add("row", "row-cols-3");
            answers_Ol.setAttribute("id", `div_answers_${questionUID}`);
            question_Li.append(question_Div, answersChoice_P, answers_Ol);
            
            const questionAnswerEdit_Form = document.createElement("form");
            questionAnswerEdit_Form.innerHTML = `@csrf`;
            questionAnswerEdit_Form.setAttribute("method", "POST");
            questionAnswerEdit_Form.setAttribute("action", baseEditURL);
            questionAnswerEdit_Form.style.display = "inline-block";
            const questionEdit_Div = document.createElement("div");
            const questionEditId_Input = document.createElement("input");
            questionEditId_Input.setAttribute("type", "hidden");
            questionEditId_Input.setAttribute("name", "question_id");
            questionEditId_Input.setAttribute("value", questionUID);

            const questionTryoutId_Input = document.createElement("input");
            questionTryoutId_Input.setAttribute("type", "hidden");
            questionTryoutId_Input.setAttribute("name", "tryout_id");
            questionTryoutId_Input.setAttribute("value", tryout_id);

            const questionEdit_Input = document.createElement("input");
            questionEdit_Input.setAttribute("type", "text");
            questionEdit_Input.setAttribute("name", "question");
            questionEdit_Input.setAttribute("id", `question_${questionUID}`);
            questionEdit_Input.setAttribute("value", `Soal ke-${questionUID}`);
            questionEdit_Input.classList.add("question", "form-control");

            questionEdit_Div.append(questionEditId_Input, questionTryoutId_Input, questionEdit_Input);
            questionEdit_Div.setAttribute("id", `input_question_${questionUID}`);
            questionEdit_Div.style.display = "none";
            questionAnswerEdit_Form.append(questionEdit_Div);

            const answersEdit_Ol = document.createElement("ol");
            answersEdit_Ol.setAttribute("type", "A");
            answersEdit_Ol.setAttribute("id", `edit_answers_${questionUID}`);
            answersEdit_Ol.classList.add("row", "row-cols-3");
            answersEdit_Ol.style.display = "none";
            for (let i = 1; i <= 5; i++) {
                const answer_Li = document.createElement("li");

                const answer_Input = document.createElement("input");
                answer_Input.setAttribute("type", "text");
                answer_Input.setAttribute("name", "answers[]");
                answer_Input.setAttribute("id", `question_${questionUID}_answer_${i}`);
                answer_Input.setAttribute("value", `Jawaban ${i}`);
                answer_Input.classList.add("answer", "form-control");

                answer_Li.setAttribute("id", `input_answer_${answerUID[i]}`);
                answer_Li.classList.add("pr-4");
                answer_Li.appendChild(answer_Input);
                
                answersEdit_Ol.append(answer_Li);
            }
            questionAnswerEdit_Form.append(answersEdit_Ol);
            
            const questionAnswerEdit_Button = document.createElement("button");
            questionAnswerEdit_Button.innerText = "edit";
            questionAnswerEdit_Button.setAttribute("type", "button");
            questionAnswerEdit_Button.setAttribute("onclick", `startEditQuestion("${questionUID}")`);
            questionAnswerEdit_Button.setAttribute("id", `editBtn_${questionUID}`);
            questionAnswerEdit_Button.classList.add("badge", "bg-warning", "border-0", "mr-1");
            questionAnswerEdit_Form.append(questionAnswerEdit_Button);
            
            const questionAnswerCancelEdit_Button = document.createElement("button");
            questionAnswerCancelEdit_Button.innerText = "batal";
            questionAnswerCancelEdit_Button.setAttribute("type", "button");
            questionAnswerCancelEdit_Button.setAttribute("onclick", `cancelEditQuestion("${questionUID}")`);
            questionAnswerCancelEdit_Button.setAttribute("id", `cancelBtn_${questionUID}`);
            questionAnswerCancelEdit_Button.classList.add("badge", "bg-secondary", "border-0", "mr-1");
            questionAnswerCancelEdit_Button.style.display = "none";
            questionAnswerEdit_Form.append(questionAnswerCancelEdit_Button);

            const questionAnswerSaveEdit_Button = document.createElement("button");
            questionAnswerSaveEdit_Button.innerText = "simpan";
            questionAnswerSaveEdit_Button.setAttribute("type", "submit");
            questionAnswerSaveEdit_Button.setAttribute("onclick", `cancelEditQuestion("${questionUID}")`);
            questionAnswerSaveEdit_Button.setAttribute("id", `simpanBtn_${questionUID}`);
            questionAnswerSaveEdit_Button.classList.add("badge", "bg-primary", "border-0");
            questionAnswerSaveEdit_Button.style.display = "none";
            questionAnswerEdit_Form.append(questionAnswerSaveEdit_Button);

            question_Li.append(questionAnswerEdit_Form);
            
            const questionAnswerDelete_Form = document.createElement("form");
            const deleteQuestionBtn_Button = document.createElement("button");
            deleteQuestionBtn_Button.innerText = "hapus";
            deleteQuestionBtn_Button.setAttribute("id", `hapusBtn_${questionUID}`);
            deleteQuestionBtn_Button.setAttribute("type", 'button');
            deleteQuestionBtn_Button.setAttribute("onclick", `deleteNewQuestion("${questionUID}")`);
            deleteQuestionBtn_Button.classList.add("badge", "bg-danger", "border-0");
            questionAnswerDelete_Form.innerHTML = `@csrf` + `@method('DELETE')`;
            questionAnswerDelete_Form.append(deleteQuestionBtn_Button);
            questionAnswerDelete_Form.setAttribute("method", "POST");
            questionAnswerDelete_Form.setAttribute("action", baseDeleteURL.replace("question_ID", questionUID));
            questionAnswerDelete_Form.style.display = "inline-block";
            question_Li.append(questionAnswerDelete_Form);

            questionsList_Ol.append(question_Li);
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

    function deleteNewQuestion(idQuestion){
        const newQuestion_Li = document.querySelector(`#div_question_${idQuestion}`);
        const parent = newQuestion_Li.parentNode;
        parent.remove();
    }

</script>
@endsection