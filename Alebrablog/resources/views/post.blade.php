@extends('Centaur::layout')

@section('title')
Algebra Blog | {{ $post->title }}
@endsection

@section('content')
	<div class="page-header">
        <h1>{{ $post->title }}</h1>
		<small>Author: {{ $post->user->email }}</small><br>
		<small>Published: {{ \Carbon\Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans() }}</small>
    </div>
	<div class="row">
		
			{!! $post->content !!}
		</div>
	</div>
	<div class="row">
	
			@if(Sentinel::check())
				//Prikazi formu za komentiranje

				<h2>Comments</h2>
				@if (Auth::check())
  				@include('includes.errors')
  					{{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
  			<p>{{ Form::textarea('body', old('body')) }}</p>
  					{{ Form::hidden('post_id', $post->id) }}
  			<p>{{ Form::submit('Send') }}</p>
				{{ Form::close() }}
				@endif
				@forelse ($post->comments as $comment)
  			<p>{{ $comment->user->name }} {{$comment->created_at}}</p>
  			<p>{{ $comment->body }}</p>
  			<hr>
				@empty
  		<p>This post has no comments</p>
			<span>{{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</span>
			@endforelse

			@else
				Prikazi link za login
			@endif
		</div>
	</div>
	<div class="row">
		
			ipisi sve komentare $post->comment
		</div>
	</div>
@endsection
