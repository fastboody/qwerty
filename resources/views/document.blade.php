@extends('layouts.main-layout')
@section('title', 'Видео')
@section('content')
<article id="main">
<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Документы</h2>
</section>

  <section>
	<form class="search" method="get" action="{{route('search_documents')}}">
		<input type="text" class="search" id="s" name="s" placeholder="Искать здесь...">
	</form>
</section>
<div class="container">
    <div class="posts-list">
        @foreach($document as $doc)
        <article id="post-1" class="post">
            <div class="thumb-wrap">
                <iframe src="uploads/{{$doc->document}}" frameborder="0" ></iframe>
            </div>
            <div class="post-content">
                <a class="document" href="/uploads/{{$doc->document}}">{{$doc->title}}</a>
              <h2>{{$doc->created_at}}</h2>
            </div>
        </article>
        @endforeach
            
    </div>

</div>
  
  <article>
<nav aria-label="Page navigation example">
            {{$document->appends(['s' => request()->s])->links("pagination::bootstrap-4")}}
        </nav>

</body>

</html>
