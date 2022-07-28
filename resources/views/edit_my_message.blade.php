@extends('layouts.main-layout')
@section('styles_page')
    <link rel="stylesheet" href="{{ asset('assets/css/vue-multiselect.main.css') }}">
@endsection
@section('title', 'Добавление данных')
@section('content')
    <div class="container_logo">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
            <h1>{{ $Title }}</h1>
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            <div class="card-body">
                <form action="/updatemymapmessage" method="post" enctype="multipart/form-data">
                    @csrf

                    <div id="form">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Адрес</label>
                            <vue-multiselect
                                v-model="address_value"
                                :options="addresses_options"
                                label="address"
                                placeholder="Адрес"
                                select-label=""
                                deselect-label=""
                                :disabled="disabled.address"
                                @input="select_address"
                                @remove="remove_address"
                                @search-change="change_address"
                            ></vue-multiselect>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Уик</label>
                            <vue-multiselect
                                v-model="uik_value"
                                :options="uik_options"
                                label="uik"
                                placeholder="Уик"
                                select-label=""
                                deselect-label=""
                                :disabled="disabled.uik"
                                @input="select_uik"
                                @remove="remove_uik"
                                @search-change="change_uik"
                            ></vue-multiselect>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Индекс</label>
                            <vue-multiselect
                                v-model="index_value"
                                :options="index_options"
                                label="index"
                                placeholder="Индекс"
                                select-label=""
                                deselect-label=""
                                :disabled="disabled.index"
                                @input="select_index"
                                @remove="remove_index"
                                @search-change="change_index"
                            ></vue-multiselect>
                            <span style="color: red;">@error('id_address'){{$message}} @enderror</span>
                        </div>
                        <input type="hidden" name="id_address" :value="id_address">
                        <br>
                        <br>
                        <br>
                        <input type="hidden" name="id_message" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea name="description" id="description" cols="45" rows="5">{{ $Info->description }}</textarea>
                            <span style="color: red;">@error('description'){{$message}} @enderror</span>

                        </div>
                        <div class="mb-3">
                            <label for="link_source" class="form-label">Полное описание</label>
                            <textarea name="link_source" id="link_source" cols="45" rows="5">{{ $Info->link_source }}</textarea>
                            <span style="color: red;">@error('link_source'){{$message}} @enderror</span>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'description_max');
                            </script>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Картинка</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                            <span style="color: red;">@error('image'){{$message}} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="status" class="form-control" id="exampleInputPassword1"
                                   value="Обработка">
                            <span style="color: red;">@error('status'){{$message}} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" class="form-control" id="user_id"
                                   value="{{ Auth::user()->id }}">
                            <span style="color: red;">@error('user_id'){{$message}} @enderror</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
                  </div>
              </div>
        </div>
    </div>
@endsection

@section('scripts_page')
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        Vue.component('vue-multiselect', window.VueMultiselect.default)

        let app = new Vue({
            el: '#form',
            data: {
                address_value: null,
                uik_value: null,
                index_value: null,
                addresses_options: [],
                uik_options: [],
                index_options: [],
                id_address: null,
                disabled: {
                    address: false,
                    uik: false,
                    index: false
                }
            },
            methods: {
                change_address: function (address){
                    let app = this;

                    if(address.length !== 0) {
                        let formData = new FormData();
                        formData.append("address", address);

                        fetch('/getaddresses', {
                            method: "POST",
                            body: formData
                        })
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                app.address_value = null;
                                app.addresses_options = data;
                            });
                    }
                },
                remove_address: function (value){
                    let app = this;

                    app.disabled.uik = false;
                    app.disabled.index = false;
                    app.id_address = null;
                },
                select_address: function (value){
                    let app = this;

                    if(value !== null){
                        app.disabled.uik = true;
                        app.disabled.index = true;

                        app.id_address = value.id;
                    }
                },
                change_uik: function (uik){
                    let app = this;

                    if(uik.length !== 0) {
                        let formData = new FormData();
                        formData.append("uik", uik);

                        fetch('/getuiks', {
                            method: "POST",
                            body: formData
                        })
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                app.uik_value = null;
                                app.uik_options = data;
                            });
                    }
                },
                remove_uik: function (){
                    let app = this;

                    app.disabled.address = false;
                    app.disabled.index = false;

                    app.id_address = null;
                },
                select_uik: function (value){
                    let app = this;

                    if(value !== null){
                        app.disabled.address = true;
                        app.disabled.index = true;

                        app.id_address = value.id;
                    }
                },
                change_index: function (index){
                    let app = this;

                    if(index.length !== 0) {
                        let formData = new FormData();
                        formData.append("index", index);

                        fetch('/getindexes', {
                            method: "POST",
                            body: formData
                        })
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                app.index_value = null;
                                app.index_options = data;
                            });
                    }
                },
                remove_index: function (){
                    let app = this;

                    app.disabled.address = false;
                    app.disabled.uik = false;

                    app.id_address = null;
                },
                select_index: function (value){
                    let app = this;

                    if(value !== null){
                        app.disabled.address = true;
                        app.disabled.uik = true;

                        app.id_address = value.id;
                    }
                },
                get_addresses: function (searchQuery){

                }
            }
        })
    </script>
@endsection

