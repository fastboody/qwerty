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
                    <form action="{{ route('feedback.send') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <input type="text" hidden name="id_feeedback" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Infos->id }}">


                            <div class="form-group">
                                <input type="hidden" class="form-control" name="name" placeholder="Имя, фамилия"
                                       required maxlength="100" value="{{ Auth::user()->id }}">
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="email" placeholder="Адрес почты"
                                       required maxlength="100" value="{{$Infos->usermail}}">
                            </div>



                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Ответ') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="message" id="message" rows="3" placeholder="{{ __('Ответ') }}">{{ old('message') ?? '' }}</textarea>
                                <span style="color: red;">@error('message'){{$message}} @enderror</span>
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
{{--@section('title', 'Обратная связь')--}}
{{--@section('content')--}}

{{--<section id="one" class="wrapper style_title special">--}}
{{--    <form method="post" action="{{ route('feedback.send') }}">--}}
{{--        @csrf--}}
{{--        <input type="text" name="id_feeedback" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Infos->id }}">--}}


{{--        <div class="form-group">--}}
{{--            <input type="hidden" class="form-control" name="name" placeholder="Имя, фамилия"--}}
{{--                   required maxlength="100" value="{{ Auth::user()->id }}">--}}
{{--        </div>--}}




{{--        <div class="form-group">--}}
{{--            <input type="hidden" class="form-control" name="email" placeholder="Адрес почты"--}}
{{--                   required maxlength="100" value="{{$Infos->usermail}}">--}}
{{--        </div>--}}




{{--        <div class="form-group">--}}
{{--        <textarea class="form-control" name="message" placeholder="Ваше сообщение"--}}
{{--                  required maxlength="500" rows="3">{{ old('message') ?? '' }}</textarea>--}}
{{--        </div>--}}




{{--        <div>--}}
{{--            <input type="hidden" name="status" class="form-control" id="status"--}}
{{--                   value="отвечен">--}}
{{--            <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}
{{--        </div>--}}




{{--        <div class="form-group">--}}
{{--            <button type="submit" class="btn btn-primary">Отправить</button>--}}
{{--        </div>--}}

{{--    </form>--}}
{{--</section>--}}
