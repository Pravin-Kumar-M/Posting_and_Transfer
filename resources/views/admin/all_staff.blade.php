<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!-- nav -->
    @include('admin.header')

    <div class="container-fluid">
        <div class="container mt-3">
            <h2 class="text-center mt-5 mb-5">Staff Directory</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Aadhar Number</th>
                            <th>Phone Number</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Loop through staff members and display data -->
                        @foreach($staffMembers as $index => $staff)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->gender }}</td>
                            <td>{{ $staff->aadhar_number }}</td>
                            <td>{{ $staff->phone_number }}</td>
                            <td>
                                <a href="{{ route('admin.each_staff', $staff->id) }}" class="btn btn-success">View</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>