<style>
    #menu:hover {
        border-bottom: 1px solid white;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm shadow-sm p-3 mb-4 bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Staff Page</a>

        <!-- Toggler button for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" id="menu">Your Details</a>
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