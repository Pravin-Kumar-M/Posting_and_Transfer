<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <!-- Left Section: Heading -->
                <h2 style="margin: 0;">District Administration Tirunelveli</h2>

                <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/TamilNadu_Logo.svg"
                    alt="Avatar Logo"
                    style="width: 60px; height: auto; " class="rounded-pill">
            </div>


            <div class="border mt-3 p-5">
                <!-- Employee Details -->
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <!-- Left Section: Personal Details -->
                    <div class="col-md-6">
                        <h3 style="text-decoration: underline;">Employee Details</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Father's Name:</td>
                                    <td>{{ $staff->father_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td>{{ $staff->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">D.O.B:</td>
                                    <td>{{ \Carbon\Carbon::parse($staff->dob)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Gender:</td>
                                    <td>{{ $staff->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Aadhar Number:</td>
                                    <td>{{ $staff->aadhar_number }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Phone Number:</td>
                                    <td>{{ $staff->phone_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Right Section: Image (aligned to the right corner) -->
                    <div class="col-md-6 text-center ms-auto">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $staff->image))) }}" style="width: 150px; height: auto;" alt="Image of {{ $staff->name }}">
                        <h2 class="mt-3">{{ $staff->name }}</h2>
                    </div>
                </div>

                <!-- Experience Details -->
                <div class="table-responsive mt-4">
                    <h3 class="text-decoration-underline">Experience Details</h3>
                    <table class="table" cellpadding='10' style="border: 1px solid black; width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black;">S.No</th>
                                <th style="border: 1px solid black;">Designation</th>
                                <th style="border: 1px solid black;">Office</th>
                                <th style="border: 1px solid black;">Section</th>
                                <th style="border: 1px solid black;">Joining Date</th>
                                <th style="border: 1px solid black;">To Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff->experiences as $index => $experience)
                            <tr>
                                <td style="border: 1px solid black;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid black;">{{ $experience->cadre->cadre_name }}</td>
                                <td style="border: 1px solid black;">{{ $experience->office->office_name }}</td>
                                <td style="border: 1px solid black;">{{ $experience->subject->subject_name }}</td>
                                <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($experience->joining_date)->format('d-m-Y') }}</td>
                                <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($experience->relieving_date)->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>