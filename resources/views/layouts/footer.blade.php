<div class="app-footer" >
	<div class="footer-bottom d-flex flex-column flex-sm-row align-items-center">
		COPYRIGHT &copy; {{ env('APP_YEAR_CREATED') }} {{ env('APP_COMPANY') }}, All rights Reserved , Version {{ env('APP_VERSION') }}
		<span class="flex-grow-1"></span>
		<div class="d-flex align-items-center">
			<img class="logo" src="../../dist-assets/images/logo.png" alt="">
			<div>
				<p class="m-0">Server proccess time: {{ number_format((microtime(true) - LARAVEL_START), 3) }} secs.</p>
			</div>
		</div>
	</div>
</div>