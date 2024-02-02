@extends('admin.layouts')

@section('title')
    Materi | Campus Today
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <h5>Detail Materi</h5>
        </div>
        <div class="col-md-6 text-right mb-3">
            <a href="{{route('admin.materi.show', $material->id)}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <table class="table table-striped">
        <form action="{{route('admin.materi.update', $material->id)}}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr class="row">
                        <th class="col-4">Tipe Materi</th>
                        <td class="col-8">
                            <select class="custom-select" name="material_type_id" id="material_type_id">
                                @foreach ($materialTypes as $materialType)
                                    <option value="{{$materialType->id}}" @if ($materialType->id == $material->material_type_id) selected @endif>{{$materialType->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Group</th>
                        <td class="col-8">
                            <select class="custom-select" name="group_id" id="group_id">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}" @if ($group->id == $material->group_id) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Role</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="roles" name="roles" placeholder="Contoh: 1,2,3 atau 3,5,6" value={{$material->roles}}>
                            <label for="roles" style="font-weight: 400!important; font-size: 12px!important;">Daftar role : @foreach ($roles as $role)
                                {{$loop->iteration . ') ' . $role->name . ', '}}  
                            @endforeach . Pisahkan dengan koma, contoh : 1,2,3 atau 3,5,6.</label>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Judul</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="title" name="title" value="{{$material->title}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Kode</th>
                        <td class="col-8">
                            <input type="text" class="form-control" id="code" name="code" value="{{$material->code}}">
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Deskripsi</th>
                        <td class="col-8">
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Deskripsi">{{$material->description}}</textarea>
                        </td>
                    </tr>
                    <tr class="row">
                        <th class="col-4">Tipe Pembelajaran</th>
                        <td class="col-8">
                            <select class="custom-select" name="type" id="type">
                                <option value="teks" @if ($material->type == 'teks') selected @endif>Teks</option>
                                <option value="video" @if ($material->type == 'video') selected @endif>Video</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3 m-0">
                <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
            </div>
        </form>
        <div class="col-md-6 d-flex align-items-center mt-4" id="daftar-soal">
            <h5>Daftar Materi Bab</h5>
        </div>
        @if($material->chapters->count() == 0)
        <div class="p-2">
            Tidak ada soal, klik tombol "tambah soal" untuk menambah soal.
        </div>
        @endif
        <ol id="chapter-list" type="1">
            @foreach ($material->chapters as $chapter)
            <li class="mb-4">
                <div id={{"judul_chapter_" . $chapter->id}} class="flex-column">
                    <span style="font-weight: 600">Judul : </span>
                    <span class="judul">{{$chapter->judul}}</span>
                </div>
                <div id={{"subjudul_chapter_" . $chapter->id}} class="flex-column">
                    <span style="font-weight: 600">Subjudul : </span>
                    <span class="subjudul">{{$chapter->subjudul}}</span>
                </div>
                <div id={{"file_chapter_" . $chapter->id}}>
                    <span style="font-weight: 600">File : </span>
                    @if($chapter->file != null)
                    <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                    <iframe
                        src={{asset("storage/materi/file/" . $chapter->file)}}
                        height="200px"
                        loading="lazy"
                        title="PDF-file"
                    ></iframe>
                    @else
                    Tidak ada file
                    @endif
                </div>
                <div id={{"video_chapter_" . $chapter->id}}>
                    <span style="font-weight: 600">Video : </span>
                    @if($chapter->link != null)
                    <a href={{$chapter->link}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                    <div class="video-container">
                        <iframe 
                            width="500px"
                            height="auto" 
                            src={{$chapter->link}}>
                        </iframe>
                    </div>
                    <style>
                        .video-container {
                        position: relative;
                        padding-bottom: calc(56.25% * 0.5); /* 16:9 */
                        width: 50%;
                        height: 0;
                        }
                        .video-container iframe {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        }
                    </style>
                    @else
                    Tidak ada link video
                    @endif
                </div>
                <form action={{route('admin.chapter.update', $chapter->id)}} method="post" style="display: inline-block; width: 100%;" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id={{"input_chapter_" . $chapter->id}} style="display:none">
                        <input type="hidden" name="chapter_id" value={{$chapter->id}}>
                        <input type="hidden" name="material_id" value={{$chapter->material_id}}>
                        <div>
                            <span style="font-weight: 600; display: block;">Judul : </span>    
                            <input type="text" name="judul" id="input_judul_{{$chapter->id}}" class="form-control" value="{{$chapter->judul}}" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Subjudul : </span>
                            <input type="text" name="subjudul" id="input_subjudul_{{$chapter->id}}" class="form-control" value="{{$chapter->subjudul}}" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">File : </span>
                            @if($chapter->file == null)
                            File materi kosong
                            @else
                            <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                            <iframe
                                src={{asset("storage/materi/file/" . $chapter->file)}}
                                height="200px"
                                loading="lazy"
                                title="PDF-file"
                            ></iframe>
                            @endif
                            <input type="file" name="file" id="input_file_{{$chapter->id}}" class="form-control" value="{{$chapter->file}}" style="display: block" onchange="changePDF({{$chapter->id}})">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Video : </span>
                            @if($chapter->link != null)
                            <a href={{$chapter->link}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                            <div class="video-container">
                                <iframe 
                                    width="500px"
                                    height="auto" 
                                    src={{$chapter->link}}>
                                </iframe>
                            </div>
                            @endif
                            <input type="text" name="link" id="input_video_{{$chapter->id}}" class="form-control" value="{{$chapter->link}}" style="display: block" placeholder="Masukkan link video">
                        </div>
                    </div>
                    <button type="button" class="badge bg-warning border-0" onclick="startEditChapter({{$chapter->id}})" id={{"editBtn_" . $chapter->id}}>edit</button>
                    <button type="button" class="badge bg-secondary border-0" onclick="cancelEditChapter({{$chapter->id}})" id={{"cancelBtn_" . $chapter->id}} style="display:none">batal</button>
                    <button type="submit" class="badge bg-primary border-0" onclick="cancelEditChapter({{$chapter->id}}, {{$chapter->material_id}})" id={{"simpanBtn_" . $chapter->id}} style="display:none">simpan</button>
                </form>
                <form action={{route('admin.chapter.delete', $chapter->id)}} method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger border-0" id={{"hapusBtn_" . $chapter->id}}>hapus</button>
                </form>
            </li>
            @endforeach
        </ol>
        <input type="hidden" name="data" value="" id="data">
        <div class="d-flex mt-3 m-0 justify-content-end">
            <button id="add-chapter" type="button" class="btn btn-warning" onclick="addNewChapter()">Tambah Soal</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#title').on('keyup', function() {
            var title = $('#title').val();
            var code = title.replace(/\s+/g, '_').toLowerCase();
            $('#code').val(code);
        })
        // $('#add-chapter').on('click', () => {
        //     const questionUID = `new_${Date.now()}`
        //     const answerUID = [];
        //     for (let i = 1; i <= 5; i++) {
        //         answerUID.push(`new_${Date.now()}`)
        //     }
        //     const questionsList_Ol = document.querySelector('#question-list');
            
        //     const question_Li = document.createElement("li");
        //     question_Li.classList.add("mb-4");

        //     const question_Div = document.createElement("div");
        //     question_Div.setAttribute("id", `div_question_${questionUID}`);

        //     const question_Span = document.createElement("span");
        //     question_Span.classList.add("question");
        //     question_Span.innerText = `Pertanyaan`;
            
        //     question_Div.append(question_Span);

        //     const answersChoice_P = document.createElement("p");
        //     answersChoice_P.setAttribute("id", `p_divider_${questionUID}`);
        //     answersChoice_P.innerText = "Pilihan jawaban: ";
        //     answersChoice_P.classList.add("m-0")

        //     const answers_Ol = document.createElement("ol");
        //     for (let i = 1; i <= 5; i++) {
        //         const answer_Li = document.createElement("li");

        //         const answer_Span = document.createElement("span");
        //         answer_Span.innerText = `Jawaban ${i}`;
        //         answer_Span.classList.add("answer");

        //         answer_Li.setAttribute("id", `div_answer_${answerUID[i]}`);
        //         answer_Li.classList.add("pr-4");
        //         answer_Li.appendChild(answer_Span);
                
        //         answers_Ol.append(answer_Li);
        //     }
        //     answers_Ol.setAttribute("type", "A");
        //     answers_Ol.classList.add("row", "row-cols-3");
        //     answers_Ol.setAttribute("id", `div_answers_${questionUID}`);
        //     question_Li.append(question_Div, answersChoice_P, answers_Ol);

        //     const pembahasan_Div = document.createElement("div");
        //     pembahasan_Div.setAttribute("id", `div_pembahasan_${questionUID}`);
        //     const pembahasan_Span = document.createElement("span");
        //     pembahasan_Span.classList.add("pembahasan");
        //     pembahasan_Span.innerText = `Pembahasan`;
        //     pembahasan_Div.append(pembahasan_Span);
        //     question_Li.append(pembahasan_Div)
            
        //     const questionAnswerEdit_Form = document.createElement("form");
        //     questionAnswerEdit_Form.innerHTML = `@csrf`;
        //     questionAnswerEdit_Form.setAttribute("method", "POST");
        //     questionAnswerEdit_Form.setAttribute("action", baseEditURL);
        //     questionAnswerEdit_Form.style.display = "inline-block";
        //     const questionEdit_Div = document.createElement("div");
        //     const questionEditId_Input = document.createElement("input");
        //     questionEditId_Input.setAttribute("type", "hidden");
        //     questionEditId_Input.setAttribute("name", "question_id");
        //     questionEditId_Input.setAttribute("value", questionUID);

        //     const questionTryoutId_Input = document.createElement("input");
        //     questionTryoutId_Input.setAttribute("type", "hidden");
        //     questionTryoutId_Input.setAttribute("name", "tryout_id");
        //     questionTryoutId_Input.setAttribute("value", tryout_id);

        //     const questionEdit_Input = document.createElement("input");
        //     questionEdit_Input.setAttribute("type", "text");
        //     questionEdit_Input.setAttribute("name", "question");
        //     questionEdit_Input.setAttribute("id", `question_${questionUID}`);
        //     questionEdit_Input.setAttribute("value", "");
        //     questionEdit_Input.setAttribute("placeholder", "Pertanyaan");
        //     questionEdit_Input.classList.add("question", "form-control");

        //     const groupTypeEdit_Div = document.createElement("div");
        //     const groupTypeEdit_Label = document.createElement("label");
        //     const groupTypeEdit_Select = document.createElement("select");
        //     groupTypeEdit_Div.classList.add("row");
        //     groupTypeEdit_Label.setAttribute("for", `group_type_${questionUID}`);
        //     groupTypeEdit_Label.classList.add("col-2", "m-0");
        //     groupTypeEdit_Label.innerText = "Tipe soal : ";
        //     groupTypeEdit_Select.setAttribute("name", "group_type");
        //     groupTypeEdit_Select.setAttribute("id", `group_type_${questionUID}`);
        //     groupTypeEdit_Select.classList.add("form-select", "form-control", "form-control-sm", "col-2");
        //     groupTypes.forEach(groupType => {
        //         const groupTypeEdit_Option = document.createElement("option");
        //         groupTypeEdit_Option.setAttribute("value", groupType.id);
        //         groupTypeEdit_Option.innerText = groupType.code;
        //         groupTypeEdit_Select.append(groupTypeEdit_Option);
        //     });
        //     groupTypeEdit_Div.append(groupTypeEdit_Label, groupTypeEdit_Select);

        //     questionEdit_Div.append(questionEditId_Input, questionTryoutId_Input, questionEdit_Input, groupTypeEdit_Div);
        //     questionEdit_Div.setAttribute("id", `input_question_${questionUID}`);
        //     questionEdit_Div.style.display = "none";
        //     questionAnswerEdit_Form.append(questionEdit_Div);

        //     const answersEdit_Ol = document.createElement("ol");
        //     answersEdit_Ol.setAttribute("type", "A");
        //     answersEdit_Ol.setAttribute("id", `edit_answers_${questionUID}`);
        //     answersEdit_Ol.classList.add("row", "row-cols-3");
        //     answersEdit_Ol.style.display = "none";
        //     for (let i = 1; i <= 5; i++) {
        //         const answer_Li = document.createElement("li");

        //         const answer_Input = document.createElement("input");
        //         answer_Input.setAttribute("type", "text");
        //         answer_Input.setAttribute("name", "answers[]");
        //         answer_Input.setAttribute("id", `question_${questionUID}_answer_${i}`);
        //         answer_Input.setAttribute("value", `Jawaban ${i}`);
        //         answer_Input.classList.add("answer", "form-control");

        //         answer_Li.setAttribute("id", `input_answer_${answerUID[i]}`);
        //         answer_Li.classList.add("pr-4");
        //         answer_Li.appendChild(answer_Input);

        //         const answerBobot_Label = document.createElement("label");
        //         answerBobot_Label.setAttribute("for",  `answer_${answerUID[i]}_bobot`);
        //         answerBobot_Label.classList.add("row");
        //         const answerBobot_P = document.createElement("p");
        //         answerBobot_P.classList.add("col-4");
        //         answerBobot_P.innerText = "bobot : ";
        //         const answerBobot_Input = document.createElement("input");
        //         answerBobot_Input.setAttribute("type", "number");
        //         answerBobot_Input.setAttribute("name", "bobot[]");
        //         answerBobot_Input.setAttribute("id", `answer_${answerUID[i]}_bobot`);
        //         answerBobot_Input.setAttribute("value", 0);
        //         answerBobot_Input.setAttribute("min", 0);
        //         answerBobot_Input.setAttribute("max", 5);
        //         answerBobot_Input.classList.add("form-control", "form-control-sm", "col-4");

        //         answerBobot_Label.append(answerBobot_P, answerBobot_Input);
        //         answer_Li.appendChild(answerBobot_Label);
                
        //         answersEdit_Ol.append(answer_Li);
        //     }
        //     questionAnswerEdit_Form.append(answersEdit_Ol);

        //     const pembahasanEdit_Div = document.createElement("div");
        //     pembahasanEdit_Div.setAttribute("id", `input_pembahasan_${questionUID}`);
        //     pembahasanEdit_Div.style.display = "none";
        //     pembahasanEdit_Div.style.marginTop = "1rem";
        //     const pembahasanExplainer_Div = document.createElement("div");
        //     pembahasanExplainer_Div.style.fontWeight = "600";
        //     pembahasanExplainer_Div.innerText = "Pembahasan";

        //     const pembahasanEdit_Input_Div = document.createElement("div");
        //     const pembahasanEdit_Input = document.createElement("textarea");
        //     pembahasanEdit_Input.setAttribute("type", "text");
        //     pembahasanEdit_Input.setAttribute("name", "pembahasan");
        //     pembahasanEdit_Input.setAttribute("id", `pembahasan_${questionUID}`);
        //     pembahasanEdit_Input.setAttribute("rows", "4");
        //     pembahasanEdit_Input.classList.add("pembahasan", "form-control");
        //     pembahasanEdit_Input_Div.append(pembahasanEdit_Input);
            
        //     pembahasanEdit_Div.append(pembahasanExplainer_Div, pembahasanEdit_Input_Div);

        //     questionAnswerEdit_Form.append(pembahasanEdit_Div);
            
        //     const questionAnswerEdit_Button = document.createElement("button");
        //     questionAnswerEdit_Button.innerText = "edit";
        //     questionAnswerEdit_Button.setAttribute("type", "button");
        //     questionAnswerEdit_Button.setAttribute("onclick", `startEditQuestion("${questionUID}")`);
        //     questionAnswerEdit_Button.setAttribute("id", `editBtn_${questionUID}`);
        //     questionAnswerEdit_Button.classList.add("badge", "bg-warning", "border-0", "mr-1");
        //     questionAnswerEdit_Form.append(questionAnswerEdit_Button);
            
        //     const questionAnswerCancelEdit_Button = document.createElement("button");
        //     questionAnswerCancelEdit_Button.innerText = "batal";
        //     questionAnswerCancelEdit_Button.setAttribute("type", "button");
        //     questionAnswerCancelEdit_Button.setAttribute("onclick", `cancelEditQuestion("${questionUID}")`);
        //     questionAnswerCancelEdit_Button.setAttribute("id", `cancelBtn_${questionUID}`);
        //     questionAnswerCancelEdit_Button.classList.add("badge", "bg-secondary", "border-0", "mr-1");
        //     questionAnswerCancelEdit_Button.style.display = "none";
        //     questionAnswerEdit_Form.append(questionAnswerCancelEdit_Button);

        //     const questionAnswerSaveEdit_Button = document.createElement("button");
        //     questionAnswerSaveEdit_Button.innerText = "simpan";
        //     questionAnswerSaveEdit_Button.setAttribute("type", "submit");
        //     questionAnswerSaveEdit_Button.setAttribute("onclick", `cancelEditQuestion("${questionUID}")`);
        //     questionAnswerSaveEdit_Button.setAttribute("id", `simpanBtn_${questionUID}`);
        //     questionAnswerSaveEdit_Button.classList.add("badge", "bg-primary", "border-0");
        //     questionAnswerSaveEdit_Button.style.display = "none";
        //     questionAnswerEdit_Form.append(questionAnswerSaveEdit_Button);

        //     question_Li.append(questionAnswerEdit_Form);
            
        //     const questionAnswerDelete_Form = document.createElement("form");
        //     const deleteQuestionBtn_Button = document.createElement("button");
        //     deleteQuestionBtn_Button.innerText = "hapus";
        //     deleteQuestionBtn_Button.setAttribute("id", `hapusBtn_${questionUID}`);
        //     deleteQuestionBtn_Button.setAttribute("type", 'button');
        //     deleteQuestionBtn_Button.setAttribute("onclick", `deleteNewQuestion("${questionUID}")`);
        //     deleteQuestionBtn_Button.classList.add("badge", "bg-danger", "border-0");
        //     questionAnswerDelete_Form.innerHTML = `@csrf` + `@method('DELETE')`;
        //     questionAnswerDelete_Form.append(deleteQuestionBtn_Button);
        //     questionAnswerDelete_Form.setAttribute("method", "POST");
        //     questionAnswerDelete_Form.setAttribute("action", baseDeleteURL.replace("question_ID", questionUID));
        //     questionAnswerDelete_Form.style.display = "inline-block";
        //     question_Li.append(questionAnswerDelete_Form);

        //     questionsList_Ol.append(question_Li);
        // })
        
    });

    function addNewChapter(){
        const newChapterUID = 'new_chapter_' + Date.now();
        const chapter_list_OL = document.querySelector('#chapter-list');
        const chapter_LI = document.createElement('li');
        chapter_LI.classList.add('mb-4');
        chapter_LI.setAttribute('id', `chapter_${newChapterUID}_LI`);
        chapter_LI.innerHTML = `<div id="judul_chapter_${newChapterUID}" class="flex-column">
                    <span style="font-weight: 600">Judul : </span>
                    <span class="judul">Judul Bab Baru</span>
                </div>
                <div id="subjudul_chapter_${newChapterUID}" class="flex-column">
                    <span style="font-weight: 600">Subjudul : </span>
                    <span class="subjudul">Subjudul Bab Baru</span>
                </div>
                <div id="file_chapter_${newChapterUID}">
                    <span style="font-weight: 600">File : </span>
                    @if($chapter->file != null)
                    <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                    <iframe
                        src={{asset("storage/materi/file/" . $chapter->file)}}
                        height="200px"
                        loading="lazy"
                        title="PDF-file"
                    ></iframe>
                    @else
                    Tidak ada file
                    @endif
                </div>
                <div id="video_chapter_${newChapterUID}" >
                    <span style="font-weight: 600">Video : </span>
                    Tidak ada link video
                </div>
                <form action="{{route('admin.chapter.create')}}" method="POST" style="display: inline-block; width: 100%;" enctype="multipart/form-data">
                    @csrf
                    <div id="input_chapter_${newChapterUID}" style="display:none">
                        <input type="hidden" name="chapter_id" value="${newChapterUID}"">
                        <input type="hidden" name="material_id" value={{$chapter->material_id}}>
                        <div>
                            <span style="font-weight: 600; display: block;">Judul : </span>    
                            <input type="text" name="judul" id="input_judul_${newChapterUID}" class="form-control" placeholder="Judul Bab Baru" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Subjudul : </span>
                            <input type="text" name="subjudul" id="input_subjudul_${newChapterUID}" class="form-control" placeholder="Subjudul Bab Baru" style="display: block">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">File : </span>
                            @if($chapter->file == null)
                            File materi kosong
                            @else
                            <a href={{env('APP_URL') . 'storage/materi/file/' . $chapter->file}} target="_blank" class="badge bg-primary">Open in new tab</a> <br>
                            <iframe
                                src={{asset("storage/materi/file/" . $chapter->file)}}
                                height="200px"
                                loading="lazy"
                                title="PDF-file"
                            ></iframe>
                            @endif
                            <input type="file" name="file" id="input_file_${newChapterUID}" class="form-control" value="{{$chapter->file}}" style="display: block" onchange="changePDF(${newChapterUID})">
                        </div>
                        <div>
                            <span style="font-weight: 600; display: block">Video : </span>
                            <input type="text" name="link" id="input_video_${newChapterUID}" class="form-control" style="display: block" placeholder="Masukkan link video">
                        </div>
                    </div>
                    <button type="button" class="badge bg-warning border-0" onclick="startEditChapter('${newChapterUID}')" id="editBtn_${newChapterUID}">edit</button>
                    <button type="button" class="badge bg-secondary border-0" onclick="cancelEditChapter('${newChapterUID}')" id="cancelBtn_${newChapterUID}" style="display:none">batal</button>
                    <button type="submit" class="badge bg-primary border-0" onclick="cancelEditChapter('${newChapterUID}', {{$chapter->material_id}})" id="simpanBtn_${newChapterUID}" style="display:none">simpan</button>
                </form>
                <button type="submit" class="badge bg-danger border-0" id="hapusBtn_${newChapterUID}" onclick="deleteNewChapter('${newChapterUID}')" >hapus</button>
        `;
        chapter_list_OL.append(chapter_LI);
    }

    function startEditChapter(idQuestion) {
        let inputChapter = document.querySelector(`#input_chapter_${idQuestion}`)
        let divJudul = document.querySelector(`#judul_chapter_${idQuestion}`)
        let divSubjudul = document.querySelector(`#subjudul_chapter_${idQuestion}`)
        let divFile = document.querySelector(`#file_chapter_${idQuestion}`)
        let divVideo = document.querySelector(`#video_chapter_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        inputChapter.style.display = "block"
        divJudul.style.display = "none"
        divSubjudul.style.display = "none"
        divFile.style.display = "none"
        divVideo.style.display = "none"
        cancelBtn.style.display = "inline-block"
        simpanBtn.style.display = "inline-block"
        editBtn.style.display = "none"
    }

    function cancelEditChapter(idQuestion) {
        let inputChapter = document.querySelector(`#input_chapter_${idQuestion}`)
        let divJudul = document.querySelector(`#judul_chapter_${idQuestion}`)
        let divSubjudul = document.querySelector(`#subjudul_chapter_${idQuestion}`)
        let divFile = document.querySelector(`#file_chapter_${idQuestion}`)
        let divVideo = document.querySelector(`#video_chapter_${idQuestion}`)
        let cancelBtn = document.querySelector(`#cancelBtn_${idQuestion}`)
        let simpanBtn = document.querySelector(`#simpanBtn_${idQuestion}`)
        let editBtn = document.querySelector(`#editBtn_${idQuestion}`)
        inputChapter.style.display = "none"
        divJudul.style.display = "block"
        divSubjudul.style.display = "block"
        divFile.style.display = "block"
        divVideo.style.display = "block"
        cancelBtn.style.display = "none"
        simpanBtn.style.display = "none"
        editBtn.style.display = "inline-block"
    }

    function deleteNewChapter(idChapter){
        const newQuestion_Li = document.querySelector(`#chapter_${idChapter}_LI`);
        newQuestion_Li.remove();
    }
</script>
@endsection