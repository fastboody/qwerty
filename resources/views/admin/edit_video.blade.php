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
                    <form action="{{ route('updatevideo') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                            <input type="text" hidden name="id_video" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoV->id }}">
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Оглавление') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="title" id="title" rows="3" placeholder="{{ __('Оглавление') }}" >{{ $InfoV->title }}</textarea>
                                <span style="color: red;">@error('title'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Описание') }}">{{ $InfoV->description }}</textarea>
                                <span style="color: red;">@error('description'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Полное описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description_max" id="description_max" rows="3" placeholder="{{ __('Полное описание') }}">{{ $InfoV->description_max }}</textarea>
                                <span style="color: red;">@error('description_max'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'description_max');
                        </script>




                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">Ссылка на видео</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="video_link" id="video_link" rows="3" placeholder="Ссылка на видео" value="{{ $InfoV->video_link }}">{{ $InfoV->video_link }}</textarea>
                                <span style="color: red;">@error('video_link'){{$message}} @enderror</span>
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
{{--        <div class="col-md-8 offset-md-2">--}}
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
{{--            <form class="add_form" action="/updatevideo" method="post">--}}
{{--                @csrf--}}
{{--                <input type="text" name="id_video" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $InfoV->id }}">--}}
{{--                <div class="mb-3">--}}
{{--                <label for="title" class="form-label">Оглавление</label>--}}
{{--                <textarea name="title" id="title" cols="45" rows="5">{{ $InfoV->title }}</textarea>--}}
{{--                <span style="color: red;">@error('title'){{$message}} @enderror</span>--}}
{{--                --}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="description" class="form-label">Описание</label>--}}
{{--                <textarea name="description" id="description" cols="45" rows="5">{{ $InfoV->description }}</textarea>--}}
{{--                <span style="color: red;">@error('description'){{$message}} @enderror</span>--}}
{{--                --}}
{{--            </div>--}}
{{--			<div class="mb-3">--}}
{{--                <label for="description_max" class="form-label">Полное описание</label>--}}
{{--                <textarea name="description_max" id="description_max" cols="45" rows="5">{{ $InfoV->description_max }}</textarea>--}}
{{--                <span style="color: red;">@error('description_max'){{$message}} @enderror</span>--}}
{{--                --}}
{{--              </div>--}}

{{--                    <div class="mb-3">--}}
{{--                        <label for="exampleInputPassword1" class="form-label">Ссылка на видео</label>--}}
{{--                        <input type="text" name="video_link" class="form-control" id="exampleInputPassword1" placeholder="Ссылка на видео" value="{{ $InfoV->video_link }}">--}}
{{--                        <span style="color: red;">@error('video_link'){{$message}} @enderror</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary">Сохранить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
