@extends('templates.default')

@section('content')
  <div class="row">
    @include('templates.partials.navbar')
    <div class="col-md-6 col-md-push-1 new-chat">
      <h1>Новый чат</h1>
      <form action="{{ route('messages.store') }}" method="post" class="new-chat-form">
          {{ csrf_field() }}
        <!-- Subject Form Input -->
        <div class="form-group">
            <label class="control-label">Название</label>
            <input required type="text" class="form-control" name="subject"
                   value="{{ old('subject') }}">
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            <label class="control-label">Сообщение</label>
            <input required type="text" name="message" value="{{ old('message') }}" class="form-control"/>
        </div>

        @if($users->count() > 0)
            <p>Участники</p>
            <div class="checkbox">
                @foreach($users as $user)
                    <label title="{{ $user->username }}">
                        <input type="checkbox" name="recipients[]"
                            value="{{ $user->id }}">{!!$user->username!!}
                    </label>
                @endforeach
            </div>
        @endif

        <!-- Submit Form Input -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary form-control">Создать</button>
        </div>
      </form>
    </div>
  </div>
@endsection
