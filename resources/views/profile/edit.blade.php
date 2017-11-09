@extends('templates.default')

@section('content')
  <div class="row">
    @include('templates.partials.navbar')
    <div class="col-md-6 col-md-push-1 profile-edit">
        <h3>Изменить профиль</h3>
      <form method="post" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
          <label for="photo">Фото профиля</label>
          <input type="file" name="photo">
          @if($errors->has('photo'))
            <span class="help-block">{{ $errors->first('photo') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
          <label for="first_name">Имя</label>
          <input type="text" name="first_name" class="form-control" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
          @if($errors->has('first_name'))
            <span class="help-block">{{ $errors->first('first_name') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
          <label for="last_name">Фамилия</label>
          <input type="text" name="last_name" class="form-control" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
          @if($errors->has('last_name'))
            <span class="help-block">{{ $errors->first('last_name') }}</span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
          <label for="location">Город</label>
          <input type="text" name="location" class="form-control" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">
          @if($errors->has('location'))
            <span class="help-block">{{ $errors->first('location') }}</span>
          @endif
        </div>
        <input type="submit" class="btn btn-primary" value="Изменить"></button>
      </form>
    </div>
  </div>
@endsection