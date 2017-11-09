<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="thread">
<div class="media alert {{ $class }}">
    @if(Auth::user()->id == $thread->creator()->id)
      <form action="{{ route('messages.delete', ['id' => $thread->id]) }}" method="post"> {{ csrf_field() }}
        <button type="submit" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </form>
    @endif
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} непрочитанных)</h4>
    <p>
        <small><strong>Создал:</strong> {{ $thread->creator()->username }}</small>
    </p>
    <p>
        <small><strong>Участники:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
    </p>
</div>
</div>