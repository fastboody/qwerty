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
                    <form action="{{ route('add-teammate') }}" method="post" enctype="multipart/form-data">
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Оглавление') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="employee" id="employee" rows="3" placeholder="{{ __('Оглавление') }}" value="{{old('employee')}}"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Описание') }}"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Полное описание') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description_max" id="description_max" rows="3" placeholder="{{ __('Полное описание') }}"></textarea>
                            </div>
                        </div>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'description_max');
                        </script>

                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Фотография') }}</label>
                                <div class="col-sm-9">
                                    <input type="file" name="images[]" multiple class="form-control" id="inputGroupFile02">
                                    <span style="color: red;">@error('images'){{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">{{ __('Грамоты') }}</label>
                                <div class="col-sm-9">
                                    <input type="file" name="gram_images[]" multiple class="form-control" id="inputGroupFile02">
                                    <span style="color: red;">@error('gram_images'){{$message}} @enderror</span>
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
                <form class="ms-auto position-relative" method="get" action="{{route('search_teammate')}}" >
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text"  id="s" name="s" placeholder="search">
                </form>
                <div class="table-responsive mt-3">
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>Оглавление</th>
                    <th>Описание</th>
                    <th>Полное описание</th>
                    <th>Фото</th>
                    <th>Грамоты</th>
                    <th>Пользователь добавивший запись</th>
                    <th>Почта пользователя</th>
                    <th>Дата создания записи</th>
                    <th>Дата обновления записи</th>
                    <th>Действия</th>
                    </thead>
                    <tbody>
                    @foreach($showt as $productitem)
                        <tr>
                            <td>{{$productitem->id}}</td>
                            <td>{{$productitem->employee}}</td>
                            <td>{{$productitem->description}}</td>
                            <td>{{$productitem->description_max}}</td>
                            <td>{{$productitem->image }}</td>
                            <td>{{$productitem->gram_image}}</td>
                            <td>{{$productitem->name}}</td>
                            <td>{{$productitem->email}}</td>
                            <td>{{$productitem->created_at}}</td>
                            <td>{{$productitem->updated_at}}</td>

                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/editteammate/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="/deleteteammate/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <nav aria-label="Page navigation example">
                    {{$showt->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
                </nav>
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
{{--            <form class="add_form"action="/addteammatespoint" method="post" enctype="multipart/form-data">--}}
{{--                @if(Session::get('success'))--}}
{{--                    <div class="alert alert-success">{{Session::get('success')}}</div>--}}
{{--                @endif--}}
{{--                @if(Session::get('fail'))--}}
{{--                    <div class="alert alert-danger">{{Session::get('fail')}}</div>--}}
{{--                @endif--}}
{{--                @csrf--}}
{{--              <div class="mb-3">--}}
{{--                    <label for="employee" class="form-label">Оглавление</label>--}}
{{--                    <textarea name="employee" id="employee" cols="45" rows="5" value="{{old('employee')}}"></textarea>--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                     <label for="description" class="form-label">Описание</label>--}}
{{--                     <textarea name="description" id="description" cols="45" rows="5" value="{{old('description')}}"></textarea>--}}
{{--                </div>--}}

{{--             <div class="mb-3">--}}
{{--                            <label for="description_max" class="form-label">Полное описание</label>--}}
{{--                            <textarea name="description_max" id="description_max" cols="45" rows="5" value="{{old('description_max')}}"></textarea>--}}
{{--                            <script type="text/javascript">--}}
{{--                                CKEDITOR.replace( 'description_max');--}}
{{--                            </script>--}}
{{--                        </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="exampleInputPassword1" class="form-label">Картинка</label>--}}
{{--                    <input type="file" class="form-control" name="images[]" multiple>--}}
{{--                    <span style="color: red;">@error('images'){{$message}} @enderror</span>--}}
{{--                </div>--}}


{{--                    <div class="mb-3">--}}
{{--                        <label for="exampleInputPassword1" class="form-label">Загрузить грамоты</label>--}}
{{--                        <input type="file" class="form-control" name="gram_images[]" multiple>--}}
{{--                        <span style="color: red;">@error('gram_images'){{$message}} @enderror</span>--}}
{{--                    </div>--}}


{{--                <div class="mb-3">--}}
{{--                    <input type="hidden" name="user_id" class="form-control" id="user_id"--}}
{{--                               value="{{ Auth::user()->id }}">--}}
{{--                    <span style="color: red;">@error('user_id'){{$message}} @enderror</span>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-primary">Добавить</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--      </div>--}}
{{--</div>--}}
{{--    <section>--}}
{{--        <form class="search" method="get" action="{{route('search_teammate')}}">--}}
{{--            <input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">--}}
{{--        </form>--}}
{{--    </section>--}}
{{--    <table class="table table-hover" style="margin-top: 30px;">--}}
{{--        <thead>--}}
{{--        <th>ID.</th>--}}
{{--        <th>ФИО</th>--}}
{{--        <th>Описание</th>--}}
{{--        <th>Полное Описание</th>--}}
{{--        <th>Картинка</th>--}}
{{--        <th>Грамоты</th>--}}
{{--        <th>Пользователь добавивший запись</th>--}}
{{--        <th>Почта пользователя</th>--}}
{{--        <th>Дата создания записи</th>--}}
{{--        <th>Дата обнавления записи</th>--}}

{{--        <th>Действия</th>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($showt as $productitem)--}}
{{--            <tr>--}}
{{--              	<td class="image_table">{{$productitem->id}}</td>--}}
{{--                <td>{{$productitem->employee}}</td>--}}
{{--                <td>{{$productitem->description}}</td>--}}
{{--                <td>{{$productitem->description_max}}</td>--}}
{{--                <td>{{$productitem->image }}</td>--}}
{{--                <td>{{$productitem->gram_image }}</td>--}}
{{--                <td class="image_table">{{$productitem->name}}</td>--}}
{{--                <td>{{$productitem->email}}</td>--}}
{{--                <td>{{$productitem->created_at}}</td>--}}
{{--                <td>{{$productitem->updated_at}}</td>--}}

{{--                <td class="action">--}}
{{--                    <div class="btn-group">--}}
{{--                        <a href="/deleteteammate/{{$productitem->id}}" class="btn-delete">Удалить</a>--}}
{{--                        <a href="/editteammate/{{$productitem->id}}" class="btn-edit">Обновить</a>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <nav aria-label="Page navigation example">--}}
{{--        {{$showt->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}--}}
{{--    </nav>--}}

{{--@endsection--}}
