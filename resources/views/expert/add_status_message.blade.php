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
                        <h5 class="mb-0">{{ __('Добавление данных') }}</h5>
                    </div>
                    <hr>
                    <form action="{{ route('add-status') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Статус') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="status" id="status" rows="3" placeholder="{{ __('Статус') }}" value="{{old('status')}}"></textarea>
                                <span style="color: red;">@error('status'){{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" class="form-control" id="user_id"
                                   value="{{ Auth::user()->id }}">
                            <span style="color: red;">@error('user_id'){{$message}} @enderror</span>
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

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="ms-auto position-relative" method="get" action="{{route('search_status')}}" >
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text"  id="s" name="s" placeholder="search">
                </form>
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>Статус</th>
                    <th>Пользователь добавивший запись</th>
                    <th>Почта пользователя</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                    <th>Действия</th>
                    </thead>
                    <tbody>
                    @foreach($showv as $productitem)
                        <tr>
                            <td>{{$productitem->id}}</td>
                            <td>{{$productitem->status}}</td>
                            <td>{{$productitem->name}}</td>
                            <td>{{$productitem->email}}</td>
                            <td>{{$productitem->created_at}}</td>
                            <td>{{$productitem->updated_at}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/editstatus/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="/deletestatus/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <nav aria-label="Page navigation example">
            {{$showv->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>
    </div>
@endsection


{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Добавление данных')--}}
{{--@section('content')--}}

{{--    <div class="container_logo">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <form class="add_form" action="/addstatus" method="post" enctype="multipart/form-data">--}}
{{--                        <center>{{ __('Добавление статуса') }}</center>--}}
{{--                        @if(Session::get('success'))--}}
{{--                            <div class="alert alert-success">{{Session::get('success')}}</div>--}}
{{--                        @endif--}}
{{--                        @if(Session::get('fail'))--}}
{{--                            <div class="alert alert-danger">{{Session::get('fail')}}</div>--}}
{{--                        @endif--}}
{{--                        @csrf--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="status" class="form-label">Статус</label>--}}
{{--                            <textarea name="status" id="status" cols="45" rows="1" value="{{old('status')}}"></textarea>--}}
{{--                            <span style="color: red;">@error('status'){{$message}} @enderror</span>--}}

{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <input type="hidden" name="user_id" class="form-control" id="user_id"--}}
{{--                                   value="{{ Auth::user()->id }}">--}}
{{--                            <span style="color: red;">@error('user_id'){{$message}} @enderror</span>--}}
{{--                        </div>--}}
{{--                        <!--<div class="mb-3">--}}
{{--                            <label for="exampleInputPassword1" class="form-label">Картинка</label>--}}
{{--                            <input type="file" class="form-control" name="images">--}}
{{--                            <span style="color: red;">error('images'){$message}} enderror</span>--}}
{{--                        </div>-->--}}
{{--                        <button type="submit" class="button_add_tiding">Добавить</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <section>--}}
{{--        <form class="search" method="get" action="{{route('search_status')}}">--}}
{{--            <input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">--}}
{{--        </form>--}}
{{--    </section>--}}
{{--    <table class="table table-hover" style="margin-top: 30px;">--}}
{{--        <thead>--}}
{{--        <th>ID</th>--}}
{{--        <th>Статус</th>--}}
{{--        <th>Пользователь добавивший запись</th>--}}
{{--        <th>Почта пользователя</th>--}}
{{--        <th>Дата создания записи</th>--}}
{{--        <th>Дата обнавления записи</th>--}}

{{--        <th>Действия</th>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($showv as $productitem)--}}
{{--            <tr>--}}
{{--                <td>{{$productitem->id}}</td>--}}
{{--                <td>{{$productitem->status}}</td>--}}
{{--                <td>{{$productitem->name}}</td>--}}
{{--                <td>{{$productitem->email}}</td>--}}
{{--                <td>{{$productitem->created_at}}</td>--}}
{{--                <td>{{$productitem->updated_at}}</td>--}}

{{--                <td>--}}
{{--                    <div class="btn-group">--}}
{{--                        <a href="/deletestatus/{{$productitem->id}}" class="btn-delete">Удалить</a>--}}
{{--                        <a href="/editstatus/{{$productitem->id}}" class="btn-edit">Редактировать</a>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <div>--}}
{{--        <nav aria-label="Page navigation example">--}}
{{--            {{$showv->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}--}}
{{--        </nav>--}}
{{--    </div>--}}


{{--@endsection--}}
