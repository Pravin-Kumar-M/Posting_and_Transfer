<!-- form starts here -->

<form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data" id="staffForm">

    <!-- Experience Details -->
    @csrf
    <div class="mt-5 w-50 mx-auto">
        <!-- Name -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <!-- Dropdown Button -->
                <button class="btn btn-dark dropdown-toggle" type="button" id="titleDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Title
                </button>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu" aria-labelledby="titleDropdown">
                    <li><a class="dropdown-item" href="#" onclick="setTitle('Mr.')">Mr.</a></li>
                    <li><a class="dropdown-item" href="#" onclick="setTitle('Mrs.')">Mrs.</a></li>
                </ul>
                <!-- Name Input with Floating Label -->

                <input type="text" class="form-control" id="name" name="name" placeholder="Name" oninput="capitalizeInput(event)" onkeyup="validateName()" required>
                <div id="nameError" class="invalid-feedback" style="display: none;">required *</div>
                <div id="nameInvalidError" class="invalid-feedback" style="display: none;">Please enter a valid name</div>
                <div id="nameLengthError" class="invalid-feedback" style="display: none;">Name should be at least 3 characters</div>

            </div>
        </div>

        <!-- Father Name -->
        <div class="col-12 mb-4">
            <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's name" required oninput="capitalizeInput(event)" onkeyup="validateFatherName()">

            <div id="fatherNameError" class="invalid-feedback" style="display: none;">required *</div>
            <div id="fatherNameInvalidError" class="invalid-feedback" style="display: none;">Please enter a valid name</div>
            <div id="fatherNameLengthError" class="invalid-feedback" style="display: none;">Name should be at least 3 characters</div>
        </div>

        <!-- Email -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="validateEmail()" required>
                <span class="input-group-text"><b>@gmail.com</b></span>
            </div>
            <div id="emailError" class="invalid-feedback">Please enter a valid email address.</div>
        </div>

        <!-- DOB -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <span class="input-group-text"><b>Date of Birth</b></span>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
        </div>

        <!-- Aadhar Number -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <span class="input-group-text"><b>Aadhar Number</b></span>
                <input type="text" class="form-control" id="aadhar_number" name="aadhar_number" maxlength="12" placeholder="Aadhar Number" required onkeyup="validateAadhar()">
            </div>
            <div id="aadhar_error" class="text-danger" style="display:none;">Aadhar Number must be exactly 12 digits and contain only numbers.</div>
        </div>

        <!-- Phone Number -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <span class="input-group-text"><b>Mobile Number</b></span>
                <input type="text" class="form-control" id="phone_number" name="phone_number" maxlength="10" placeholder="Phone Number" required onkeyup="validatePhone()">
            </div>
            <div id="phone_error" class="text-danger mt-1" style="display:none;">
                Phone Number must be exactly 10 digits and contain only numbers.
            </div>
        </div>

        <!-- Gender -->
        <div class="col-12 mb-4">
            <div class="input-group">
                <!-- Input Group Text for Gender Label -->
                <span class="input-group-text"><b>Gender</b></span>
                <div class="form-control p-2">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="male" name="gender" value="male" required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="female" name="gender" value="female" required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="others" name="gender" value="others" required>
                        <label class="form-check-label" for="others">Others</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Upload with Button and Icon -->
        <div class="col-12 mb-4">
            <label for="input-file" class="w-100" id="drop-area">
                <input type="file" accept="image/*" name="image" id="input-file" hidden>
                <div id="img-view" class="rounded-5" style="
                                    border: dashed; 
                                    background-size: contain; 
                                    background-repeat: no-repeat; 
                                    background-position: center; 
                                    width: 100%; 
                                    min-height: 200px; 
                                    display: flex; 
                                    align-items: center; 
                                    justify-content: center;
                                    text-align: center;">
                    <div class="d-block">
                        <i class="fa fa-cloud-upload fs-1"></i><br>
                        <p>Drag and Drop or click here <br>to upload image</p>
                        <span>Maximum 1MB and .jpg, .png, .jpeg</span>
                    </div>
                </div>

            </label>
        </div>

    </div>

    <hr>

    <!-- php -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "php_project");
    // Query to get the Cadre data
    $cadre_query = "SELECT id, cadre_name FROM cadres";
    $cadre_result = mysqli_query($conn, $cadre_query);

    // Query to get the Office data
    $office_query = "SELECT id, office_name FROM offices";
    $office_result = mysqli_query($conn, $office_query);

    // Query to get the Subject data
    $subject_query = "SELECT id, subject_name FROM subjects";
    $subject_result = mysqli_query($conn, $subject_query);

    ?>

    <!-- Experience Section -->
    <div class="mt-2">
        <div class="row p-2" id="itemRows">
            <div class="row mt-3 align-items-end">
                <!-- Cadre Selection -->
                <div class="col-md-2 col-12 mb-2">
                    <select class="form-control" name="cadre[]" id="cadre" required>
                        <option value="" disabled selected>Select Cadre</option>
                        <?php
                        while ($cadre = mysqli_fetch_assoc($cadre_result)) {
                            echo "<option value='" . htmlspecialchars($cadre['id'], ENT_QUOTES) . "'>" . htmlspecialchars($cadre['cadre_name'], ENT_QUOTES) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Office Selection -->
                <div class="col-md-2 col-12 mb-2">
                    <select class="form-control" name="office[]" id="office" required>
                        <option value="" disabled selected>Select Office</option>
                        <?php
                        while ($office = mysqli_fetch_assoc($office_result)) {
                            echo "<option value='" . htmlspecialchars($office['id'], ENT_QUOTES) . "'>" . htmlspecialchars($office['office_name'], ENT_QUOTES) . "</option>";
                        }
                        ?>
                    </select>
                </div>


                <!-- Subject Selection -->
                <div class="col-md-2 col-12 mb-2">
                    <select class="form-control" name="subject[]" id="subject" required>
                        <option value="" disabled selected>Select Section</option>
                        <?php
                        while ($subject = mysqli_fetch_assoc($subject_result)) {
                            echo "<option value='" . htmlspecialchars($subject['id'], ENT_QUOTES) . "'>" . htmlspecialchars($subject['subject_name'], ENT_QUOTES) . "</option>";
                        }
                        ?>
                    </select>
                </div>


                <!-- Joining Date -->
                <div class="col-md-2 col-12 mb-2">
                    <label for="joining_date" class="form-label"><b>Joining Date</b></label>
                    <input type="date" class="form-control" id="joining_date" name="joining_date[]" required>
                </div>

                <!-- Relieving Date -->
                <div class="col-12 col-md-2 mb-2">
                    <label for="relieving_date" class="form-label"><b>Relieving Date</b></label>
                    <input type="date" class="form-control" id="relieving_date" name="relieving_date[]" required>
                </div>
                <!-- Add Row Button -->
                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-dark" onclick="addRow()">Add Row</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>