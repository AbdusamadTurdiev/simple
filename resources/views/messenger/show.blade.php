@extends('templates.default')

@section('content')
  @include('templates.partials.navbar')
  <div class="col-md-6 col-md-push-1 messages">
      <h3>Название: {{ $thread->subject }}</h3>
        <message 
        :messages-data="{{ $thread->messages }}" 
        :thread="{{ $thread->id }}" 
        :user="{{ Auth::user() }}">
        </message>
  </div>
@endsection
