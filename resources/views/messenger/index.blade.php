@extends('templates.default')

@section('content')
  <div class="row">
    @include('templates.partials.navbar')
    @include('messenger.partials.flash')
    <div class="col-md-6 col-md-push-1 threads-container">
      <a href="{{ route('messages.create') }}" class="btn btn-primary">Создать чат</a>
      <hr>
      @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
    </div>
  </div>
@endsection
