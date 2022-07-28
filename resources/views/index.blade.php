@extends('layouts.main-layout')
@section('title', 'За Чистые Выборы')
@section('content')

<!-- One -->
<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Новости</h2>
</section>

<section>
	<form class="search" method="get" action="{{route('search_news')}}">
		<input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">
	</form>
</section>

<!-- Two -->
<section id="two" class="wrapper alt style2">

    @foreach($news as $new)
    <section class="spotlight">
        <div class="image">
            <img src="/uploads/{{json_decode($new->image)[0]}}" alt="error404" /></div><div class="content">
            <h2>{!!$new->title!!}</h2>
            <div class="perenos">{!! $new->description !!}</div>
      <h3>{{$new->created_at}}</h3>
            <ul class="actions special">
                <li><a  class="button" href="/tidinggen/{{$new->id}}">Подробнее</a></li>
            </ul>
        </div>
    </section>
    @endforeach
<div>
  
<nav aria-label="Page navigation example">
            {{$news->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>
</div>
</section>
</body>
</html>
