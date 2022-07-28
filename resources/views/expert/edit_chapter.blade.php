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
                    <form action="{{ route('updatechapter') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_chapter" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoC->id }}">
                            <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Название раздела') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="chapter_name" id="chapter_name" rows="3" placeholder="{{ __('Название раздела') }}">{{ $InfoC->chapter_name }}</textarea>
                                <span style="color: red;">@error('chapter_name'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Раздел') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="link" id="link" rows="3" placeholder="{{ __('Раздел') }}">{{ $InfoC->link }}</textarea>
                                <span style="color: red;">@error('link'){{$message}} @enderror</span>
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
{{--            <h1>{{ $TitleC }}</h1>--}}
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
{{--            <form action="/updatechapter" method="post">--}}
{{--                @csrf--}}
{{--                <input type="text" name="id_chapter" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoC->id }}">--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="title" class="form-label">Статус</label>--}}
{{--                    <textarea name="chapter_name" id="chapter_name" cols="45" rows="5">{{ $InfoC->chapter_name }}</textarea>--}}
{{--                    <span style="color: red;">@error('chapter_name'){{$message}} @enderror</span>--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="title" class="form-label">Статус</label>--}}
{{--                    <textarea name="link" id="link" cols="45" rows="5">{{ $InfoC->link }}</textarea>--}}
{{--                    <span style="color: red;">@error('link'){{$message}} @enderror</span>--}}
{{--                </div>--}}

{{--                <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

