<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    #menu:hover {
        border-bottom: 1px solid blue;
    }
</style>

<body>

    <nav class="navbar navbar-expand-sm shadow-lg p-3 mb-4 bg-white">
        <div class="container-fluid">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/TamilNadu_Logo.svg" alt="Avatar Logo" style="width:50px;" class="rounded-pill">
            <ul class="navbar-nav gap-5">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}" id="menu">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}" id="menu">Register</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>District Administration Tirunelveli</h1>
    </div>
</body>

</html>