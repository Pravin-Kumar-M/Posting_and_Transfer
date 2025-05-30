<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome - Tirunelveli Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', sans-serif;
        }

        #menu:hover {
            border-bottom: 2px solid royalblue;
        }

        .hero {
            text-align: center;
            padding: 60px 20px;
            background: url('https://upload.wikimedia.org/wikipedia/commons/9/9d/NellaiapparTemple.jpg') no-repeat center center/cover;
            color: white;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero h1,
        .hero p {
            position: relative;
            z-index: 2;
        }

        .info-card {
            background-color: #ffffff;
            border-left: 6px solid royalblue;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-sm shadow-sm p-3 bg-white">
        <div class="container-fluid">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/TamilNadu_Logo.svg" alt="TN Logo" style="width:50px;" class="rounded-pill">
            <ul class="navbar-nav ms-auto gap-5">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{route('login')}}" id="menu">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{route('register')}}" id="menu">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="hero">
        <h1 class="display-4 fw-bold">Welcome to Tirunelveli District</h1>
        <p class="lead">Famous for History & Harmonious Administration</p>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="info-card">
                    <h3 class="mb-3 text-primary">Online Posting and Transfer System</h3>
                    <p>This system is designed to manage the seamless and transparent transfer and posting of employees under the Tirunelveli District Administration. Cadre-based movements, merit considerations, and regional preferences are prioritized to ensure both administrative efficiency and employee satisfaction.</p>
                    <ul>
                        <li>Smart Cadre Matching</li>
                        <li>Digital Application & Approval</li>
                        <li>Real-time Posting History</li>
                        <li>User-friendly Dashboard</li>
                    </ul>
                    <p class="mt-3 text-muted"><em>Empowering Governance with Technology</em></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>