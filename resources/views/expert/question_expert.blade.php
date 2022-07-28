@extends('layouts.admin-layot')
@section('title', 'Сообщения')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="ms-auto position-relative" method="get" action="{{route('search_question_expert')}}" >
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text"  id="s" name="s" placeholder="search">
                </form>
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Вопрос</th>
                    <th>Дата создания</th>
                    <th>Действия</th>

                    </thead>
                    <tbody>
                    @foreach($showq as $productitem)
                        <tr>
                            <td>{{$productitem->id}}</td>
                            <td>{{$productitem->username}}</td>
                            <td>{{$productitem->usermail}}</td>
                            <td>{{$productitem->usernumber}}</td>
                            <td>{{$productitem->question}}</td>
                            <td>{{$productitem->created_at}}</td>

                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/edituserquestion/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-telephone-fill"></i></a>
                                    <a href="/feedback/{{$productitem->id}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-envelope-fill"></i></a>
                                    <a href="/deletemessagequestion/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <nav aria-label="Page navigation example">
                    {{$showq->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
                </nav>
            </div>
        </div>
    </div>

@endsection



{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Сообщения')--}}
{{--@section('content')--}}
{{--    <form method="get" action="{{route('search_replymessage')}}">--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-10">--}}
{{--                <label for="exampleInputPassword1" class="form-label">Поиск по всем значениям</label>--}}
{{--                <input type="text" class="form-control" id="s" name="s" placeholder="Поиск...">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-2">--}}
{{--                <button type="submit" class="btn btn-primary">Поиск</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--        <table class="table table-hover" style="margin-top: 30px;"><thead>--}}
{{--            <th>ID</th>--}}
{{--            <th>ФИО</th>--}}
{{--            <th>E-Mail</th>--}}
{{--            <th>Телефон</th>--}}
{{--            <th>Вопрос</th>--}}
{{--            <th>Дата создания</th>--}}

{{--            <th>Ответить по e-mail</th>--}}
{{--            <th>Ответить по тел.</th>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($showq as $productitem)--}}
{{--                <tr>--}}
{{--                    <th class="image_table">{{$productitem->id}}</th>--}}
{{--                    <th class="image_table">{{$productitem->username}}</th>--}}
{{--                    <td>{{$productitem->usermail}}</td>--}}
{{--                    <td>{{$productitem->usernumber}}</td>--}}
{{--                    <td class="message_table">{{$productitem->question}}</td>--}}
{{--                    <td>{{$productitem->created_at}}</td>--}}
{{--                    <td class="action">--}}
{{--                        <div class="btn-group">--}}
{{--                            <a href="/feedback/{{$productitem->id}}" class="btn-edit">ОТВЕТИТЬ</a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td class="action">--}}
{{--                        <div class="btn-group">--}}
{{--                            <a href="/edituserquestion/{{$productitem->id}}" class="btn-edit">ОТВЕТИТЬ</a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    <div>--}}
{{--        <nav aria-label="Page navigation example">--}}
{{--            {{$showq->links("pagination::bootstrap-4")}}--}}
{{--        </nav>--}}
{{--    </div>--}}
