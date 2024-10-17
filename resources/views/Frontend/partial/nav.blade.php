<div class="container">
    <!-- responsive-nav -->
    <div id="responsive-nav">
        <!-- NAV -->
        <ul class="main-nav nav navbar-nav">
		<li><a href="{{ route('home') }}">Home</a></li>
            @foreach($categories as $category)
                <li><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        <!-- /NAV -->
    </div>
    <!-- /responsive-nav -->
</div>