@extends('layouts.main-layout')
@section('title', 'Видео')
@section('content')
<article id="main">

     

  <section id="one" class="wrapper style_title special">
    <h2 id="news_index">Новости</h2>   <p>{!! $InfoV->title !!}</p>
</section>
    <section class="wrapper style5">
        <div class="inner">
                    <iframe width="560" height="315" src="{{ $InfoV->video_link }}" frameborder="0" allowfullscreen></iframe>
                </div>

            <h3>16.03.2018</h3>

            <p>{!! $InfoV->description_max !!}</p>

            <hr />

        </div>
    </section>
</article>
@endsection
