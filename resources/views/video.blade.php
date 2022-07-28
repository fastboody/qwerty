@extends('layouts.main-layout')
@section('title', 'Видео')
@section('content')
<article id="main">
<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Видеоролики</h2>
</section>
  
<section>
	<form class="search" method="get" action="{{route('search_videos')}}">
		<input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">
	</form>
</section>  

<div class="container">
    <div class="posts-list">
        @foreach($video as $vid)
        <article id="post-1" class="post">
            <div class="thumb-wrap">
                <iframe src="{{$vid->video_link}}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="post-content">
                <h2 class="post-title">{!!$vid->title!!}</h2>
                <h2>{!!$vid->created_at!!}</h2>
                
                
            </div>
        </article>
        @endforeach
    </div>
</div>
</article>
<nav aria-label="Page navigation example">
            {{$video->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>

</body>

</html>
