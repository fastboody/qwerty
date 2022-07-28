@extends('layouts.main-layout')
@section('title', 'Новости')
@section('content')

<article id="main">
    <section id="one" class="wrapper style_title special">
    <h2 id="news_index">Новости</h2>
</section>
    <section class="wrapper style5">
        <div class="inner">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach (json_decode($Info->image) as $key => $image)
                        <div class="carousel-item @if($key==0) active @endif">
                            <img class="good" src="/uploads/{{ $image }}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            <h3>{{$Info->created_at}}</h3>

            <p align="justify">{!! $Info->description_max !!}</p>
			<div class="ya-share2" data-curtain data-shape="round" data-services="messenger,vkontakte,odnoklassniki,telegram,viber,whatsapp" data-title="{{$Info->title}}" data-image="http://cg48255.tmweb.ru/uploads/{{json_decode($Info->image)[0]}}"></div>
            <hr />
			
        </div>
    </section>
</article>
@endsection
