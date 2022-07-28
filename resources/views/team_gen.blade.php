@extends('layouts.main-layout')
@section('title', 'Обо мне')
@section('content')

<article id="main">



<section class="spotlight">
        <div class="image">
           <img src="/uploads/{{json_decode($Info->image)[0]}}" alt="error404">
  		</div>
  		<div class="content">
          <center>      <h2>{{$Info->employee}}</h2> </center>
          <center>   <div class="" style="font-size: 15px;padding: 20px 0 0px 0px;">{!!$Info->description_max!!}</div> </center>
        </div>
</section>

<article id="main">
    <section class="" style="padding: 30px 0 0 0;">
       <section id="one" class="" style="padding: 50px 0 25px 0;">
         <center>   <h2 id="news_index">Грамоты</h2></center>
</section>
    <section class="wrapper style5">


 <div class="carousel-inner">
<div class="home-demo">
  		<div class="owl-carousel owl-theme team-carousel" style="display: flex; justify-content: center;">
           @foreach (json_decode($Info->gram_image) as $key => $gram_image)
  			<div class="item team-carousel__item">
      			 <img class="good team-carousel__img" src="/uploads/{{ $gram_image }}" >
        	</div>
           @endforeach

   		 </div>
  	</div>

</div>

    </section>

</article>
@endsection
