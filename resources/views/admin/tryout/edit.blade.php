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
        <div class="col-md-6 d-flex align-items-center mt-4">
            <h5>Daftar Soal</h5>
        </div>
        <form id="question-form" method="POST">
            <ol id="question-list" type="1">
                @foreach ($tryout->questions as $question)
                <li class="mb-4">
                    <input type="text" name="question_{{$question->id}}" id="question_{{$question->id}}" class="question form-control" value="{{$question->question}}">
                    <p class="m-0">Pilihan jawaban: </p>
                    <ol type="A" class="row row-cols-3">
                        @foreach ($question->answers as $answer)
                        <li class="pr-4"><input type="text" name="question_{{$question->id}}_answer_{{$answer->id}}" id="question_{{$question->id}}_answer_{{$answer->id}}" class="answer form-control" value="{{$answer->answer}}"></li>
                        @endforeach
                    </ol>
                </li>
                @endforeach
            </ol>
            <div class="d-flex mt-3 m-0 justify-content-end">
                <button id="add-question" type="button" class="btn btn-warning">Tambah Soal</button>
                <button id="save-questions" type="submit" class="btn btn-primary ml-2">Simpan Soal</button>
            </div>
        </form>
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

    $('#question-form').on('submit', (e) => {
        e.preventDefault()

        const questionForm = document.querySelector('#question-form')
        const formData = new FormData(questionForm)
        const questionData = []
        const answerData = []
        for (const [name, value] of formData){
            if(name.includes("answer")) {
                answerData.push({name, value})
            } else {
                questionData.push({name, value})
            }
        }
        const data = questionData.map(q => {
            return {id: parseInt(q.name.replace("question_", "")), question: q.value, answers: answerData.filter(ans => ans.name.includes(q.name)).map(ans => {return {id: parseInt(ans.name.replace(`${q.name}_answer_`, "")), name: ans.name, answer: ans.value, question_id: parseInt(q.name.replace("question_", ""))}})}
        })
        console.log(data);
        // This code below is for send data to update question route
        // const route = "{!! route("admin.home") !!}"
        // $.ajax({
        //     type: "POST",
        //     url: route,
        //     data: data,
        //     dataType: "application/json",
        //     success: function (response) {
        //     }
        // });
    })
});
</script>
@endsection