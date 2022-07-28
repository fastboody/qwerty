@extends('layouts.main-layout')
@section('title', 'За Чистые Выборы')
@section('content')
    <!-- Banner -->
    <section id="banner">
        <section id="one" class="wrapper style_title special">
            <h2 id="news_index">КАРТА МОИХ СООБЩЕНИЙ</h2>
        </section>
        <div class="inner">
            <br><h2 id="title_header">МОИ СООБЩЕНИЯ</h2>
        </div>
        @if($list->count() === 0)
            <p>Сообщений нет!</p>
        @else
            <div id="map" style="    max-width: 1200px;
    height: 100%;
    width: 100%;
    overflow: hidden;
    margin: 0px auto 20px;"></div>
        @endif
        <div class="inner">
            <br><h2 id="title_header">СООБЩЕНИЯ, ОЖИДАЮЩИЕ ОТВЕТА СПЕЦИАЛИСТА</h2>
        </div>
        @if($showm->count() === 0)
            <p>Сообщений нет!</p>
        @else
            <table class="table table-hover" style="margin-top: 30px;"><thead>
                <th>ID</th>
                <th>Адрес</th>
                <th>Текст сообщения</th>
                <th>Дата создания публикации сообщения</th>
                <th>Источник</th>
                <th>Фото</th>

                <th>Действия</th>
                </thead>
                <tbody>
                @foreach($showm as $productitem)
                    <tr>
                        <th class="image_table">{{$productitem->id}}</th>
                        <th>{{$productitem->address}}</th>
                        <td class="message_table">{{$productitem->description}}</td>
                        <td>{{$productitem->created_at}}</td>
                        <td><a target="_blank" href="{{$productitem->link_source}}">{{$productitem->link_source}}</a></td>
                        <td class="image_table">@foreach (json_decode($productitem->image) as $key => $image)<a target="_blank" href="/uploads/{{$image}}"><img width="50" src="/uploads/{{$image}}"></a>@endforeach</td>
                        <td class="action">
                            <div class="btn-group">
                                <a href="/deletemymapmessage/{{$productitem->id}}" class="btn btn-danger btn-xs">Удалить</a>
                                <a href="/editmymapmessage/{{$productitem->id}}" class="btn btn-primary  btn-xs">Изменить</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div>
            <nav aria-label="Page navigation example">
                {{$showm->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
            </nav>
        </div>
    </section>


    <!-- Map Script -->
    @if($list->count() === 0)

    @else
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
        <?php
        $addresses = [];
        foreach ($list as $row){
            $addresses[] = [
                'title' => $row->title,
                'description' => $row->description,
                'status' => $row->status,
                'link_source' => $row->link_source,
                'link_source_spc' => $row->link_source_spc,
                'latitude'=> $row->latitude,
                'longitude'=>$row->longitude,
                'address'=>$row->address,
                'images'=>json_decode($row->image)
            ];
        }
        $addresses = json_encode($addresses);
        ?>

        <script type="text/javascript">
            ymaps.ready(init);
            function init() {
                var myMap = new ymaps.Map("map", {
                    center: '<?php echo "{$list[0]->latitude}, {$list[0]->longitude}"; ?>',
                    zoom: 16,
                    controls: ['zoomControl', 'typeSelector',  'fullscreenControl']
                }, {
                    searchControlProvider: 'yandex#search'
                });
                clusterer = new ymaps.Clusterer({
                    /**
                     * Через кластеризатор можно указать только стили кластеров,
                     * стили для меток нужно назначать каждой метке отдельно.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
                     */
                    preset: 'islands#invertedBlueClusterIcons',
                    /**
                     * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
                     */
                    groupByCoordinates: false,
                    /**
                     * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
                     */
                    clusterDisableClickZoom: true,
                    clusterHideIconOnBalloonOpen: false,
                    geoObjectHideIconOnBalloonOpen: false,
                    clusterBalloonContentLayoutWidth: 580,
                    clusterBalloonContentLayoutHeight: 340,
                    geoObjectBalloonContentLayoutWidth: 580,
                    geoObjectBalloonContentLayoutHeight: 320
                }),
                    /**
                     * Функция возвращает объект, содержащий данные метки.
                     * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
                     * Поле balloonContentBody - источник данных для контента балуна.
                     * Оба поля поддерживают HTML-разметку.
                     * Список полей данных, которые используют стандартные макеты содержимого иконки метки
                     * и балуна геообъектов, можно посмотреть в документации.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                     */
                    getPointData = function (index, address, desc, st, images, title, lkp, lks) {
                        let images_tags = []
                        let a_lkp_tags = []
                        let a_lks_tags = []
                        let text_message_tags_1 = []
                        let text_message_tags_2 = []
                        let text_message_tags_3 = []
                        let text_message_tags_4 = []
                        let text_message_tags_5 = []
                        let text_message_tags_6 = []
                        for(let image of images){
                            images_tags.push(`<a href="uploads/${image}" target="_blank"><img src='uploads/${image}' width="300px"></a>`)
                        }
                        let images_html = images_tags.join("<br><br>")

                        a_lkp_tags.push(`<a class="link_message" href="${lkp}" target="_blank">${lkp}</a>`)
                        let a_lkp_html = a_lkp_tags.join("<br><br>")

                        a_lks_tags.push(`<a class="link_message" href="${lks}" target="_blank">${lks}</a>`)
                        let a_lks_html = a_lks_tags.join("<br><br>")

                        text_message_tags_1.push(`<b class="text_message">Текст сообщения:</b>`)
                        let text_message_html_1 = text_message_tags_1.join("<br><br>")

                        text_message_tags_2.push(`<b class="text_message">Ссылка на источник пользователя:</b>`)
                        let text_message_html_2 = text_message_tags_2.join("<br><br>")

                        text_message_tags_3.push(`<b class="text_message">Ответ специалиста:</b>`)
                        let text_message_html_3 = text_message_tags_3.join("<br><br>")

                        text_message_tags_4.push(`<b class="text_message">Ссылка на источник специалиста:</b>`)
                        let text_message_html_4 = text_message_tags_4.join("<br><br>")

                        text_message_tags_5.push(`<b class="text_message">Фото:</b>`)
                        let text_message_html_5 = text_message_tags_5.join("<br><br>")

                        text_message_tags_6.push(`<b class="status_message">Статус:</b>`)
                        let text_message_html_6 = text_message_tags_6.join("<br><br>")

                        return {
                            balloonContentHeader: address !== null ? 'Ул.' + address : '',
                            balloonContentBody: `<br>${text_message_html_1}<br>${desc}<br><br>${text_message_html_2}<br>${a_lkp_html}<br><br>${text_message_html_3}<br>${title}<br><br>${text_message_html_4}<br>${a_lks_html}<br>`,
                            balloonContentFooter: `${text_message_html_5}<br>${images_html} <br>${text_message_html_6} ${st}`,
                            clusterCaption: address !== null ? 'Ул.' + address : '',

                        };
                    },
                    /**
                     * Функция возвращает объект, содержащий опции метки.
                     * Все опции, которые поддерживают геообъекты, можно посмотреть в документации.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                     */
                    getPointOptions = function () {
                        return {
                            preset: 'islands#blueIcon'
                        };
                    }
                points = [
                        <?php foreach ($list as $row): ?>
                    [<?php echo "{$row->latitude}, {$row->longitude}"; ?>],
                    <?php endforeach; ?>
                ]
                geoObjects = [];

                /**
                 * Данные передаются вторым параметром в конструктор метки, опции - третьим.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
                 */
                let addresses = <?=$addresses?>;
                for(let i = 0, len = points.length; i < len; i++) {
                    console.log(addresses[i])
                    let address = addresses[i].address;
                    let desc = addresses[i].description;
                    let st = addresses[i].status;
                    let images = addresses[i].images
                    let title = addresses[i].title
                    let lkp = addresses[i].link_source
                    let lks = addresses[i].link_source_spc


                    geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i, address, desc, st, images, title, lkp, lks), getPointOptions());
                }

                /**
                 * Можно менять опции кластеризатора после создания.
                 */
                clusterer.options.set({
                    gridSize: 80,
                    clusterDisableClickZoom: true
                });
                var volgograd = ymaps.geoQuery(ymaps.regions.load("RU", {
                    lang: "ru"
                })).search('properties.hintContent = "Волгоградская область"').setOptions({
                    fillOpacity: '0.4',
                    fillColor: '#7184C286',
                    strokeColor: '#fa4d09'
                });
                var myCollection = new ymaps.GeoObjectCollection();
                volgograd.addToMap(myMap);
                myMap.geoObjects.add(myCollection);

                /**
                 * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
                 */
                clusterer.add(geoObjects);
                myMap.geoObjects.add(clusterer);

                /**
                 * Спозиционируем карту так, чтобы на ней были видны все объекты.
                 */

                myMap.setBounds(clusterer.getBounds(), {
                    checkZoomRange: true
                });

                // Сделаем у карты автомасштаб чтобы были видны все метки.
                myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
            }

        </script>
        @endif
        </body>
        </html>
