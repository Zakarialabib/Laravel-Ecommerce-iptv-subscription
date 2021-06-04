<nav class="main-header relative flex flex-wrap items-center py-3 px-4 flex-no-wrap content-start text-black navbar-white">
    <!-- Left navbar links -->
    <ul class="flex flex-wrap list-reset pl-0 mb-0">
      <li class="">
        <a class="inline-block py-2 px-4 no-underline" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="dropdown nav-item">
        <a class="nav-link inline-block py-2 px-4 no-underline pt-0 pr-3 " data-toggle="dropdown" href="#">
            <img class="user-image w-40 img-circle shadow" src="{{ asset('assets/front/img/'.$adminprofile->image) }}"  alt="User Image">
        </a>
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-none">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 card-widget widget-user-2 mb-0 shadow-none">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue-600">
                  <div class="widget-user-image bg-white">
                    <img class="img-circle elevation-2  bg-white" src="{{ asset('assets/front/img/'.$adminprofile->image) }}" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h6 class="widget-user-username mt-2">{{ $adminprofile->name }}</h6>
                  <h6 class="widget-user-desc">{{ $adminprofile->email }}</h6>
                </div>
                <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300 p-0 bg-white">
                  <ul class="flex flex-wrap list-none pl-0 mb-0 flex-col">
                    <li class="">
                      <a href="{{ route('admin.editProfile') }}" class="inline-block py-2 px-4 no-underline">
                          <i class="fas fa-edit mr-1"></i> {{ __('Edit Profile') }} 
                      </a>
                    </li>
                    <li class="">
                      <a href="{{ route('admin.editPassword') }}" class="inline-block py-2 px-4 no-underline">
                          <i class="fas fa-unlock-alt mr-1"></i> {{ __('Change Password') }}
                      </a>
                    </li>
                    <li class="">
                      <a href="{{route('admin.logout')}}" class="inline-block py-2 px-4 no-underline">
                          <i class="fas fa-sign-out-alt mr-1"></i> {{ __('Logout') }}
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
        </div>
      </li>
    </ul>
  </nav>