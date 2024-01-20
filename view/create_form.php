<div class="container">
    <form action="http://localhost/clones/phpcrud/create_user" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Name</label>
                <input type="text" class="form-control" name="userName" id="validationCustom01" placeholder="Name" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="userEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="userPassword" class="form-control" id="exampleInputPassword1">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">IMG</label>
                <input type="file" accept="img/*" name="userImage" class="form-control" id="validationCustom02" placeholder="Img" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start mt-3">
            <div class="form-check me-3">
                <input class="form-check-input" value="male" name="userGender" value="male" type="radio"  id="flexRadioDefault4">
                <label class="form-check-label" for="flexRadioDefault4">
                    male
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" value="female" name="userGender" value="female" type="radio" id="flexRadioDefault5">
                <label class="form-check-label" for="flexRadioDefault5">
                    female
                </label>
            </div>
            <div class="form-check me-3">
                <input class="form-check-input" value="other" name="userGender" value="other" type="radio" id="flexRadioDefault6" checked>
                <label class="form-check-label" for="flexRadioDefault6">
                    other
                </label>
            </div>
        </div>
        <select class="form-select mt-3" aria-label="Default select example" name="userHobby">
            <option value="cricket" selected>Cricket </option>
            <option value="footboll">footboll</option>
            <option value="chess">chess</option>
        </select>
        <button class="btn btn-primary mt-3" type="submit">Submit form</button>
    </form>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


</div>