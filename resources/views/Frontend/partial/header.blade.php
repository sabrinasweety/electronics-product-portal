<!-- TOP HEADER -->
 
<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +088-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> electro@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Uttara, Dhaka</a></li>
					</ul>
			<ul class="header-links pull-right">
				@guest
					<!-- If user is not logged in -->
					<li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> Sign Up</a></li>
					<li><a href="{{ route('user.login') }}"><i class="fa fa-user-o"></i> Login</a></li>
					@endguest

					@auth
					<!-- If user is logged in, show dropdown with name, email, and logout -->
					<li class="nav-item topbar-user dropdown hidden-caret">
						<a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false" 
						style="background-color:black;">
							<span class="op-7"><i class="fa fa-user"></i> Hi,</span>
							<span class="fw-bold">{{ Auth::user()->name }}</span>
						</a>
						<!-- Dropdown menu styling -->
						<ul class="dropdown-menu dropdown-user animated fadeIn" 
							style="background-color:white; 
								border: 1px solid #ff7f7f; 
								border-radius: 4px; 
								width: 300px; /* Increase the width */
								padding: 20px; /* Add padding */
								box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
								right: 0; /* Align dropdown to the right */
								position: absolute; /* Ensure it's positioned relative to the container */
								top: 100%; /* Make sure it appears below the username */
								transform: translateX(50%); /* Move it further to the right */"> 
							<div class="dropdown-user-scroll scrollbar-outer">
								<li>
									<div class="u-text" style="padding-bottom: 15px;"> <!-- Add padding between sections -->
										<h4>{{ Auth::user()->name }}</h4>
										<p class="text-muted">{{ Auth::user()->role }}</p>
										<p class="text-muted">{{ Auth::user()->email }}</p>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<div style="display: flex; justify-content: center;">
										<form id="logout-form" action="{{ route('user.logout') }}" method="POST">
											@csrf
											<button type="submit" class="btn btn-primary">Logout</button>
										</form>
									</div>
								</li>
							</div>
						</ul>
					</li>
					<li><a href="{{route('transaction')}}"><i class="fa fa-dollar"></i> Transaction</a></li>
				@endauth
			</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
    <div class="header-search">
        <form action="{{ route('search.results') }}" method="GET">
            <select name="category" class="input-select">
                <option value="0">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input name="query" class="input" placeholder="Search here">
            <button class="search-btn" type="submit">Search</button>
        </form>
    </div>
</div>

						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								
								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{ count(session()->get('cart', [])) }}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@php
												$cart = session()->get('cart', []);
												$subtotal = 0; // Initialize subtotal
											@endphp

											@foreach ($cart as $id => $item)
												<div class="product-widget">
													<div class="product-img">
													<img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">

													</div>
													<div class="product-body">
														<h3 class="product-name"><a href="#">{{ $item['name'] }}</a></h3>
														<h4 class="product-price"><span class="qty">{{ $item['quantity'] }}x</span>${{ number_format($item['price'], 2) }}</h4>
													</div>
													<button class="delete" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $id }}').submit();"><i class="fa fa-close"></i></button>

													<!-- Form to handle removal -->
													<form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="GET" style="display: none;">
														@csrf
													</form>
												</div>
												@php
													$subtotal += $item['price'] * $item['quantity']; // Calculate subtotal
												@endphp
											@endforeach
										</div>
										<div class="cart-summary">
											<small>{{ count($cart) }} Item(s) selected</small>
											<h5>SUBTOTAL: ${{ number_format($subtotal, 2) }}</h5>
										</div>
										<div class="cart-btns">
											<a href="{{ route('cart.view') }}">View Cart</a>
											<a href="{{route('checkout')}}">Checkout <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>

								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->