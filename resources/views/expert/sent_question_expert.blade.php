@extends('layouts.admin-layot')
@section('title', 'Сообщения')
@section('content')


    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="ms-auto position-relative" method="get" action="{{route('search_sent_question_expert')}}" >
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
                    <th>Ответ</th>
                    <th>Дата создания</th>
                    <th>Дата ответа</th>
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
                            <td>{{$productitem->sent_question}}</td>
                            <td>{{$productitem->created_at}}</td>
                            <td>{{$productitem->updated_at}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/deletesentquestion/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
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
{{--    <section>--}}
{{--        <form class="search" method="get" action="{{route('search_question_expert')}}">--}}
{{--            <input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">--}}
{{--        </form>--}}
{{--    </section>--}}
{{--        <table class="table table-hover" style="margin-top: 30px;"><thead>--}}
{{--            <th>ID</th>--}}
{{--            <th>ФИО</th>--}}
{{--            <th>E-Mail</th>--}}
{{--            <th>Телефон</th>--}}
{{--            <th>Вопрос</th>--}}
{{--            <th>Ответ</th>--}}
{{--            <th>Дата создания</th>--}}
{{--            <th>Дата ответа</th>--}}
{{--            <th>Действия</th>--}}

{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($showq as $productitem)--}}
{{--                <tr>--}}
{{--                    <th>{{$productitem->id}}</th>--}}
{{--                    <th>{{$productitem->username}}</th>--}}
{{--                    <td>{{$productitem->usermail}}</td>--}}
{{--                    <td>{{$productitem->usernumber}}</td>--}}
{{--                    <td class="message_table">{{$productitem->question}}</td>--}}
{{--                    <td class="message_table">{{$productitem->sent_question}}</td>--}}
{{--                    <td>{{$productitem->created_at}}</td>--}}
{{--                    <td>{{$productitem->updated_at}}</td>--}}
{{--                    <td class="action">--}}
{{--                        <div class="btn-group">--}}
{{--                            <a href="/deletesentquestion/{{$productitem->id}}" class="btn-delete">Удалить</a>--}}
{{--                        </div>--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    <div>--}}
{{--        <nav aria-label="Page navigation example">--}}
{{--            {{$showq->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}--}}
{{--        </nav>--}}

{{--    </div>--}}
