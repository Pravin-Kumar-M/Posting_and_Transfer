<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    @include('staff.header')

    <div class="container mt-4">
        <h2>Welcome to the Staff Dashboard</h2>
        <p>This is where you can manage your entries and view reports.</p>
        <hr>
        <h4 class="mt-3">If you want to fill the form just click continue</h4>
        <div class="text-center">
            <a href="{{route('staff.staff')}}" class="btn btn-outline-primary">Continue</a>
        </div>
    </div>

</body>

</html>