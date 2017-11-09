@extends('templates.default')

@section('content')
<div class="row">
  @include('templates.partials.navbar')
  <div class="col-md-6 col-md-push-1 timeline">
    {{-- Status --}}
    <div class="media status">
      <a class="pull-left" href="/user/{{ $status->user->username }}">
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
              <favorite :reply="{{ $status }}"></favorite>
            </li>
          </ul>
      </div>
    </div>
    {{-- Status ends --}}
    <hr>
    {{-- Replies --}}
    <replies-list
      :parent="{!! json_encode($status->id) !!}"
      :user="{!! json_encode(Auth::id()) !!}">
    </replies-list>
    {{-- Replies end --}}
  </div>
</div>
@endsection