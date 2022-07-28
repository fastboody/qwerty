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
                    <form action="{{ route('updatetiding') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input hidden type="text" name="id_tiding" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Оглавление') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="title" id="title" rows="3" placeholder="{{ __('Оглавление') }}" >{{ $Info->title }}</textarea>
                                <span style="color: red;">@error('title'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Описание') }}">{{ $Info->description }}</textarea>
                                <span style="color: red;">@error('description'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Полное описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description_max" id="description_max" rows="3" placeholder="{{ __('Полное описание') }}">{{ $Info->description_max }}</textarea>
                                <span style="color: red;">@error('description_max'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'description_max');
                        </script>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Изображение') }}</label>
                            <div class="col-sm-9">
                                <input type="file" name="images[]" multiple class="form-control" id="inputGroupFile02">
                                <span style="color: red;">@error('image'){{$message}} @enderror</span>
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
{{--        <form class="add_form" action="/updatetiding" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input type="text" name="id_tiding" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">--}}
{{--          	<div class="mb-3">--}}
{{--                <label for="title" class="form-label">Оглавление</label>--}}
{{--                <textarea name="title" id="title" cols="45" rows="5">{{ $Info->title }}</textarea>--}}
{{--                <span style="color: red;">@error('title'){{$message}} @enderror</span>--}}
{{--                --}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="description" class="form-label">Описание</label>--}}
{{--                <textarea name="description" id="description" cols="45" rows="5">{{ $Info->description }}</textarea>--}}
{{--                <span style="color: red;">@error('description'){{$message}} @enderror</span>--}}
{{--                --}}
{{--            </div>--}}
{{--			<div class="mb-3">--}}
{{--                <label for="description_max" class="form-label">Полное описание</label>--}}
{{--                <textarea name="description_max" id="description_max" cols="45" rows="5">{{ $Info->description_max }}</textarea>--}}
{{--                <span style="color: red;">@error('description_max'){{$message}} @enderror</span>--}}
{{--                <script type="text/javascript">--}}
{{--                     	CKEDITOR.replace( 'description_max');--}}
{{--                </script>--}}
{{--              </div>--}}

{{--              <div class="mb-3">--}}
{{--                  <label for="exampleInputPassword1" class="form-label">Картинка</label>--}}
{{--                  <input type="file" class="form-control" name="images[]" multiple>--}}
{{--                  <span style="color: red;">@error('image'){{$message}} @enderror</span>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    </div>--}}
{{--@endsection--}}

