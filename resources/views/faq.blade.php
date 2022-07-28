@extends('layouts.main-layout')
@section('title', 'FAQ')
@section('content')
<body>

<br><br><br>

<section class="cd-faq">
    <ul class="cd-faq-categories">
    @foreach($Info as $chapter)

		<li><a class="selected" href="#{{$chapter->link}}">{{$chapter->chapter_name}}</a></li>

    @endforeach
    </ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
@foreach($list as $question)
		<ul id="{{$question->link}}" class="cd-faq-group">
			<li class="cd-faq-title"><h2>{{$question->chapter_name}}</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#">{{$question->question_name}}</a>
				<div class="cd-faq-content">
					<p>{{$question->description}}</p>
				</div> <!-- cd-faq-content -->
			</li>

        </ul> <!-- cd-faq-group -->

 @endforeach
	</div> <!-- cd-faq-items -->


	<a href="#0" class="cd-close-panel">Закрыть</a>
</section> <!-- cd-faq -->

<section class="" style="padding: 30px 0 0 0;">
       <section id="one" class="" style="text-align: center;padding: 50px 0 25px 0;">
    <h2 id="news_index">Форма Обратной связи</h2>
</section>

<section class="feedback">
  <form class="obratnuj-zvonok" autocomplete="off" action={{ route('faq-form') }} method='post'>
    @if(Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::get('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    @csrf
<div class="form-zvonok">
  <div>
      <label for="exampleInputPassword1" class="form-label">ФИО<span>*</span></label>
      <input type="text" name="username" class="form-control" id="username" required placeholder="Осипова Анна Андреевна" value="{{old('username')}}">
      <span style="color: red;">@error('username'){{$message}} @enderror</span></div>
    <div>
        <label for="exampleInputPassword1" class="form-label">E-mail<span></span></label>
        <input type="text" name="usermail" class="form-control" id="usermail"  placeholder="example@mail.ru" value="{{old('usermail')}}">
        <span style="color: red;">@error('usermail'){{$message}} @enderror</span></div>
    <div>
        <label for="exampleInputPassword1" class="form-label">Номер телефона (с кодом)<span></span></label>
        <input type="text" name="usernumber" class="form-control" id="usernumber"  placeholder="+79998887766" value="{{old('usernumber')}}">
        <span style="color: red;">@error('usernumber'){{$message}} @enderror</span></div>
    <div>
        <label for="exampleInputPassword1" class="form-label">Сообщение<span>*</span></label>
        <textarea type="text" name="question" class="form-control" id="question" required placeholder="Опишите вопрос" value="{{old('question')}}"></textarea>
        <span style="color: red;">@error('question'){{$message}} @enderror</span></div>
  <div>
      <div>
          <input type="hidden" name="status" class="form-control" id="status"
                 value="не отвечен">
          <span style="color: red;">@error('status'){{$message}} @enderror</span>
      </div>
      <div>
          {!! NoCaptcha::renderJs() !!}
          @if($errors->has('g-recaptcha-response'))
              <span class="warning-captcha">{{$errors->first('g-recaptcha-response')}}</span>
          @endif
          {!! NoCaptcha::display() !!}
      </div>
    <button type="submit" name="submit"  class="btn btn-primary">Отправить сообщение</button>
</div>
</div>
    </form>
</section>

</body>

</html>