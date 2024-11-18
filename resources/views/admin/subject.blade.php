<!DOCTYPE html>
<html lang="en">

<head>
    <title>subject Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    @include('admin.header')


    <div class="container mt-5">
        <!-- Display Toastr success or error messages -->
        @if(session('toastr_success'))
        <script>
            toastr.success("{{ session('toastr_success') }}", 'Success', {
                closeButton: true,
                positionClass: 'toast-top-center',
            });
        </script>
        @elseif(session('toastr_error'))
        <script>
            toastr.error("{{ session('toastr_error') }}", 'Error', {
                closeButton: true,
                positionClass: 'toast-top-center',
            });
        </script>
        @endif

        <!-- Display session messages (success/error) in a regular alert box -->
        @if(session('messages'))
        <div class="alert alert-info">
            <ul>
                @foreach(session('messages') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form starts here -->
        <div class="shadow-lg p-5 mb-4 rounded-5 mx-auto" style="max-width: 600px;">
            <h1 class="text-center mb-4">Section</h1>

            <form action="{{ route('admin.subject.store') }}" method="post" autocomplete="off">
                @csrf
                <div id="dynamicRows">
                    <div class="row">
                        <div class="col-12  col-sm-9">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" placeholder="Enter Subject" name="subject_name[]" required oninput="capitalizeInput(event)">
                                <label>Enter Section</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 d-flex align-items-center mt-3 mt-sm-0">
                            <button type="button" class="btn btn-dark w-100" onclick="checkAndAddRow()">Add Row</button>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4 mb-3">
                    <button class="btn btn-success me-2" type="submit" name="subject_submit">Submit</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">Profiles</button>
                </div>
            </form>

            <!-- Offcanvas for subject Overview -->
            <div class="offcanvas offcanvas-end w-75 w-md-50 p-3" id="demo">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Section Overview</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">S.NO</th>
                                    <th>Section Name</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $key => $subject)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $subject->subject_name }}</td>
                                    <td class="text-center">
                                        <!-- Form to delete subject -->
                                        <form id="delete-form-{{ $subject->id }}" action="{{ route('admin.subject.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $subject->id }})">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function checkAndAddRow() {
            const inputFields = document.querySelectorAll('input[name="subject_name[]"]');
            let allFilled = true;

            // Check if all input fields are filled
            inputFields.forEach((input) => {
                if (!input.value.trim()) {
                    allFilled = false;
                }
            });

            // If any field is empty, show alert and stop
            if (!allFilled) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Empty Field',
                    text: 'Please fill in all existing rows before adding a new one.',
                    confirmButtonText: 'OK'
                });
            } else {
                addRow(); // Call addRow only if all fields are filled
            }
        }

        function addRow() {
            const rowHtml = `
        <div class="row align-items-center">
            <div class="col">
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" placeholder="Enter subject" name="subject_name[]" required oninput="capitalizeInput(event)">
                    <label>Enter Section</label>
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-dark me-2" onclick="checkAndAddRow()"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
            </div>
        </div>`;

            const dynamicRows = document.getElementById("dynamicRows");
            dynamicRows.insertAdjacentHTML('beforeend', rowHtml);
        }

        function removeRow(button) {
            button.closest('.row').remove();
        }

        // Optional: Capitalize input text
        function capitalizeInput(event) {
            let input = event.target;
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        }



        // sweet alert

        function confirmDelete(subjectId) {
            Swal.fire({
                title: 'Are you sure to delete this?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger ms-2',
                    cancelButton: 'btn btn-success me-2'
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form for the specific subject ID
                    document.getElementById(`delete-form-${subjectId}`).submit();
                }
            });
        }
    </script>
</body>

</html>