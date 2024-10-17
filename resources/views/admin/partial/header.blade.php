<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" style="background-color: #E6E6FA;" >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form  p-0 d-none d-lg-flex" >
                
                <h1 style=" color: #c9addc;background-color:white;font-family:italic;">  Welcome to Electro</h1>
               
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                
                
                

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                    style="background-color:white;"
                  >
                    <div class="avatar-sm">
                      <img
                        src="{{ asset('images/admin-image.jpg') }}"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn" style="background-color:white;border: 1px solid #ff7f7f; border-radius: 4px;">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="{{ asset('images/admin-image.jpg')}}"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->role }}</p>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                           
                          </div>
                        </div>
                      </li>
                      <li>
                      
                        

                        <div class="dropdown-divider"></div>
                        <div style="display: flex; justify-content: center;">

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          

                            @csrf
                            <button type="submit"class="btn btn-primary">Logout</button>
                        </form>
                        </div>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>