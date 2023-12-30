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
                <label for="validationCustom02">IMG</label>
                <input type="file" accept="img/*" name="userImage" class="form-control" id="validationCustom02" placeholder="Img" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Submit form</button>
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