@extends('admin.layouts')

@section('title')
    Latihan | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Edit Latihan</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.latihan.show', $latihan->id)}}" class="btn btn-secondary">Kembali</a>
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
            <div class="row mt-3 m-0">
                <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
            </div>
        </form>
        <div class="col-md-6 d-flex align-items-center mt-4" id="daftar-soal">
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
                    <span class="question">{{$question->question}}</span>
                    <p class="m-0">Tipe soal : <span class="material_type">@foreach ($groupTypes as $groupType) @if ($groupType->id == $question->group_type_id){{$groupType->code}}@endif @endforeach</span></p>
                </div>
                <p class="m-0" id={{"p_divider_".$question->id}}>Pilihan jawaban: </p>
                <ol type="A" class="row row-cols-3" id={{"div_answers_" . $question->id}}>
                    @foreach ($question->answers as $answer)
                    <li @class(['pr-4']) id={{'div_answer_' . $answer->id}}>
                        <span class="answer">{{$answer->answer}}</span>
                    </li>
                    @endforeach
                </ol>
                <form action={{route('admin.questionLatihan.update')}} method="post" style="display: inline-block">
                    @csrf
                    <div id={{"input_question_" . $question->id}} style="display:none">
                        <input type="hidden" name="question_id" value={{$question->id}}>
                        <input type="hidden" name="latihan_id" value={{$question->latihan_id}}>
                        <input type="text" name="question" id="question_{{$question->id}}" class="question form-control" value="{{$question->question}}">
                        <div class="row">
                            <label for={{"group_type_".$question->id}} class="col-2 m-0" >
                                Tipe soal :
                            </label>
                            <select name="group_type" id={{"group_type_".$question->id}} class="form-control form-control-sm form-select col-2" aria-label="Default select example">
                                @foreach ($groupTypes as $groupType)
                                <option value={{$groupType->id}} {{($groupType->id == $question->group_type_id ? "selected" : "")}}>{{$groupType->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <ol type="A" class="row row-cols-3" id={{"edit_answers_" . $question->id}} style="display:none">
                        @foreach ($question->answers as $answer)
                        <li @class(['pr-4']) id={{'input_answer_' . $answer->id}}>
                            <input type="text" name="answers[]" id="question_{{$question->id}}_answer_{{$answer->id}}" class="answer form-control" value="{{$answer->answer}}">
                            <label for="answer_{{$answer->id}}_bobot" class="row">
                                <p class="col-4">bobot :</p>
                                <input type="number" name="bobot[]" id="answer_{{$answer->id}}_bobot" class="form-control form-control-sm col-4" value="{{$answer->bobot}}" min="0" max="5">
                            </label>
                        </li>
                        @endforeach
                    </ol>
                    <button type="button" class="badge bg-warning border-0" onclick="startEditQuestion({{$question->id}})" id={{"editBtn_" . $question->id}}>edit</button>
                    <button type="button" class="badge bg-secondary border-0" onclick="cancelEditQuestion({{$question->id}})" id={{"cancelBtn_" . $question->id}} style="display:none">batal</button>
                    <button type="submit" class="badge bg-primary border-0" onclick="cancelEditQuestion({{$question->id}}, {{$latihan->id}})" id={{"simpanBtn_" . $question->id}} style="display:none">simpan</button>
                </form>
                <form action={{route('admin.questionLatihan.delete', $question->id)}} method="POST" style="display:inline-block">
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
            
            question_Div.append(question_Span);
    
            const answersChoice_P = document.createElement("p");
            answersChoice_P.setAttribute("id", `p_divider_${questionUID}`);
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
    
            const questionLatihanId_Input = document.createElement("input");
            questionLatihanId_Input.setAttribute("type", "hidden");
            questionLatihanId_Input.setAttribute("name", "latihan_id");
            questionLatihanId_Input.setAttribute("value", latihan_id);
    
            const questionEdit_Input = document.createElement("input");
            questionEdit_Input.setAttribute("type", "text");
            questionEdit_Input.setAttribute("name", "question");
            questionEdit_Input.setAttribute("id", `question_${questionUID}`);
            questionEdit_Input.setAttribute("value", "");
            questionEdit_Input.setAttribute("placeholder", "Pertanyaan");
            questionEdit_Input.classList.add("question", "form-control");
    
            const groupTypeEdit_Div = document.createElement("div");
            const groupTypeEdit_Label = document.createElement("label");
            const groupTypeEdit_Select = document.createElement("select");
            groupTypeEdit_Div.classList.add("row");
            groupTypeEdit_Label.setAttribute("for", `group_type_${questionUID}`);
            groupTypeEdit_Label.classList.add("col-2", "m-0");
            groupTypeEdit_Label.innerText = "Tipe soal : ";
            groupTypeEdit_Select.setAttribute("name", "group_type");
            groupTypeEdit_Select.setAttribute("id", `group_type_${questionUID}`);
            groupTypeEdit_Select.classList.add("form-select", "form-control", "form-control-sm", "col-2");
            groupTypes.forEach(groupType => {
                const groupTypeEdit_Option = document.createElement("option");
                groupTypeEdit_Option.setAttribute("value", groupType.id);
                groupTypeEdit_Option.innerText = groupType.code;
                groupTypeEdit_Select.append(groupTypeEdit_Option);
            });
            groupTypeEdit_Div.append(groupTypeEdit_Label, groupTypeEdit_Select);
    
            questionEdit_Div.append(questionEditId_Input, questionLatihanId_Input, questionEdit_Input, groupTypeEdit_Div);
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
    
                const answerBobot_Label = document.createElement("label");
                answerBobot_Label.setAttribute("for",  `answer_${answerUID[i]}_bobot`);
                answerBobot_Label.classList.add("row");
                const answerBobot_P = document.createElement("p");
                answerBobot_P.classList.add("col-4");
                answerBobot_P.innerText = "bobot : ";
                const answerBobot_Input = document.createElement("input");
                answerBobot_Input.setAttribute("type", "number");
                answerBobot_Input.setAttribute("name", "bobot[]");
                answerBobot_Input.setAttribute("id", `answer_${answerUID[i]}_bobot`);
                answerBobot_Input.setAttribute("value", 0);
                answerBobot_Input.setAttribute("min", 0);
                answerBobot_Input.setAttribute("max", 5);
                answerBobot_Input.classList.add("form-control", "form-control-sm", "col-4");
    
                answerBobot_Label.append(answerBobot_P, answerBobot_Input);
                answer_Li.appendChild(answerBobot_Label);
                
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
        let pDivider = document.querySelector(`#p_divider_${idQuestion}`)
        questionInput.style.display = "block"
        questionDiv.style.display = "none"
        cancelBtn.style.display = "inline-block"
        simpanBtn.style.display = "inline-block"
        editBtn.style.display = "none"
        editAnswers.style.display = "flex"
        divAnswers.style.display = "none"
        pDivider.innerText = "Pertanyaan"
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
        questionInput.style.display = "none"
        questionDiv.style.display = "flex"
        cancelBtn.style.display = "none"
        simpanBtn.style.display = "none"
        editBtn.style.display = "inline-block"
        editAnswers.style.display = "none"
        divAnswers.style.display = "flex"
        pDivider.innerText = "Pilihan jawaban :"
    }
    
    function deleteNewQuestion(idQuestion){
        const newQuestion_Li = document.querySelector(`#div_question_${idQuestion}`);
        const parent = newQuestion_Li.parentNode;
        parent.remove();
    }
    </script>
@endsection