<div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" style="background-color: black">
            <a href="index.html" class="logo">
              <img
                src="http://127.0.0.1:8000/img/logo.png"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar" style="background-color:dark;">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a
                  
                  href="{{route('dashboard')}}"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              
              <li class="nav-item">
                <a  href="{{route('admin.categories')}}">
                  <i class="fas fa-layer-group"></i>
                  <p>Categories</p>
                  <span class="caret"></span>
                </a>
              </li>
              <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#categoriesDropdown">
                        <i class="fas fa-th-large"></i>
                        <p>Products Under Categories</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="categoriesDropdown">
                        <ul class="nav nav-collapse">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('productundercategory', $category->id) }}">
                                        <span class="sub-item">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
               </li>


              <li class="nav-item">
                  <a href="{{ route('admin.products') }}">
                      <i class="fas fa-box-open"></i>
                      <p>Products</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.transactions') }}">
                      <i class="fas fa-money-bill-wave"></i> <!-- Use an appropriate icon -->
                      <p>Transaction History</p>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('admin.orders') }}">
                      <i class="fas fa-shopping-cart"></i>
                      <p>Orders</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.user') }}">
                      <i class="fas fa-users"></i>
                      <p>Registered User</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.subscriber') }}">
                      <i class="fas fa-bell"></i>
                      <p>Subscribers</p>
                  </a>
              </li>    
              
            </ul>
          </div>
        </div>