@extends('frontend.master')

@section('content')


        <!-- Flash messages for errors or success -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<div class="section">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <!-- Display category image here -->
                        <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}">
                    </div>
                    <div class="shop-body">
                        <h3>{{ $category->name }}<br>Collection</h3>
                        <!-- Link to category products page -->
                        <a href="{{ route('category.products', $category->id) }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
		

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
            <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <!-- All New Products Tab -->
                            <li class="active">
                                <a data-toggle="tab" href="#all-new-products">All New Products</a>
                            </li>
                            @foreach ($categories as $index => $category)
                                <li>
                                    <a data-toggle="tab" href="#tab{{ $index + 1 }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- All New Products Tab Content -->
                <div class="tab-pane fade in active" id="all-new-products">
                    <div class="row">
                        @foreach ($newProducts as $product)
                            <div class="col-md-4">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                        <div class="product-label">
                                            @if($product->discount)
                                                <span class="sale">-{{ $product->discount }}%</span>
                                            @endif
                                            @if($product->created_at->diffInDays(now()) <= 30)
                                                <span class="new">NEW</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name }}</p>
                                        <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                        <h4 class="product-price">${{ $product->price }}</h4>
                                         <!-- Add View Product Button -->
                                        <a href="{{ route('product.view', $product->id) }}" class="btn btn-info" style="background-color:#7a2210 ; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                        View Product
                                    </a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="background-color: black; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                            Add to Cart
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @foreach ($categories as $index => $category)
                    <div class="tab-pane fade" id="tab{{ $index + 1 }}">
                        <div class="row">
                            @foreach ($newProducts as $product)
                                @if ($product->category_id == $category->id)
                                    <div class="col-md-4">
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                                <div class="product-label">
                                                    @if($product->discount)
                                                        <span class="sale">-{{ $product->discount }}%</span>
                                                    @endif
                                                    @if($product->created_at->diffInDays(now()) <= 30)
                                                        <span class="new">NEW</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category->name }}</p>
                                                <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                                <h4 class="product-price">${{ $product->price }}</h4>
												<a href="{{ route('product.view', $product->id) }}" class="btn btn-info" style="background-color: #3498db; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                                    View Product
                                                </a>

                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary" style="background-color: #5cb85c; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /tab content -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<style>
.product-img img {

width: 200px;

height: 200px;

object-fit: cover;

}
</style>
<!-- /SECTION -->



		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
<!-- section title -->
<div class="col-md-12">
    <div class="section-title">
        <h3 class="title">Top Selling</h3>
        <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab-all">All Top Selling Products</a></li>
                @foreach($categories as $category)
                    <li><a data-toggle="tab" href="#tab-{{ $category->id }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Products tab & slick -->
<div class="col-md-12">
    <div class="row">
        <div class="products-tabs">
            <div id="tab-all" class="tab-pane fade in active">
                <div class="products-slick" data-nav="#slick-nav-all">
                    @foreach($allTopSellingProducts as $product)
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-label">
                                    @if($product->discount)
                                        <span class="sale">-{{ $product->discount }}%</span>
                                    @endif
                                    @if($product->is_new)
                                        <span class="new">NEW</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $product->category->name }}</p>
                                <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                <h4 class="product-price">${{ $product->price }}</h4>
                                <p class="card-text">Sold Quantity: {{ $product->total_sold }}</p>
								<a href="{{ route('product.view', $product->id) }}" class="btn btn-info" style="background-color:#7a2210 ; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                        View Product
                                    </a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="background-color: black; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                            Add to Cart
                                        </button>
                                    </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="slick-nav-all" class="products-slick-nav"></div>
            </div>

            @foreach($categories as $category)
                <div id="tab-{{ $category->id }}" class="tab-pane fade">
                    <div class="products-slick" data-nav="#slick-nav-{{ $category->id }}">
                        @foreach($topSellingProductsByCategory[$category->id] as $product)
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                    <div class="product-label">
                                        
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $product->category->name }}</p>
                                    <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                    <h4 class="product-price">${{ $product->price }}</h4>
                                    <p class="card-text">Sold Quantity: {{ $product->total_sold }}</p>
									<a href="{{ route('product.view', $product->id) }}" class="btn btn-info" style="background-color:#7a2210 ; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                        View Product
                                    </a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="background-color: black; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="slick-nav-{{ $category->id }}" class="products-slick-nav"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>

		<!-- SECTION -->
		
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
	<!-- resources/views/newsletter.blade.php -->

<div id="newsletter" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                   

                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>

					@if(Auth::check())
    <form action="{{ route('subscribe') }}" method="POST">
        @csrf
        <input class="input" type="email" name="email" value="{{ Auth::user()->email }}" readonly>
        <button class="newsletter-btn" type="submit"><i class="fa fa-envelope"></i> Subscribe</button>

        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </form>
@else
    <form>
        <input class="input" type="email" placeholder="Enter your email" readonly>
        <button class="newsletter-btn" disabled><i class="fa fa-envelope"></i> Subscribe</button>
        <p>Please <a href="{{ route('user.login') }}">login</a> to subscribe to the newsletter.</p>
    </form>
@endif
                    <ul class="newsletter-follow">
                        <li>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                        </li>
                        
                        <li>
                            <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

        @endsection