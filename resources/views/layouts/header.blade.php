<header class="main-header bg-white d-flex justify-content-between p-2">
	<div class="header-toggle">
		<div class="menu-toggle mobile-menu-icon">
			<div></div>
			<div></div>
			<div></div>
		</div>
		{{-- <i class="i-Add-UserStar mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo"></i>
		<i class="i-Speach-Bubble-3 mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"></i>
		<i class="i-Email mr-3 text-20 mobile-hide cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inbox"></i>
		<i class="i-Calendar-4 mr-3 mobile-hide text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar"></i>
		<i class="i-Checkout-Basket mobile-hide mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar"></i> --}}
	</div>
	<div class="header-part-right">
		<!-- Full screen toggle-->
		<i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
		<!-- Grid menu Dropdown-->
		<div class="dropdown dropleft">
			<i class="text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="{{ asset(Auth::user()->filename) }}"
					 onerror="this.src='{{ asset('app-assets/images/avatars/default.png')}}';" 
					 alt="avatar" height="40" width="40" 
					 class="rounded-circle">
			</i>
			
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<div class="menu-icon-grid">
					<a href="{{ route('user.profile') }}"><i class="i-Shop-4"></i> Profile</a>
					<a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
						<i class="i-Power-2"></i> Logout
					</a>
				</div>
			</div>
		</div>
	</div>
</header>