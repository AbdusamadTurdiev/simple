@extends('templates.default')

@section('content')
  <div class="row">
    @include('templates.partials.navbar')
    <div class="col-md-6 col-md-push-1 search-result">
    <h3>Вы искали "{{ Request::input('query') }}"</h3>
    
    @if(!$users->count())
      <p>По вашему запросу ничего не найдено</p>
    @else
      <div class="row">
        <div class="col-md-12">
          @foreach($users as $user)
            <div class="media search-user">
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
          @endforeach
        </div>
      </div>
    @endif
    </div>
  </div>
@endsection