@extends('templates.default')

@section('content')
<div class="row">
  @include('templates.partials.navbar')
  <div class="col-md-6 col-md-push-1 timeline">
    @if(!$statuses->count())
      <p>Пока, что ваша лента пустая.</p>
    @else
      @foreach($statuses as $status)
        <div class="media timeline-post">
          <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
            <div class="avatar-parent">
              <img class="media-object img-responsive img-circle" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->avatarpath }}">
            </div>
          </a>
          <div class="media-body">
            <h5 class="media-heading">{{ $status->user->getNameOrUsername() }}</h5>
            <p>{{ $status->body }}</p>
            <ul class="list-inline">
              <li class="text-muted">
                <small>{{ $status->created_at->diffForHumans() }}</small>
              </li>
              <li>
              <a href="/status/{{ $status->id }}/replies"><i class="glyphicon glyphicon-comment"></i></a> {{ $status->replies->count() }}
            </li>
            <li>
              <favorite :reply="{{ $status }}"></favorite>
            </li>
            </ul>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div>
@endsection