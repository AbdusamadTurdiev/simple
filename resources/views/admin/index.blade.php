@extends('admin.default')

@section('content')
  <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-male"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Пользователей</span>
            <span class="info-box-number">{{ $users->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-heart-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Лайков</span>
            <span class="info-box-number">{{ $likes->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-comments-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Постов</span>
            <span class="info-box-number">{{ $statuses->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Сообщений</span>
            <span class="info-box-number">{{ $messages->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- Users box -->
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Пользователи</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
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
                      Удалить <i class="fa fa-trash fa-lg"></i>
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
          <!-- /.box-body -->
        </div>
      </div>

      <!-- Deleted users box -->
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Удаленные пользователи</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            @if(!$deletedUsers->count())
              <p>По вашему запросу ничего не найдено</p>
            @else
              @foreach($deletedUsers as $deleted)
                <div class="media search-user">
                  <form action="{{ route('user.restore', $deleted->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button title="Восстановить" type="submit" class="btn btn-success pull-right">
                      Восстановить <i class="fa fa-leaf fa-lg"></i>
                    </button>
                  </form>
                  <a class="pull-left" href="{{ route('profile.index', ['username' => $deleted->username]) }}">
                    <div class="avatar-parent">
                        <img class="media-object img-responsive img-circle" alt="{{ $deleted->getNameOrUsername() }}" src="{{ $deleted->avatarpath }}">
                    </div>
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $deleted->username]) }}">{{ $deleted->getNameOrUsername() }}</a></h4>
                    @if($deleted->location)
                      <p>{{ $deleted->location }}</p>
                    @endif
                  </div>
                </div>
              @endforeach
            @endif
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    <!-- /.box -->
    </div>
    <!-- /.row -->
@endsection