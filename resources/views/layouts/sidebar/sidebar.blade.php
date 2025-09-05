<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="#">
                        <img src="{{ asset('/src/assets/img/logo.svg') }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="">City Tour</a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class=""></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="{{ request()->is('dashboard') ? 'menu active' : 'menu' }}">
                <a href="{{ route('dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="{{ request()->routeIs('users.list', 'delete_user.list', 'user.reports', 'view.report.details', 'user-purchase-history') ? 'menu active' : 'menu' }}">
                <a href="#user" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('users.list', 'delete_user.list', 'user.reports', 'view.report.details', 'user-purchase-history') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="user" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('users/users_list') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('users.list') }}"
                            aria-expanded="{{ request()->is('users/users_list') ? 'true' : 'false' }}">
                            All Users</a>
                    </li>
                    <li class="{{ request()->is('users/account_delete_users') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('delete_user.list') }}"
                            aria-expanded="{{ request()->is('users/account_delete_users') ? 'true' : 'false' }}">
                            Delete Account Users</a>
                    </li>

                    <li class="{{ request()->is('users/reports') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('user.reports') }}"
                            aria-expanded="{{ request()->is('users/reports') ? 'true' : 'false' }}">
                            User Reports</a>
                    </li>

                </ul>
            </li>

            <li class="{{ request()->is('country') ? 'menu active' : 'menu' }}">
                <a href="{{ route('country.list') }}" aria-expanded="false" class="dropdown-toggle">

                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-globe">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                        {{-- <img src="{{asset("/src/assets/img/icons/country.png")}}" alt="" height="20" width="20"> --}}
                        <span>Country</span>
                    </div>
                </a>
            </li>

            <li class="{{ request()->is('state') ? 'menu active' : 'menu' }}">
                <a href="{{ route('state.list') }}" aria-expanded="false" class="dropdown-toggle">

                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-book">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        <span>State</span>
                    </div>
                </a>
            </li>

            <li class="{{ request()->is('cities') ? 'menu active' : 'menu' }}">
                <a href="{{ route('city.list') }}" aria-expanded="false" class="dropdown-toggle">

                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-target">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                        <span>City</span>
                    </div>
                </a>
            </li>

            <li
                class="{{ request()->routeIs('tour_place.list', 'tour.article', 'view.details') ? 'menu active' : 'menu' }}">
                <a href="#tour" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('tour_place.list', 'tour.article', 'view.details') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-map-pin">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>Tour</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="tour" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('tour_places') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('tour_place.list') }}"
                            aria-expanded="{{ request()->is('tour_places') ? 'true' : 'false' }}">
                            Tour Places</a>
                    </li>

                    <li class="{{ request()->is('tour_related_article') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('tour.article') }}"
                            aria-expanded="{{ request()->is('tour_related_article') ? 'true' : 'false' }}">
                            Tour Articles</a>
                    </li>
                </ul>
            </li>

            <li
                class="{{ request()->routeIs('banner.introbanner.list', 'banner.topbottom.list', 'banner.detail') ? 'menu active' : 'menu' }}">
                <a href="#invoice" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('banner.introbanner.list', 'banner.topbottom.list', 'banner.detail') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-layout">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                            </rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                        <span>Banner</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="invoice" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('banner/intro_banner') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('banner.introbanner.list') }}"
                            aria-expanded="{{ request()->is('banner/intro_banner') ? 'true' : 'false' }}">Intro
                            Banner</a>
                    </li>

                    <li class="{{ request()->is('banner/top_bottom_banner') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('banner.topbottom.list') }}"
                            aria-expanded="{{ request()->is('banner/top_bottom_banner') ? 'true' : 'false' }}">Top &
                            Bottom Banner</a>
                    </li>
                </ul>
            </li>

            <li
                class="{{ request()->routeIs('resource.city.detail', 'resource.tour.detail') ? 'menu active' : 'menu' }}">
                <a href="#invoice1" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('resource.city.detail', 'resource.tour.detail') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                        <span>Resources</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="invoice1" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('resource/city_resource') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('resource.city.detail') }}"
                            aria-expanded="{{ request()->is('resource.city.detail') ? 'true' : 'false' }}">City
                            resource</a>
                    </li>

                    <li class="{{ request()->is('resource/tour_resource') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('resource.tour.detail') }}"
                            aria-expanded="{{ request()->is('resource.tour.detail') ? 'true' : 'false' }}">Tour
                            Resource</a>
                    </li>
                </ul>
            </li>

            <li
                class="{{ request()->routeIs('review.detail', 'map.icon.detail', 'currency.type.detail', 'audio.type.detail') ? 'menu active' : 'menu' }}">
                <a href="#controals" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('review.detail', 'map.icon.detail', 'currency.type.detail', 'audio.type.detail') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-toggle-right">
                            <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                            <circle cx="16" cy="12" r="3"></circle>
                        </svg>
                        <span>Controls</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="controals" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('reviews') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('review.detail') }}"
                            aria-expanded="{{ request()->is('review.detail') ? 'true' : 'false' }}">Reviews</a>
                    </li>

                    <li class="{{ request()->is('map_icons') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('map.icon.detail') }}"
                            aria-expanded="{{ request()->is('map.icon.detail') ? 'true' : 'false' }}">Map Icons</a>
                    </li>

                    <li class="{{ request()->is('currency_type') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('currency.type.detail') }}"
                            aria-expanded="{{ request()->is('currency.type.detail') ? 'true' : 'false' }}">Currency
                            Type</a>
                    </li>

                    <li class="{{ request()->is('audio_type') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('audio.type.detail') }}"
                            aria-expanded="{{ request()->is('audio.type.detail') ? 'true' : 'false' }}">Audio
                            Language</a>
                    </li>
                </ul>
            </li>

            <li
                class="{{ request()->routeIs('promocode.tour.promocode', 'promocode.user.promocode') ? 'menu active' : 'menu' }}">
                <a href="#promocode" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('promocode.tour.promocode', 'promocode.user.promocode') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-layers">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span>Promo Code</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="promocode" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('promocode.tour.promocode') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('promocode.tour.promocode') }}"
                            aria-expanded="{{ request()->is('promocode.tour.promocode') ? 'true' : 'false' }}">Tour
                            Promo Code</a>
                    </li>
                </ul>
                <ul class="collapse submenu list-unstyled" id="promocode" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('promocode.user.promocode') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('promocode.user.promocode') }}"
                            aria-expanded="{{ request()->is('promocode.user.promocode') ? 'true' : 'false' }}">User
                            Promo Code</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('notification') ? 'menu active' : 'menu' }}">
                <a href="{{ route('admin.notification') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span>Notification</span>
                    </div>
                </a>
            </li>

            <li
                class="{{ request()->routeIs('settings.appcontrol', 'settings.report', 'purchase.detail') ? 'menu active' : 'menu' }}">
                <a href="#invoice2" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('settings.appcontrol', 'settings.report', 'purchase.detail') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        <span>Settings</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="invoice2" data-bs-parent="#accordionExample">
                    <li class="{{ request()->is('settings.appcontrol') ? 'menu active' : 'menu' }}">
                        <a href="{{ route('settings.appcontrol') }}"
                            aria-expanded="{{ request()->is('settings.appcontrol') ? 'true' : 'false' }}">App
                            Control</a>
                    </li>
                    <li class="{{ request()->is('settings.report', ) ? 'menu active' : 'menu' }}">
                        <a href="{{ route('settings.report') }}"
                            aria-expanded="{{ request()->is('settings.report') ? 'true' : 'false' }}">Payment
                            Reports</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>
