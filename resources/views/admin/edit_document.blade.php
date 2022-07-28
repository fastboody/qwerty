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
                    <form action="{{ route('updatedocument') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_document" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoD->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Оглавление') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="title" id="title" rows="3" placeholder="{{ __('Оглавление') }}">{{ $InfoD->title }}</textarea>
                                <span style="color: red;">@error('title'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Документ') }}</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="document">
                                <span style="color: red;">@error('document'){{$message}} @enderror</span>
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
{{--@section('title', 'Добавление данных')--}}
{{--@section('content')--}}
{{--    <div class="row">--}}
{{--    <div class="col-md-8 offset-md-2">--}}
{{--        <h1>{{ $TitleD }}</h1>--}}
{{--        @if(Session::get('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                {{ Session::get('success') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if(Session::get('fail'))--}}
{{--            <div class="alert alert-danger">--}}
{{--                {{ Session::get('fail') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <form class="add_form" action="/updatedocument" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input type="text" name="id_document" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoD->id }}">--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Оглавление</label>--}}
{{--                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoD->title }}">--}}
{{--                <span style="color: red;">@error('title'){{$message}} @enderror</span>--}}
{{--            </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="exampleInputPassword1" class="form-label">Картинка</label>--}}
{{--                    <input type="file" class="form-control" name="document">--}}
{{--                    <span style="color: red;">@error('document'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    </div>--}}
{{--@endsection--}}

