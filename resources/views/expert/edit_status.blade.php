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
                    <form action="{{ route('updatestatus') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoV->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Статус') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="status" id="status" rows="3" placeholder="{{ __('Статус') }}">{{ $InfoV->status }}</textarea>
                                <span style="color: red;">@error('status'){{$message}} @enderror</span>
                            </div>
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
{{--@section('title', 'Редактирование данных')--}}
{{--@section('content')--}}
{{--    <div class="container_logo">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--            <h1>{{ $TitleV }}</h1>--}}
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
{{--            <form class="add_form" action="/updatestatus" method="post">--}}
{{--                @csrf--}}
{{--                <input type="text" name="id_status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoV->id }}">--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="title" class="form-label">Статус</label>--}}
{{--                    <textarea name="status" id="status" cols="45" rows="5">{{ $InfoV->status }}</textarea>--}}
{{--                    <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--              </div>--}}
{{--          </div>--}}
{{--    </div>--}}
{{--@endsection--}}

