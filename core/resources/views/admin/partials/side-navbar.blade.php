@php
    $lang_code = $currentLang->code;
@endphp

<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-dark-primary">
    <!-- Sidebar -->
    <div class="sidebar pt-0 mt-0">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <a href="{{ route('front.index') }}" class="name text-gray-900" target="_blank">
                <img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
            </a>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="flex flex-wrap list-none pl-0 mb-0  nav-sidebar flex-col " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="">
                    <a href=""
                       class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Gestion commercial') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item 
                @if(request()->routeIs('admin.tickets.index')) menu-open
                @endif">
                    <a href="{{ route('admin.tickets.index') }}"
                       class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                       @if(request()->routeIs('admin.tickets.index')) active
                       @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>{{ __('Gestion Tickets') }}</p>
                    </a>
                </li>
                <li class="">
                    <a href=""
                       class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> {{ __('Gestion Interne') }}</p>
                    </a>
                </li>
                <li class="nav-item has-treeview 
                @if(request()->routeIs('admin.supplier.index')) menu-open
                @elseif(request()->routeIs('admin.register.user')) menu-open
                @elseif(request()->routeIs('admin.profil.index'))  menu-open 
                @elseif(request()->routeIs('admin.register.create')) menu-open
                @elseif(request()->routeIs('register.user.view')) menu-open
                @elseif(request()->routeIs('register.user.package_buy')) menu-open
                @elseif(request()->routeIs('register.user.package_not_buy')) menu-open
                @endif">
                    <a href=""
                       class="nav-link block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                       @if(request()->routeIs('admin.supplier.index')) active
                       @elseif(request()->routeIs('admin.register.user')) active
                       @elseif(request()->routeIs('admin.register.create')) active
                       @elseif(request()->routeIs('register.user.view')) active
                       @elseif(request()->routeIs('register.user.package_buy')) active
                       @elseif(request()->routeIs('register.user.package_not_buy')) active
                       @elseif(request()->routeIs('admin.profil.index')) active 
                       @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Gestion des Comptes') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                    <li class="">
                    <a href="{{ route('supplier.index') }}" class="nav-link
                        @if(request()->routeIs('supplier.index')) active @endif
                        " >
                        <i class="far fa-circle nav-icon"></i>
                        {{ __('Supplier List') }}
                    </a>
                    </li>
                    <li class="">
                    <a href="{{ route('admin.profil.index') }}" class="nav-link
                        @if(request()->routeIs('admin.profil.index')) active @endif
                        " >
                        <i class="far fa-circle nav-icon"></i>
                        {{ __('Admin List') }}
                      </a>
                    </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        {{ __('Customers') }}
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                      <li class="">
                        <a href="{{ route('admin.register.user')}}" class="nav-link
                        @if(request()->routeIs('admin.register.user')) active
                        @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('All Customers') }}</p>
                        </a>
                      </li>
                      <li class="">
                        <a href="{{ route('register.user.create') }}" class="nav-link
                        @if(request()->routeIs('register.user.create')) active @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __("Create Customer") }}</p>
                        </a>
                      </li>
                      <li class="">
                        <a href="{{ route('register.user.package_buy') }}" class="nav-link
                        @if(request()->routeIs('register.user.package_buy')) active @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __("Package Buy") }}</p>
                        </a>
                      </li>
                      <li class="">
                        <a href="{{ route('register.user.package_not_buy') }}" class="nav-link
                        @if(request()->routeIs('register.user.package_not_buy')) active @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __("Package Not Buy") }}</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  </ul>
                  </li>
                <li class="nav-item has-treeview
              @if(request()->path() == 'admin/package/all-order') menu-open
              @elseif(request()->path() == 'admin/package/pending-order') menu-open
              @elseif(request()->path() == 'admin/package/inprogress-order') menu-open
              @elseif(request()->path() == 'admin/package/compleated-order') menu-open
              @elseif(request()->path() == 'admin/package') menu-open
              @elseif(request()->path() == 'admin/package/add') menu-open
              @elseif(request()->is('admin/package/edit/*')) menu-open
              @endif">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/package/all-order') active
                @elseif(request()->path() == 'admin/package/pending-order') active
                @elseif(request()->path() == 'admin/package/inprogress-order') active
                @elseif(request()->path() == 'admin/package/compleated-order') active
                @elseif(request()->path() == 'admin/package') active
                @elseif(request()->path() == 'admin/package/add') active
                @elseif(request()->is('admin/package/edit/*')) active
                @endif">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            {{ __('Package') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                        <li class="">
                            <a href="{{ route('admin.package'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/package') active
                @elseif(request()->path() == 'admin/package/add') active
                @elseif(request()->is('admin/package/edit/*')) active
                @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Packages') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.package.allorder')}}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/package/all-order') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.package.pendingorder') }}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/package/pending-order') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.package.inprogress') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
              @if(request()->path() == 'admin/package/inprogress-order') active
              @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('In Progress Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.package.compleated') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                  @if(request()->path() == 'admin/package/compleated-order') active
                  @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Completed Order') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
        @if(request()->path() == 'admin/product') menu-open
        @elseif(request()->path() == 'admin/product/add') menu-open
        @elseif(request()->path() == 'admin/product/all/orders') menu-open
        @elseif(request()->path() == 'admin/product/pending/orders') menu-open
        @elseif(request()->path() == 'admin/product/processing/orders') menu-open
        @elseif(request()->path() == 'admin/product/completed/orders') menu-open
        @elseif(request()->path() == 'admin/product/rejected/orders') menu-open
        @elseif(request()->is('admin/product/edit/*')) menu-open
        @elseif(request()->is('admin/product/orders/detais/*')) menu-open

        @endif">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
          @if(request()->path() == 'admin/product') active
          @elseif(request()->path() == 'admin/product/add') active
          @elseif(request()->path() == 'admin/product/all/orders') active
          @elseif(request()->path() == 'admin/product/pending/orders') active
          @elseif(request()->path() == 'admin/product/processing/orders') active
          @elseif(request()->path() == 'admin/product/completed/orders') active
          @elseif(request()->path() == 'admin/product/rejected/orders') active
          @elseif(request()->is('admin/product/edit/*')) active
          @elseif(request()->is('admin/product/orders/detais/*')) active
          @endif">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            {{ __('Product') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                        <li class="">
                            <a href="{{ route('admin.product'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
            @if(request()->path() == 'admin/product') active
            @elseif(request()->path() == 'admin/product/add') active
            @elseif(request()->is('admin/product/edit/*')) active
            @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Products') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.all.product.orders')}}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/product/all/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.pending.product.orders') }}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/product/pending/orders') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.processing.product.orders') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
            @if(request()->path() == 'admin/product/processing/orders') active
            @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('In Progress Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.completed.product.orders') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/product/completed/orders') active
                @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Completed Order') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.rejected.product.orders') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/product/rejected/orders') active
                @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Rejected Order') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                @if(request()->path() == 'admin/bill-pay') menu-open
                @elseif(request()->path() == 'admin/add') menu-open
                @elseif(request()->path() == 'admin/bill-add') menu-open
                @endif
                ">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 
                    @if(request()->path() == 'admin/bill-pay') active 
                    @elseif(request()->path() == 'admin/add') active
                    @elseif(request()->path() == 'admin/bill-add') active
                    @endif">
                      <i class="nav-icon fas fa-money-bill"></i>
                      <p>
                        {{ __('Bill Pay') }}
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                      <li class="">
                        <a href="{{ route('admin.billpay')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/bill-pay') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('Bill Pay') }}</p>
                        </a>
                      </li>
                      <li class="">
                        <a href="{{ route('admin.bill_add')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                        @if(request()->path() == 'admin/add') active 
                        @elseif(request()->path() == 'admin/bill-add') active
                        @endif
                            ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('Add New Bill') }}</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="">
                    <a href=""
                       class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Rapport') }}</p>
                    </a>
                </li>
                  <li class="nav-item has-treeview
                  @if(request()->path() == 'admin/slider') menu-open
                  @elseif(request()->path() == 'admin/slider/add') menu-open
                  @elseif(request()->is('admin/slider/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/about') menu-open
                  @elseif(request()->path() == 'admin/about/add') menu-open
                  @elseif(request()->is('admin/about/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/offer') menu-open
                  @elseif(request()->path() == 'admin/offer/add') menu-open
                  @elseif(request()->is('admin/offer/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/funfact')  menu-open
                  @elseif(request()->path() == 'admin/funfact/add') menu-open
                  @elseif(request()->is('admin/funfact/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/service') menu-open
                  @elseif(request()->path() == 'admin/service/add') menu-open
                  @elseif(request()->is('admin/service/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/testimonial') menu-open 
                  @elseif(request()->path() == 'admin/testimonial/add') menu-open 
                  @elseif(request()->is('admin/testimonial/edit/*')) menu-open 
                  @elseif(request()->path() == 'admin/branch') menu-open
                  @elseif(request()->path() == 'admin/branch/add') menu-open
                  @elseif(request()->is('admin/branch/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/team') menu-open
                  @elseif(request()->path() == 'admin/team/add') menu-open
                  @elseif(request()->is('admin/team/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/faq') menu-open
                  @elseif(request()->path() == 'admin/faq/add') menu-open
                  @elseif(request()->is('admin/faq/edit/*')) menu-open
                  @elseif(request()->path() == 'admin/dynamic-page') menu-open
                  @endif">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500  
                        @if(request()->path() == 'admin/slider') active
                        @elseif(request()->path() == 'admin/slider/add') active
                        @elseif(request()->is('admin/slider/edit/*')) active
                        @elseif(request()->path() == 'admin/about') active
                        @elseif(request()->path() == 'admin/about/add') active
                        @elseif(request()->is('admin/about/edit/*')) active
                        @elseif(request()->path() == 'admin/offer') active
                        @elseif(request()->path() == 'admin/offer/add') active
                        @elseif(request()->is('admin/offer/edit/*')) active
                        @elseif(request()->path() == 'admin/funfact') active
                        @elseif(request()->path() == 'admin/funfact/add') active
                        @elseif(request()->is('admin/funfact/edit/*')) active
                        @elseif(request()->path() == 'admin/service') active
                        @elseif(request()->path() == 'admin/service/add') active
                        @elseif(request()->is('admin/service/edit/*')) active
                        @elseif(request()->path() == 'admin/testimonial') active 
                        @elseif(request()->path() == 'admin/testimonial/add') active 
                        @elseif(request()->is('admin/testimonial/edit/*')) active 
                        @elseif(request()->path() == 'admin/branch') active
                        @elseif(request()->path() == 'admin/branch/add') active
                        @elseif(request()->is('admin/branch/edit/*')) active
                        @elseif(request()->path() == 'admin/team') active
                        @elseif(request()->path() == 'admin/team/add') active
                        @elseif(request()->is('admin/team/edit/*')) active
                        @elseif(request()->path() == 'admin/faq') active
                        @elseif(request()->path() == 'admin/faq/add') active
                        @elseif(request()->is('admin/faq/edit/*')) active
                        @elseif(request()->path() == 'admin/dynamic-page') active
                        @endif">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                          {{ __('Pages') }}
                          <i class="fas fa-angle-left right"></i>
                        </p> 
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                        <li class="">
                            <a href="{{ route('admin.slider'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/slider') active
                    @elseif(request()->path() == 'admin/slider/add') active
                    @elseif(request()->is('admin/slider/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>
                                    {{ __('Slider') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.about'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/about') active
                    @elseif(request()->path() == 'admin/about/add') active
                    @elseif(request()->is('admin/about/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{ __('About') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.offer'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/offer') active
                    @elseif(request()->path() == 'admin/offer/add') active
                    @elseif(request()->is('admin/offer/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    {{ __('Offer') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.funfact'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/funfact') active
                    @elseif(request()->path() == 'admin/funfact/add') active
                    @elseif(request()->is('admin/funfact/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-smile-beam"></i>
                                <p>
                                    {{ __('Funfact') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.service'). '?language=' . $lang_code  }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/service') active
                    @elseif(request()->path() == 'admin/service/add') active
                    @elseif(request()->is('admin/service/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    {{ __('Service') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.testimonial'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                            @if(request()->path() == 'admin/testimonial') active 
                            @elseif(request()->path() == 'admin/testimonial/add') active 
                            @elseif(request()->is('admin/testimonial/edit/*')) active 
                            @endif">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    {{ __('Testimonial') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.branch'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/branch') active
                    @elseif(request()->path() == 'admin/branch/add') active
                    @elseif(request()->is('admin/branch/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>
                                    {{ __('Branch') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.team'). '?language=' . $lang_code}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/team') active
                    @elseif(request()->path() == 'admin/team/add') active
                    @elseif(request()->is('admin/team/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{ __('Team') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.faq'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/faq') active
                    @elseif(request()->path() == 'admin/faq/add') active
                    @elseif(request()->is('admin/faq/edit/*')) active
                    @endif">
                                <i class="nav-icon fas fa-question-circle"></i>
                                <p>
                                    {{ __('Faq') }}
                                </p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.dynamic_page'). '?language=' . $lang_code }}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/dynamic-page') active @endif">
        
                                <i class="nav-icon  fab fa-sith"></i>
                                <p>
                                    {{ __('Dynamic Page') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                  </li>
               

   
               
                <li class="nav-item has-treeview
                    @if(request()->path() == 'admin/entertainment') menu-open
                    @elseif(request()->is('admin/entertainment/edit/*')) menu-open
                    @elseif(request()->path() == 'admin/media') menu-open
                    @elseif(request()->is('admin/media/edit/*')) menu-open
                    @endif">
                            <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                        @if(request()->path() == 'admin/entertainment') active
                        @elseif(request()->is('admin/entertainment/edit/*')) active
                        @elseif(request()->path() == 'admin/media') active
                        @elseif(request()->is('admin/media/edit/*')) active
                        @endif">
                        <i class="nav-icon fas fas fa-photo-video"></i>
                        <p>
                            {{ __('Media') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">

                        <li class="">
                            <a href="{{ route('admin.entertainment'). '?language=' . $lang_code  }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/entertainment') active
                    @elseif(request()->path() == 'admin/entertainment/add') active
                    @elseif(request()->is('admin/entertainment/edit/*')) active
                    @endif
                                    ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Entertainment') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.media'). '?language=' . $lang_code  }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/media') active
                    @elseif(request()->path() == 'admin/media/add') active
                    @elseif(request()->is('admin/media/edit/*')) active
                    @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Media Zone') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
              
                <li class="nav-item has-treeview
              @if(request()->path() == 'admin/blog') menu-open
              @elseif(request()->path() == 'admin/blog/blog-category') menu-open
              @elseif(request()->path() == 'admin/blog/blog-category/add') menu-open
              @elseif(request()->path() == 'admin/blog/add') menu-open
              @elseif(request()->path() == 'admin/archives') menu-open
              @elseif(request()->path() == 'admin/archive/edit') menu-open
              @elseif(request()->path() == 'admin/archive/add') menu-open
              @elseif(request()->is('admin/blog/blog-category/edit/*')) menu-open
              @elseif(request()->is('admin/blog/edit/*')) menu-open
              @endif">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/blog') active
                @elseif(request()->path() == 'admin/blog/blog-category') active
                @elseif(request()->path() == 'admin/blog/blog-category/add') active
                @elseif(request()->path() == 'admin/blog/add') active
                @elseif(request()->path() == 'admin/archives') active
                @elseif(request()->path() == 'admin/archive/edit') active
                @elseif(request()->path() == 'admin/archive/add') active
                @elseif(request()->is('admin/blog/blog-category/edit/*')) active
                @elseif(request()->is('admin/blog/edit/*')) active
                @endif">
                        <i class="nav-icon fab fa-blogger-b"></i>
                        <p>
                            {{ __('Blog') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                        <li class="">
                            <a href="{{ route('admin.bcategory'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                  @if(request()->path() == 'admin/blog/blog-category') active 
                  @elseif(request()->path() == 'admin/blog/blog-category/add') active
                  @elseif(request()->is('admin/blog/blog-category/edit/*')) active 
                  @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Blog Categories') }}</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.blog'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                  @if(request()->path() == 'admin/blog') active 
                  @elseif(request()->path() == 'admin/blog/add') active
                  @elseif(request()->is('admin/blog/edit/*')) active
                  @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Blog') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                    @if(request()->path() == 'admin/subscriber') menu-open 
                    @elseif(request()->path() == 'admin/subscriber/add') menu-open
                    @elseif(request()->path() == 'admin/mailsubscriber') menu-open
                    @endif
                        ">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/subscriber') active 
                    @elseif(request()->path() == 'admin/subscriber/add') active
                    @elseif(request()->path() == 'admin/mailsubscriber') active
                    @endif
                    ">
                      <i class="nav-icon fas fa-envelope-open-text"></i>
                      <p>
                        {{ __('Subscribers') }}
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                      <li class="">
                        <a href="{{ route('admin.newsletter')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                        @if(request()->path() == 'admin/subscriber') active 
                        @elseif(request()->path() == 'admin/subscriber/add') active
                        @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('Subscribers') }}</p>
                        </a>
                      </li>
                      <li class="">
                        <a href="{{route('admin.mailsubscriber')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                        @if(request()->path() == 'admin/mailsubscriber') active @endif
                        ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('Mail to Subscribers') }}</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                <li class="nav-item has-treeview
                @if(request()->path() == 'admin/basicinfo') menu-open
                @elseif(request()->path() == 'admin/seoinfo') menu-open
                @elseif(request()->path() == 'admin/custom-css') menu-open
                @elseif(request()->path() == 'admin/footer') menu-open
                @elseif(request()->path() == 'admin/slinks') menu-open
                @elseif(request()->path() == 'admin/email-config') menu-open
                @elseif(request()->path() == 'admin/scripts') menu-open
                @elseif(request()->path() == 'admin/cookie-alert') menu-open
                @elseif(request()->path() == 'admin/page-visibility') menu-open
                @elseif(request()->is('admin/slinks/edit/*')) menu-open
                @endif">
                      <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                  @if(request()->path() == 'admin/basicinfo') active
                  @elseif(request()->path() == 'admin/seoinfo') active
                  @elseif(request()->path() == 'admin/custom-css') active
                  @elseif(request()->path() == 'admin/footer') active
                  @elseif(request()->path() == 'admin/slinks') active
                  @elseif(request()->path() == 'admin/scripts') active
                  @elseif(request()->path() == 'admin/cookie-alert') active
                  @elseif(request()->path() == 'admin/email-config') active
                  @elseif(request()->path() == 'admin/page-visibility') active
                  @elseif(request()->is('admin/slinks/edit/*')) active
                  @endif">
                          <i class="nav-icon fas fas fa-cog"></i>
                          <p>
                              {{ __('General Setting') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
  
                          <li class="">
                              <a href="{{ route('admin.basicinfo'). '?language=' . $lang_code }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/basicinfo') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Basic Information') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.mail.config') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                @if(request()->path() == 'admin/email-config') active
                @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Email Configuration') }}</p>
                              </a>
                          </li>
                          <li class="">
                            <a href="{{ route('admin.footer.index'). '?language=' . $lang_code }}"
                               class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/footer') active @endif">
                               <i class="far fa-circle nav-icon"></i>
                               <p>
                                    {{ __('Footer') }}
                                </p>
                            </a>
                        </li>
                          <li class="">
                              <a href="{{ route('admin.slinks') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
                    @if(request()->path() == 'admin/slinks') active
                    @elseif(request()->is('admin/slinks/edit/*')) active
                      @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Social Links') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.seoinfo'). '?language=' . $lang_code }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/seoinfo') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('SEO Information') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.scripts') }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500 @if(request()->path() == 'admin/scripts') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Scripts') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.pagevisibility') }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500  @if(request()->path() == 'admin/page-visibility') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Pages Visibility') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.cookie.alert'). '?language=' . $lang_code }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500  @if(request()->path() == 'admin/cookie-alert') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Cookie Alert') }}</p>
                              </a>
                          </li>
                          <li class="">
                              <a href="{{ route('admin.custom.css') }}"
                                 class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500  @if(request()->path() == 'admin/custom-css') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('Custom CSS') }}</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                <li class="nav-item has-treeview
          @if(request()->path() == 'admin/payment/gateways') menu-open
          @elseif(request()->path() == 'admin/shipping/methods') menu-open
          @elseif(request()->path() == 'admin/shipping/method/add') menu-open
          @elseif(request()->is('admin/shipping/method/edit/*')) menu-open
          @elseif(request()->is('admin/payment/gateways/edit/*')) menu-open

          @endif">
                    <a href="#" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
            @if(request()->path() == 'admin/payment/gateways') active
            @elseif(request()->path() == 'admin/shipping/methods') active
            @elseif(request()->path() == 'admin/shipping/method/add') active
            @elseif(request()->is('admin/shipping/method/edit/*')) active
            @elseif(request()->is('admin/payment/gateways/edit/*')) active

            @endif">
                        <i class="nav-icon fab fa-blogger-b"></i>
                        <p>
                            {{ __('Payment Settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="flex flex-wrap list-none pl-0 mb-0 nav-treeview">
                        <li class="">
                            <a href="{{ route('admin.payment.index') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
              @if(request()->path() == 'admin/payment/gateways') active
              @elseif(request()->is('admin/payment/gateways/edit/*')) active
              @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Payment Gateway') }}</p>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ route('admin.shipping.index'). '?language=' . $lang_code }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
              @if(request()->path() == 'admin/shipping/methods') active
              @elseif(request()->path() == 'admin/shipping/method/add') active
              @elseif(request()->is('admin/shipping/method/edit/*')) active
              @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Shipping Method') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="">
                    <a href="{{route('admin.language.index')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500
            @if(request()->path() == 'admin/languages') active
            @elseif(request()->path() == 'admin/language/add') active
            @elseif(request()->is('admin/language/21/edit')) active
            @elseif(request()->is('admin/language/*/edit/keyword')) active
            @endif">
                        <i class="nav-icon fas fa-language"></i>
                        <p>
                            {{ __('Language') }}
                        </p>
                    </a>
                </li>
                {{--        <li class="">--}}
                {{--          <a href="{{route('admin.backup.index')}}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500--}}

                {{--           @if(request()->path() == 'admin/backup') active--}}
                {{--           @endif--}}
                {{--          ">--}}
                {{--            <i class="nav-icon fas fa-cloud-download-alt"></i>--}}
                {{--            <p>--}}
                {{--              {{ __('Backup') }}--}}
                {{--            </p>--}}
                {{--          </a>--}}
                {{--        </li>--}}
                <li class="">
                    <a href="{{ route('admin.cache.clear') }}" class="nav-link block py-2 md:py-3 pl-1 align-middle hover:bg-purple-700 text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                        <i class="nav-icon fas fa-broom"></i>
                        <p>
                            {{ __('Clear Cache') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>