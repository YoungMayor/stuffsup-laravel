<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" id="sidenav">
    <div class="container-fluid d-flex flex-column p-0" id="sidenav-menu">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">

            @foreach ($___side_nav_menus as $menu)
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link
                            {{
                                url()->current() == route($menu['route'])
                                ? 'active'
                                : ''
                            }}"
                        href="{{ route($menu['route']) }}">
                        <i class="{{ $menu['icon'] }}"></i>
                        <span>
                            {{ $menu['label'] }}
                        </span>
                    </a>
                </li>
            @endforeach

            <li class="nav-item" role="presentation">
                <a
                    class="nav-link"
                    data-toggle="modal"
                    data-target="#market_filter_modal">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </a>
            </li>
        </ul>

        <div class="text-center d-none d-md-inline">
            <button
                class="btn rounded-circle border-0"
                id="sidebarToggle"
                type="button"
            ></button>
        </div>
    </div>
</nav>
