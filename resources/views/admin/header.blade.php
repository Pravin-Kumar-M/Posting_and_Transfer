<style>
    #menu:hover {
        border-bottom: 1px solid white;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm shadow-sm p-3 mb-4 bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Page</a>

        <!-- Toggler button for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav gap-3">
                <!-- Dropdown for Entries -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" id="menu">Entries</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('cadre')}}">Designation</a></li>
                        <li><a class="dropdown-item" href="{{route('office')}}">Office</a></li>
                        <li><a class="dropdown-item" href="{{route('subject')}}">Section</a></li>
                    </ul>
                </li>
                <!-- Other links -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="menu">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.all_staff')}}" id="menu">Staff Directory</a>
                </li>
            </ul>

            <!-- Logout button aligned to the right -->
            <div class="ms-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" value="Logout" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</nav>