@extends('layouts.admin-layot')
@section('title', 'Добавление данных')
@section('content')
    <div class="row">
        <h6 class="mb-0 text-uppercase"></h6>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">{{ __('Добавление данных') }}</h5>
                    </div>
                    <hr>
                    <form action="{{ route('add-question') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Вопрос') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="question_name" id="question_name" rows="3" placeholder="{{ __('Вопрос') }}" value="{{old('question_name')}}"></textarea>
                                <span style="color: red;">@error('question_name'){{$message}} @enderror</span>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Ответ') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Ответ') }}" value="{{old('description')}}"></textarea>
                                <span style="color: red;">@error('description'){{$message}} @enderror</span>
                            </div>
                        </div>


                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Раздел') }}</label>
                                <div class="col-sm-9">
                            <select class="form-select mb-3" aria-label="Default select example" name="id_chapter" id="id_chapter">
                                @foreach($Info as $productitem)
                                    <option value="{{$productitem->id}}">{{$productitem->chapter_name}}</option>
                                @endforeach
                            </select>
                                <span style="color: red;">@error('chapter_name'){{$message}} @enderror</span>
                                </div>
                            </div>


                        <div class="mb-3">
                            <input type="hidden" name="user_id" class="form-control" id="user_id"
                                   value="{{ Auth::user()->id }}">
                            <span style="color: red;">@error('user_id'){{$message}} @enderror</span>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary px-5">{{ __('Добавить') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>Раздел</th>
                    <th>Вопрос</th>
                    <th>Ответ</th>
                    <th>Действия</th>
                    </thead>
                    <tbody>
                    @foreach($showq as $productitem)
                        <tr>
                            <td>{{$productitem->id}}</td>
                            <td>{{$productitem->chapter_name}}</td>
                            <td>{{$productitem->question_name}}</td>
                            <td>{{$productitem->description}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">

                                    <a href="/editquestion/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="/deletequestion/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <nav aria-label="Page navigation example">
                    {{$showq->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
                </nav>
            </div>
        </div>
    </div>

@endsection





{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Добавление Вопроса FAQ')--}}
{{--@section('content')--}}

{{--    <div class="container_logo">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <form action="/addquestion" method="post" enctype="multipart/form-data">--}}
{{--                        <center>{{ __('Добавление Вопроса FAQ') }}</center>--}}
{{--                        @if(Session::get('success'))--}}
{{--                            <div class="alert alert-success">{{Session::get('success')}}</div>--}}
{{--                        @endif--}}
{{--                        @if(Session::get('fail'))--}}
{{--                            <div class="alert alert-danger">{{Session::get('fail')}}</div>--}}
{{--                        @endif--}}
{{--                        @csrf--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="question_name" class="form-label">Вопрос</label>--}}
{{--                            <textarea name="question_name" id="question_name" cols="45" rows="1" value="{{old('question_name')}}"></textarea>--}}
{{--                            <span style="color: red;">@error('question_name'){{$message}} @enderror</span>--}}

{{--                        </div>--}}


{{--                        <div class="mb-3">--}}
{{--                            <label for="description" class="form-label">Ответ</label>--}}
{{--                            <textarea name="description" id="description" cols="45" rows="1" value="{{old('description')}}"></textarea>--}}
{{--                            <span style="color: red;">@error('description'){{$message}} @enderror</span>--}}

{{--                        </div>--}}


{{--                        <div class="mb-3">--}}
{{--                            <label for="id_chapter" class="form-label">Раздел</label>--}}
{{--                            <select name="id_chapter" id="id_chapter">--}}
{{--                                @foreach($Info as $productitem)--}}
{{--                                    <option value="{{$productitem->id}}">{{$productitem->chapter_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <span style="color: red;">@error('chapter_name'){{$message}} @enderror</span>--}}
{{--                        </div>--}}

{{--                        <!--<div class="mb-3">--}}
{{--                            <label for="exampleInputPassword1" class="form-label">Картинка</label>--}}
{{--                            <input type="file" class="form-control" name="images">--}}
{{--                            <span style="color: red;">error('images'){$message}} enderror</span>--}}
{{--                        </div>-->--}}
{{--                        <button type="submit" class="button_add_tiding">Добавить</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <table class="table table-hover" style="margin-top: 30px;">--}}
{{--        <thead>--}}
{{--        <th class="image_table">ID</th>--}}
{{--        <th>Вопрос</th>--}}
{{--        <th>Ответ</th>--}}

{{--        <th>Действия</th>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($showq as $productitem)--}}
{{--            <tr>--}}
{{--                <td class="image_table">{{$productitem->id}}</td>--}}
{{--                <td>{{$productitem->question_name}}</td>--}}
{{--                <td>{{$productitem->description}}</td>--}}

{{--                <td>--}}
{{--                    <div class="btn-group">--}}
{{--                        <a href="/deletequestion/{{$productitem->id}}" class="btn-delete">Удалить</a>--}}
{{--                        <a href="/editquestion/{{$productitem->id}}" class="btn-edit">Редактировать</a>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <div>--}}
{{--        <nav aria-label="Page navigation example">--}}
{{--            {{$showq->links("pagination::bootstrap-4")}}--}}
{{--        </nav>--}}
{{--    </div>--}}


{{--@endsection--}}
