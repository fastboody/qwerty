@extends('layouts.main-layout')
@section('title', 'Название')
@section('content')

<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Название</h2>
</section>

<style>
		.image-effect-simple{
			width: 500px;
			height: 300px;
			overflow: hidden;
			position: relative;
			margin: 0 auto;
			box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
		}

		.image-effect-simple .image-layer{
			position: absolute;
			top:0;
			left: 0;
			height: 300px;
			overflow: hidden;
			z-index: 1;

			-webkit-transition: 0.4s ease;
			transition: 0.4s ease;
		}

		.image-effect-simple:hover .image-layer{
			transform: translateY(-50px);
			-webkit-transform: translateY(-50px);
			-webkit-filter: blur(1px);
		}

		.image-effect-simple .share-layer{
			position: absolute;
			bottom:-100px;
			left: 0;
			background-color: #fff;
			width: 100%;
			height: 100px;
			-webkit-transition: 0.4s;
			transition: 0.4s;
			z-index: 10;
		}

		.image-effect-simple:hover .share-layer{
			transform: translateY(-100px);
			-webkit-transform: translateY(-100px);
		}

		.share-button{
			display: inline-block;
			text-decoration: none;
			color: #ffffff;
			padding: 12px;
			width: 28%;
			border-radius: 2px;
			margin:	30px 10px;
		}

		.share-via-vk{
			background-color:#4C75A3;
		}

		.share-via-facebook{
			background-color:#ed812b;
		}

		.share-via-twitter{
			background-color:#0088cc;
		}
  .image-layer img{
      border-radius: 0;
    margin: 0 auto;
    max-height: 28em;
    object-fit: contain;
    width: 100%;
    height: 100%;
  }
*{
	margin:0;
	padding:0;
}
html{
	background-color: #eaf0f2;
}

.container_links{
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;

	text-align: center;
	font: bold 14px sans-serif;
}

	</style>



<body>

<div class="container_links">
	<div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/v102ru" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
			<a href="https://ok.ru/v102ru" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
			<a href="https://t.me/infoV102ru" target="_blank" class="share-button share-via-twitter">
				Телеграм
			</a>
		</div>
      
		<div class="image-layer">
			<img src="https://i.ibb.co/pdrK9Y6/getImage.jpg">
		</div>
      
	</div>
  
  <div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/club77674497" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
			
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/jrm0FZq/sgfqwefqw.png" >
		</div>

	</div>
  
  <div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/club29725717" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
			<a href="https://ok.ru/group/51845192155289" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
			<a href="https://telegram.me/newsv1" target="_blank" class="share-button share-via-twitter">
				Телеграм
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/jyV4wvY/v1.jpg" >
		</div>

	</div>
  <div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/volga_kaspiy" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/1L1LfwW/volga-kaspij-kopija.jpg" >
		</div>

	</div>

  <div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/oblvesti" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
          <a href="https://ok.ru/group/53229239992403" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/x8r2BPd/logo.png" >
		</div>

	</div>
<div class="image-effect-simple">

		<div class="share-layer">
			<a href="http://vkontakte.ru/club14409962" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
          <a href="http://www.odnoklassniki.ru/argumenti" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/6Jg2tmP/AN2.gif" >
		</div>

	</div>
<div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/krivoezerkaloru" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
          <a href="https://ok.ru/group/52113876975700" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/j4WF7y3/logo-1.png" >
		</div>

	</div>
  
  <div class="image-effect-simple">

		<div class="share-layer">
			<a href="https://vk.com/volgasib" target="_blank" class="share-button share-via-vk">
				Вконтакте
			</a>
          <a href="https://ok.ru/volgasib" target="_blank" class="share-button share-via-facebook">
				Одноклассники
			</a>
		</div>
		<div class="image-layer">
			<img src="https://i.ibb.co/LQvjvbJ/3007873.png" >
		</div>

	</div>
   
</div>