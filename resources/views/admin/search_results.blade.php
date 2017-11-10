@extends('admin.default')

@section('content')
  @if(!$users->count())
    <p>По вашему запросу ничего не найдено</p>
  @else
    <div class="row">
      <div class="col-md-12">
        <h3>Вы искали "{{ Request::input('query') }}"</h3>

        @if(!$users->count())
          <p>По вашему запросу ничего не найдено</p>
        @else
          @foreach($users as $user)
            <div class="media search-user">
              @if(!$user->isAdmin())
              <form action="{{ route('user.delete', $user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button title="Удалить" type="submit" class="btn btn-danger pull-right">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
              @endif
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
        @endif
      </div>
    </div>
  @endif
@endsection