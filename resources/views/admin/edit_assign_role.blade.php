@extends('layouts.admin-layot')
@section('title', 'Добавление данных')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">{{ __('Редактирование данных') }}</h5>
                    </div>
                    <hr>
                    <form action="{{ route('updateassignrole') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Роль') }}</label>
                            <div class="col-sm-9">
                                <input type="text" name="model_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Infos->model_id }}"><br>
                            </div>
                        </div>
                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Статус') }}</label>
                                <div class="col-sm-9">
                            <select class="form-select mb-3" name="role_id" id="role_id" aria-label="Default select example">
                                <option selected="" value="{{ $Infos->role_id }}">{{ $Infos->role_id }}</option>
                                <option value="1">Пользователь</option>
                                <option value="2">Админ</option>
                                <option value="3">Эксперт</option>
                                <option value="4">Заблокировать пользователя</option>
                            </select>
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
{{--        <form class="add_form" action="/updateassignrole" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input type="text" name="model_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Infos->model_id }}"><br>--}}
{{--          	<label for="role_id" class="form-label">Роль</label>--}}
{{--            <select name="role_id" id="role_id">--}}
{{--                <option selected value="{{ $Infos->role_id }}">{{ $Infos->role_id }}</option>--}}
{{--                <option value="1">Пользователь</option>--}}
{{--                <option value="2">Админ</option>--}}
{{--                <option value="3">Эксперт</option>--}}
{{--                <option value="4">Заблокировать пользователя</option>--}}
{{--            </select>--}}
{{--            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--        </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

