<?php
include '../header.php';
?>

<link rel="stylesheet" href="./index.css">

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div id="register-image" class="col h-100 bg-dark"></div>
        <div class="col h-100 d-flex align-items-center justify-content-center px-5">
            <div class="flex-grow-1">
                <h1>Register</h1>
                <form>
                    <fieldset id="register-fieldset">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">REGISTER</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./index1.js"></script>

<?php
include '../footer.php';
?>