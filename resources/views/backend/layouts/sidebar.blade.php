 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     <div class="navbar-brand-box">
         <a href="javascript(void)" target="_blank" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="{{ asset('backend') }}/assets/images/pixcafe.png" alt="" height="22">
             </span>
             <span class="logo-lg text-white">
                 <img src="{{ asset('backend') }}/assets/images/pixcafe.png" alt="" height="45">
                 <span class="ms-1">{{ config('starter.LOGO_TEXT') }}</span>
             </span>
         </a>
         <a href="javascript(void)" target="_blank" class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('backend') }}/assets/images/pixcafe.png" alt="" height="22">
             </span>
             <span class="logo-lg text-white">
                 <img src="{{ asset('backend') }}/assets/images/pixcafe.png" alt="" height="45">
                 <span class="ms-1">{{ config('starter.LOGO_TEXT') }}</span>
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover shadow-none"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>
             <ul class="navbar-nav" id="navbar-nav">

                 <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <x-nav-item title="Dashboard" icon="ti ti-brand-google-home" :url="route('dashboard.index')" :active="request()->routeIs('dashboard.index')" />

                 <!-- Artist -->
                    <x-nav-dropdown id="artist" title="Artist" :active="request()->routeIs('artist.*')" icon="ri-function-line">
                        <x-nav-item title="View All" icon="" :url="route('artists.index')" :active="request()->routeIs('artists.index')" />
                        {{-- <x-nav-item title="Add New" icon="" :url="route('artists.create')" :active="request()->routeIs('artists.create')" /> --}}
                    </x-nav-dropdown>

                 <!-- Category -->
                 {{-- <x-nav-dropdown id="category" title="Category" :active="request()->routeIs('category.*')" icon="ri-function-line">
                     <x-nav-item title="View All" icon="" :url="route('category.index')" :active="request()->routeIs('category.index')" />
                     <x-nav-item title="Add New" icon="" :url="route('category.create')" :active="request()->routeIs('category.create')" />
                 </x-nav-dropdown>

                 <!-- Slider -->
                 <x-nav-dropdown id="slider" title="Slider" :active="request()->routeIs('slider.*')" icon="ri-function-line">
                     <x-nav-item title="View All" icon="" :url="route('slider.index')" :active="request()->routeIs('slider.index')" />
                     <x-nav-item title="Add New" icon="" :url="route('slider.create')" :active="request()->routeIs('slider.create')" />
                 </x-nav-dropdown>

                 <!-- Product -->
                 <x-nav-dropdown id="product" title="Product" :active="request()->routeIs('product.*')" icon="ri-function-line">
                     <x-nav-item title="View All" icon="" :url="route('product.index')" :active="request()->routeIs('product.index')" />
                     <x-nav-item title="Add New" icon="" :url="route('product.create')" :active="request()->routeIs('product.create')" />
                 </x-nav-dropdown> --}}



                 <!-- Menu -->

                 <!-- Page -->
                 {{-- <x-nav-dropdown id="Page" title="Page" :active="request()->routeIs('page.*')" icon=" ti ti-brand-adobe ">
                     <x-nav-item title="View All" icon="" :url="route('page.index')" :active="request()->routeIs('page.index')" />
                     <x-nav-item title="Add New" icon="" :url="route('page.create')" :active="request()->routeIs('page.create')" />
                 </x-nav-dropdown> --}}




             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
 <!-- Left Sidebar End -->
