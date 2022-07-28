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
                        <h5 class="mb-0">{{ __('Редактирование данных') }}</h5>
                    </div>
                    <hr>
                    <form action="{{ route('updatequestion') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_question" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoQ->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Вопрос') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="question_name" id="question_name" rows="3" placeholder="{{ __('Вопрос') }}" value="{{old('question_name')}}">{{ $InfoQ->question_name }}</textarea>
                                <span style="color: red;">@error('question_name'){{$message}} @enderror</span>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Ответ') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Ответ') }}">{{ $InfoQ->description }}</textarea>
                                <span style="color: red;">@error('description'){{$message}} @enderror</span>
                            </div>
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
@endsection


{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Редактирование данных')--}}
{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-8 offset-md-2">--}}
{{--            <h1>{{ $TitleQ }}</h1>--}}
{{--            @if(Session::get('success'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    {{ Session::get('success') }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            @if(Session::get('fail'))--}}
{{--                <div class="alert alert-danger">--}}
{{--                    {{ Session::get('fail') }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <form action="/updatequestion" method="post">--}}
{{--                @csrf--}}
{{--                <input type="text" name="id_question" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoQ->id }}">--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="title" class="form-label">Статус</label>--}}
{{--                    <textarea name="sent_question" id="sent_question" cols="45" rows="5">{{old('sent_question')}}</textarea>--}}
{{--                    <span style="color: red;">@error('sent_question'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <div class="mb-3">--}}
{{--                    <input type="hidden" name="status" class="form-control" id="status"--}}
{{--                           value="отвечен">--}}
{{--                    <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

