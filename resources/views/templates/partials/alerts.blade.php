@if(session('info'))
	<div class="alert alert-info fade in" role="alert">
		{{ session('info') }}<button class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    </div>
@endif