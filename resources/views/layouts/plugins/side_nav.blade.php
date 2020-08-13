<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" id="sidenav">
    <div class="container-fluid d-flex flex-column p-0" id="sidenav-menu">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">

            @foreach ($___side_nav_menus as $menu)
                <x-side-nav-item :menu="$menu"></x-side-nav-item>
            @endforeach
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
