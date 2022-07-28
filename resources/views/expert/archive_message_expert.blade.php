@extends('layouts.admin-layot')
@section('title', 'Сообщения')
@section('content')


    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table" style="">
                    <thead>
                    <th>ID</th>
                    <th>Адрес</th>
                    <th>Ответ спец.</th>
                    <th>Пользователь добавивший запись</th>
                    <th>Почта пользователя</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                    <th>Источник</th>
                    <th>Фото</th>
                    <th>Действия</th>


                    </thead>
                    <tbody>
                    @foreach($showm as $productitem)
                        <tr>
                            <td>{{$productitem->message_id}}</td>
                            <td>{{$productitem->address}}</td>
                            <td>{{$productitem->description}}</td>
                            <td>{{$productitem->name}}</td>
                            <td>{{$productitem->email}}</td>
                            <td>{{$productitem->created_at}}</td>
                            <td>{{$productitem->updated_at}}</td>
                            <td><a target="_blank" href="{{$productitem->link_source}}">{{$productitem->link_source}}</a></td>
                            <td>@foreach (json_decode($productitem->image) as $key => $image)<a target="_blank" href="/uploads/{{$image}}"><img width="50" src="/uploads/{{$image}}"></a>@endforeach</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="/archive_message_expert/{{$productitem->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-archive"></i></a>
                                    <a href="/editmessage/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-reply-all"></i></a>
                                    <a href="/deletemessage/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <nav aria-label="Page navigation example">
                    {{$showm->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
                </nav>
            </div>
        </div>
    </div>

@endsection


{{--@extends('layouts.main-layout')--}}
{{--@section('title', 'Сообщения')--}}
{{--@section('content')--}}
{{--<table class="table table-hover" style="margin-top: 30px;"><thead>--}}
{{--    <th>ID</th>--}}
{{--  	<th>Адрес</th>--}}
{{--    <th>Сообщение</th>--}}
{{--    <th>Пользователь добавивший запись</th>--}}
{{--    <th>Почта пользователя</th>--}}
{{--    <th>Дата создания публикации сообщения</th>--}}
{{--    <th>Дата обнавления записи</th>--}}
{{--    <th>Источник</th>--}}
{{--    <th>Фото</th>--}}

{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($showm as $productitem)--}}
{{--        <tr>--}}
{{--            <th>{{$productitem->message_id}}</th>--}}
{{--            <th>{{$productitem->address}}</th>--}}
{{--            <td>{{$productitem->description}}</td>--}}
{{--            <td>{{$productitem->name}}</td>--}}
{{--            <td>{{$productitem->email}}</td>--}}
{{--            <td>{{$productitem->created_at}}</td>--}}
{{--            <td>{{$productitem->updated_at}}</td>--}}
{{--            <td><a target="_blank" href="{{$productitem->link_source}}">{{$productitem->link_source}}</a></td>--}}
{{--            <td>@foreach (json_decode($productitem->image) as $key => $image)<a target="_blank" href="/uploads/{{$image}}"><img width="50" src="/uploads/{{$image}}"></a>@endforeach</td>--}}

{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--<div>--}}
{{--    <nav aria-label="Page navigation example">--}}
{{--        {{$showm->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}--}}
{{--    </nav>--}}
{{--</div>--}}
