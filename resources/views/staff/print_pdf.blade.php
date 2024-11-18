<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="mt-3 shadow-lg p-5 mb-4">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <!-- Left Section: Image -->
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/TamilNadu_Logo.svg"
                        alt="Avatar Logo"
                        style="width:60px;"
                        class="rounded-pill me-3">

                    <!-- Right Section: Heading -->
                    <h2 class="mb-1 flex-grow-1 text-end">District Administration Tirunelveli</h2>
                </div>

                <div class="border mt-3 p-5">
                    <!-- details -->
                    <div class="row align-items-center">
                        <!-- Left Section: Personal Details -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Father Name :</td>
                                        <td>{{ $staff->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email :</td>
                                        <td>{{ $staff->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">D.O.B :</td>
                                        <td>{{ $staff->dob }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Gender :</td>
                                        <td>{{ $staff->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Aadhar Number :</td>
                                        <td>{{ $staff->aadhar_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Phone Number :</td>
                                        <td>{{ $staff->phone_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 text-center">
                            <img src="{{ asset('images/' . $staff->image) }}" class="img-fluid" style="width: 200px;" alt="Image of {{ $staff->name }}">

                            <h2 class="mt-3">{{ $staff->name }}</h2>
                        </div>
                    </div>
                    <!-- experience -->
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Designation</th>
                                    <th>Office</th>
                                    <th>Section</th>
                                    <th>Joining Date</th>
                                    <th>To Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff->experiences as $index => $experience)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $experience->cadre->cadre_name }}</td>
                                    <td>{{ $experience->office->office_name }}</td>
                                    <td>{{ $experience->subject->subject_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($experience->joining_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($experience->relieving_date)->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>