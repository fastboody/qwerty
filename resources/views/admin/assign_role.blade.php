@extends('layouts.admin-layot')
@section('title', 'Добавление данных')
@section('content')

    <div class="container_logo">
        <div class="row justify-content-center">
            <center>{{ __('Редактирование Ролей') }}</center>
            {{ __('1 - Пользователь') }}<br>
            {{ __('2 - Админ') }}<br>
            {{ __('3 - Эксперт') }}<br>
            {{ __('4 - Блокировка') }}<br>
        </div>
    </div>


    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="ms-auto position-relative" method="get" action="{{route('searchname_assign_role')}}" >
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" type="text"  id="s" name="s" placeholder="search">
                </form>
                <div class="table-responsive mt-3">
    <table class="table table-hover" style="margin-top: 30px;">
        <thead>
        <th>ID польз.</th>
        <th>Имя польз.</th>
        <th>E-mail</th>
        <th>ID Роли</th>

        <th>Действия</th>
        </thead>
        <tbody>
        @foreach($show as $productitem)
            <tr>
                <td class="image_table">{{$productitem->id}}</td>
                <td class="image_table">{{$productitem->name}}</td>
                <td>{{$productitem->email}}</td>
                <td>{{$productitem->role_id}}</td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="/editassignrole/{{$productitem->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <a href="/deleteassignrole/{{$productitem->id}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
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
            {{$show->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>
    </div>


@endsection
