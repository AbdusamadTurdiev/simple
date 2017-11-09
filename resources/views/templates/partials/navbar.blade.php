<div class="col-md-3 col-md-push-1 main-nav">
    <div class="list-group">
      <a href="{{ route('profile.index', 
              ['username' => Auth::user()->username]) }}" class="list-group-item">
            <i class="glyphicon glyphicon-home navbar-icon"></i> Профиль
      </a>
      <a href="{{ route('home') }}" class="list-group-item">
        <i class="glyphicon glyphicon-globe navbar-icon"></i> Лента
      </a>
      <a href="{{ route('messages') }}" class="list-group-item">
        <i class="glyphicon glyphicon-envelope navbar-icon"></i> Сообщения 
        @include('messenger.unread-count')
      </a>
      <a href="{{ route('friend.index') }}" class="list-group-item">
        <i class="glyphicon glyphicon-user navbar-icon"></i> Друзья 
        @if(Auth::user()->friendRequests()->count())
          <span class="badge">{{ Auth::user()->friendRequests()->count() }}</span>
        @endif
      </a>
    </div>
</div>