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
                    <form action="{{ route('updatemessage') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_message" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Ответ') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="title" id="title" rows="3" placeholder="{{ __('Ответ') }}">{{ $Info->title }}</textarea>
                                <span style="color: red;">@error('title'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Источник') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="link_source_spc" id="link_source_spc" rows="3" placeholder="{{ __('Источник') }}">{{ $Info->link_source_spc }}</textarea>
                                <span style="color: red;">@error('link_source_spc'){{$message}} @enderror</span>
                            </div>
                        </div>

                            <div class="mb-3">
                                <input type="hidden" name="spec_id" class="form-control" id="spec_id"
                                       value="{{ Auth::user()->id }}">
                                <span style="color: red;">@error('spec_id'){{$message}} @enderror</span>
                            </div>



                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Статус') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-select mb-3" aria-label="Default select example" name="status" id="status">
                                        <option selected value="{{ $Info->status }}">{{ $Info->status }}</option>
                                        @foreach($Infos as $productitem)
                                            <option value="{{$productitem->status}}">{{$productitem->status}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red;">@error('status'){{$message}} @enderror</span>
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
{{--    <div class="container_logo">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}

{{--        <h1>{{ $Title }}</h1>--}}
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
{{--        <form class="add_form" action="/updatemessage" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input type="text" name="id_message" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">--}}
{{--          	<div class="mb-3">--}}
{{--                <label for="title" class="form-label">Ответ</label>--}}
{{--                <textarea name="title" id="title" cols="45" rows="5">{{ $Info->title }}</textarea>--}}
{{--                <span style="color: red;">@error('title'){{$message}} @enderror</span>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="link_source_spc" class="form-label">Источник</label>--}}
{{--                <textarea name="link_source_spc" id="link_source_spc" cols="45" rows="5">{{ $Info->link_source_spc }}</textarea>--}}
{{--                <span style="color: red;">@error('link_source_spc'){{$message}} @enderror</span>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <input type="hidden" name="spec_id" class="form-control" id="spec_id"--}}
{{--                       value="{{ Auth::user()->id }}">--}}
{{--                <span style="color: red;">@error('spec_id'){{$message}} @enderror</span>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="status" class="form-label">Статус</label>--}}
{{--                <select name="status" id="status">--}}
{{--                    <option selected value="{{ $Info->status }}">{{ $Info->status }}</option>--}}
{{--                    @foreach($Infos as $productitem)--}}
{{--                        <option value="{{$productitem->status}}">{{$productitem->status}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--        </form>--}}
{{--              </div>--}}
{{--          </div>--}}
{{--    </div>--}}
{{--    </div>--}}
{{--@endsection--}}

