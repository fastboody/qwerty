@extends('layouts.admin-layot')
@section('title', 'Сообщения')
@section('content')


    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="ms-auto position-relative" method="get" action="{{route('search_sentmessage')}}" >
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text"  id="s" name="s" placeholder="search">
                </form>
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>Адрес</th>
                    <th>Сообщение</th>
                    <th>Источник польз.</th>
                    <th>Фото</th>
                    <th>ответ Спец.</th>
                    <th>Источник Спец.</th>
                    <th>Сотрудник</th>
                    <th>Почта специалиста</th>
                    <th>Дата создания публ. сообщ.</th>
                    <th>Дата ответа на сообщ.</th>
                    <th>Действия</th>


                    </thead>
                    <tbody>
                    @foreach($showm as $productitem)
                        <tr>
                            <td>{{$productitem->id}}</td>
                            <td>{{$productitem->address}}</td>
                            <td>{{$productitem->description}}</td>
                            <td><a target="_blank" href="{{$productitem->link_source}}">{{$productitem->link_source}}</a></td>
                            <td class="image_table">@foreach (json_decode($productitem->image) as $key => $image)<a target="_blank" href="/uploads/{{$image}}"><img class="image_table_con" width="50" src="/uploads/{{$image}}"></a>@endforeach</td>
                            <td>{{$productitem->title}}</td>
                            <td>{{$productitem->link_source_spc}}</td>
                            <td>{{$productitem->name}}</td>
                            <td>{{$productitem->email}}</td>
                            <td>{{$productitem->created_at}}</td>
                            <td>{{$productitem->updated_at}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/editsentmessage/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-reply-all"></i></a>
                                    <a href="/deletesentmessage/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
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
            {{$showm->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>
    </div>
@endsection


{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Сообщения')--}}
{{--@section('content')--}}
{{--    <section>--}}
{{--        <form class="search" method="get" action="{{route('search_sentmessage')}}">--}}
{{--            <input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">--}}
{{--        </form>--}}
{{--    </section>--}}
{{--<table class="table table-hover" style="margin-top: 30px;"><thead>--}}
{{--    <th>ID</th>--}}
{{--    <th>Адрес</th>--}}
{{--    <th>Сообщение</th>--}}
{{--    <th>Источник польз.</th>--}}
{{--    <th>Фото</th>--}}
{{--    <th>Ответ спец.</th>--}}
{{--    <th>Источник спец.</th>--}}
{{--    <th>Сотрудник</th>--}}
{{--    <th>Почта специалиста</th>--}}
{{--    <th>Дата создания публикации сообщения</th>--}}
{{--    <th>Дата ответа на сообщение</th>--}}


{{--    <th>Действия</th>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($showm as $productitem)--}}
{{--        <tr>--}}
{{--            <th class="image_table">{{$productitem->id}}</th>--}}
{{--            <th>{{$productitem->address}}</th>--}}
{{--            <td class="message_table">{{$productitem->description}}</td>--}}
{{--            <td><a target="_blank" href="{{$productitem->link_source}}">{{$productitem->link_source}}</a></td>--}}
{{--            <td class="image_table">@foreach (json_decode($productitem->image) as $key => $image)<a target="_blank" href="/uploads/{{$image}}"><img class="image_table_con" width="50" src="/uploads/{{$image}}"></a>@endforeach</td>--}}
{{--            <td class="message_table">{{$productitem->title}}</td>--}}
{{--            <td><a target="_blank" href="{{$productitem->link_source_spc}}">{{$productitem->link_source_spc}}</a></td>--}}
{{--            <td class="image_table">{{$productitem->name}}</td>--}}
{{--            <td>{{$productitem->email}}</td>--}}
{{--            <td>{{$productitem->created_at}}</td>--}}
{{--            <td>{{$productitem->updated_at}}</td>--}}
{{--            <td class="action">--}}
{{--                <div class="btn-group">--}}
{{--                    <a href="/deletesentmessage/{{$productitem->id}}" class="btn-delete">Удалить</a>--}}
{{--                    <a href="/editsentmessage/{{$productitem->id}}" class="btn-edit">Редактировать</a>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--<div>--}}
{{--    <nav aria-label="Page navigation example">--}}
{{--        {{$showm->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}--}}
{{--    </nav>--}}
{{--</div>--}}
