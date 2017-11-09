@extends('templates.default')

@section('content')
<div class="row">
  @include('templates.partials.navbar')
  <div class="col-md-6 col-md-push-1 profile-head">
    <div class="panel">
      <div class="panel-heading">
        <div class="media">
          <div class="media-left">
            <div class="profile-avatar">
              <img data-toggle="modal" data-target="#avatar" class="media-object img-responsive img-circle" alt="avatar" src="{{ $user->avatarpath }}">
            </div>
          </div>
          <div class="media-body">
            <h5 class="media-heading">{{ $user->getNameOrUsername() }}</h5>
            @if($user->location)
              <p>{{ $user->location }}</p>
            @endif
            @if(Auth::user()->isFriendsWith($user))
              <p class="user-info-line">{{ $user->getNameOrUsername() }} ваш друг.</p>
              <form action="/friends/delete/{{ $user->username }}" method="post">
                {{ csrf_field() }}
                  <input type="submit" value="Отменить дружбу" class="btn btn-primary btn-sm">
              </form>
            @elseif(Auth::user()->hasFriendRequestPending($user))
              <p class="user-info-line">Ожидает пока {{ $user->getNameOrUsername() }} примет ваш запрос</p>
            @elseif(Auth::user()->id !== $user->id)
                <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary btn-sm media-heading">Добавить в друзья</a>
            @endif
            @if(Auth::id() !== $user->id)
              <br><a href="{{ route('messages.create', ['id' => $user->id]) }}" class="btn btn-success btn-sm">Начать беседу</a>
            @endif
            @if(Auth::user()->id == $user->id)
              <a class="btn btn-primary btn-xs" href="{{ route('profile.edit') }}">Изменить профиль</a>
            @endif
          </div>
        </div>
      </div>
        <hr>
      <div class="panel-body">
        <p>Поделитесь новой записью</p>
        <form role="form" action="{{ route('status.post') }}" method="post">
          <div class="form-group">
            {{ csrf_field() }}
            <div class="input-group input-group-sm">
              <input name="status" required type="text" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-success" type="submit">Опубликовать</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
      {{-- Statuses --}}
<div class="col-md-6 col-md-push-4 profile-timeline">
  @if(!$statuses->count())
      <p>Лента пользователя {{ $user->getFirstNameOrUserName() }} пустая.</p>
  @else
  @foreach($statuses as $status)
    <div class="media timeline-post">
      <a class="pull-left" href="/user/{{ $status->user->username }}">
        <div class="avatar-parent">
          <img class="media-object img-responsive img-circle" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->avatarpath }}">
        </div>
      </a>
      @if(Auth::user()->id == $status->user_id)
        <form action="/status/delete/{{ $status->id }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button title="Удалить" type="submit" class="close pull-right" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </form>
      @endif
      <div class="media-body">
        <h5 class="media-heading">{{ $status->user->getNameOrUsername() }}</h5>
        <p>{{ $status->body }}</p>
        <ul class="list-inline">
          <li class="text-muted"><small>{{ $status->created_at->diffForHumans() }}</small></li>
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
  
  <!-- Large avatar modal -->
<div class="modal fade" tabindex="-1" id="avatar" role="dialog" aria-labelledby="avatarSmallLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="avatar-view">
        <img class="img-responsive" src="{{ $user->avatarpath }}">
      </div>
    </div>
  </div>
</div>
@endsection