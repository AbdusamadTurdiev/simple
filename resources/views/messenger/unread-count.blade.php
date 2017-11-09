<?php $count = Auth::user()->newThreadsCount(); ?>
@if($count > 0)
    <span class="badge">{{ $count }}</span>
@endif
