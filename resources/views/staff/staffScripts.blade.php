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



   <script>
       function addRow() {
           const lastRow = document.querySelector('#itemRows .row:last-child');
           if (lastRow) {
               const inputs = lastRow.querySelectorAll('input[type="text"], input[type="date"], select');
               for (const input of inputs) {
                   if (!input.value) {
                       alert("Please fill all fields in the current row before adding a new one.");
                       input.focus();
                       return;
                   }
               }
           }

           // Create a new row
           const itemRows = document.getElementById('itemRows');
           const newRow = document.createElement('div');
           newRow.className = 'row mt-3 align-items-end';

           newRow.innerHTML = `
        <div class="col-md-2 col-12 mb-2">
            <select class="form-control" name="cadre[]" required>
                <option value="" disabled selected>Select Designation</option>
                <?php
                while ($cadre = mysqli_fetch_assoc($cadre_result)) {
                    echo "<option value='" . htmlspecialchars($cadre['id'], ENT_QUOTES) . "'>" . htmlspecialchars($cadre['cadre_name'], ENT_QUOTES) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-12 mb-2">
            <select class="form-control" name="office[]" required>
                <option value="" disabled selected>Select Office</option>
                <?php
                while ($office = mysqli_fetch_assoc($office_result)) {
                    echo "<option value='" . htmlspecialchars($office['id'], ENT_QUOTES) . "'>" . htmlspecialchars($office['office_name'], ENT_QUOTES) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-12 mb-2">
            <select class="form-control" name="subject[]" required>
                <option value="" disabled selected>Select Section</option>
                <?php
                while ($subject = mysqli_fetch_assoc($subject_result)) {
                    echo "<option value='" . htmlspecialchars($subject['id'], ENT_QUOTES) . "'>" . htmlspecialchars($subject['subject_name'], ENT_QUOTES) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-12 mb-2">
            <input type="date" class="form-control" name="joining_date[]" placeholder="Joining Date" required>
        </div>
        <div class="col-md-2 col-12 mb-2">
            <input type="date" class="form-control" name="relieving_date[]" placeholder="Relieving Date" required>
        </div>
        <div class="col-md-2 col-12 mb-2 d-flex align-items-end">
            <button type="button" class="btn btn-dark me-1" onclick="addRow()">
                <i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-danger" onclick="removeRow(this)">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    `;

           itemRows.appendChild(newRow);
       }

       function removeRow(button) {
           const row = button.closest('.row');
           row.remove();
       }


       // title
       function setTitle(title) {
           document.getElementById('name').value = title + ' ' + document.getElementById('name').value;
       }

       // upload image
       const dropArea = document.getElementById('drop-area');
       const inputFile = document.getElementById('input-file');
       const imageView = document.getElementById('img-view');

       // Event listeners for file input and drag/drop
       inputFile.addEventListener('change', handleFileSelect);
       dropArea.addEventListener('dragover', (e) => {
           e.preventDefault();
           dropArea.classList.add('drag-over');
       });
       dropArea.addEventListener('dragleave', () => {
           dropArea.classList.remove('drag-over');
       });
       dropArea.addEventListener('drop', (e) => {
           e.preventDefault();
           dropArea.classList.remove('drag-over');
           if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
               inputFile.files = e.dataTransfer.files; // Attach dropped files to the input
               handleFileSelect();
           }
       });

       function handleFileSelect() {
           const file = inputFile.files[0];
           if (file && validateFile(file)) {
               const imageLink = URL.createObjectURL(file);
               imageView.style.backgroundImage = `url(${imageLink})`;
               imageView.innerHTML = ''; // Clear the placeholder content
           } else {
               alert("Please upload a valid image file (Maximum 1MB, .jpg, .png, .jpeg).");
               inputFile.value = "";
           }
       }

       function validateFile(file) {
           const validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
           const maxSize = 1 * 1024 * 1024; // 1MB
           return validExtensions.includes(file.type) && file.size <= maxSize;
       }
   </script>