@extends('templates.default')

@section('content')
  <div class="row">
    @include('templates.partials.navbar')
    <div class="col-md-6 col-md-push-1 friends">
      <div class="requests">
        <h4>Запросы на дружбу</h4>
        @if(!$requests->count())
          <p>У вас нет запросов на дружбу</p>
        @else
          @foreach($requests as $user)
            <div class="media">
              <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
                <div class="avatar-parent">
                  <img class="media-object img-responsive img-circle" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->avatarpath }}">
                </div>
              </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getNameOrUsername() }}</a></h4>
                @if($user->location)
                  <p>{{ $user->location }}</p>
                @endif
              </div>
            </div>
            <a class="btn btn-success btn-sm friend-button" href="{{ route('friend.accept', ['usernamae' => $user->username]) }}">Принять</a>
            <hr>
          @endforeach
        @endif
      </div>
      <div class="friends-list">
        <h4>Ваши друзья</h4>
        @if(!$friends->count())
          <p>У вас нет друзей.</p>
        @else
          @foreach($friends as $user)
            <div class="media">
              <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
                <div class="avatar-parent">
                  <img class="media-object img-responsive img-circle" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->avatarpath }}">
                </div>
              </a>
            <div class="media-body">
              <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getNameOrUsername() }}</a></h4>
              @if($user->location)
                <p>{{ $user->location }}</p>
              @endif
            </div>
            </div>
            <form method="post" action="{{ route('friend.delete', ['username' => $user->username]) }}"> {{ csrf_field() }}
            <a href="{{ route('messages.create') }}" class="btn btn-sm btn-primary friend-button">Отправить сообщение</a>
              <button type="submit" class="btn btn-sm btn-danger friend-button">Отменить дружбу</button>
            </form>
            <hr>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endsection