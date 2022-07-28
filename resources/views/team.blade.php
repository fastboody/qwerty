@extends('layouts.main-layout')
@section('title', 'Наша команда')
@section('content')
<article id="main">
<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Наша команда</h2>
</section>
<section>
	<form class="search" method="get" action="{{route('search_team')}}">
		<input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">
	</form>
</section>
    <section class="wrapper style5">
        <div class="inner">
            <div class="grid-list">
                @foreach ($news as $newt)
                <div class="card_stuff">
              <a href="/teamgenform/{{$newt->id}}"> <p class="zagolovok">{{$newt->employee}}</p></a>
  <a href="/teamgenform/{{$newt->id}}"><img class="d-block w-100" src="/uploads/{{json_decode($newt->image)[0]}}"></a>
              <a href="/teamgenform/{{$newt->id}}"><p class="opisanie">{!!$newt->description!!}</p></a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</article>
<nav aria-label="Page navigation example">
            {{$news->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>
@endsection