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
                    <form action="{{ route('updatesentquestion') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <input type="text" hidden name="id_sentquestion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">

                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Ответ') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="sent_question" id="sent_question" rows="3" placeholder="{{ __('Ответ') }}">{{ $Info->sent_question }}</textarea>
                                <span style="color: red;">@error('sent_question'){{$message}} @enderror</span>
                            </div>
                        </div>

                            <div>
                                <input type="hidden" name="status" class="form-control" id="status"
                                       value="отвечен">
                                <span style="color: red;">@error('status'){{$message}} @enderror</span>
                            </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary px-5">{{ __('Отправить') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Добавление данных')--}}
{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-8 offset-md-2">--}}
{{--            <h1>{{ $Title }}</h1>--}}
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
{{--            <form action="/updatesentquestion" method="post" enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                <input type="text" name="id_sentquestion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="sent_question" class="form-label">Ответ</label>--}}
{{--                    <textarea name="sent_question" id="sent_question" cols="45" rows="5">{{old('sent_question')}}</textarea>--}}
{{--                    <span style="color: red;">@error('sent_question'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <input type="hidden" name="status" class="form-control" id="status"--}}
{{--                           value="отвечен">--}}
{{--                    <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

