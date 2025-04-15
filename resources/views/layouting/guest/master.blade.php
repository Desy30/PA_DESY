<!DOCTYPE html>
<html>
<head>
    @include('layouting.guest._partials.headers')
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="assets\guest\vendors\images\Peron.png" alt="" width="8" height="8"></div>

			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	@include('layouting.guest._partials.navbar')

	@include('layouting.guest._partials.sidebar')

	<div class="main-container">
		@yield('content')
	</div>

    @include('layouting.guest._partials.scripts')
</body>
</html>
