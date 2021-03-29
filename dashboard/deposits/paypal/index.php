<?php
include '../../../header.php';
?>

<link rel="stylesheet" href="./index.css">

<div class="hero d-flex align-items-end bg-primary">
    <h1 class="text-white ms-5 display-5 fw-bold">Paypal Deposit</h1>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <p class="fw-bold">Enter the amount to fund your account</p>
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInput" placeholder="Amount">
                <label class="text-uppercase" for="floatingInput">Amount</label>
            </div>
        </div>
        <div class="col">
            <p>Select your payment</p>
            <button type="button" class="btn btn-warning">Pay With Paypal</button>
            <br />
            <br />
            <button type="button" class="btn btn-dark">Debit or Credit Card</button>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>