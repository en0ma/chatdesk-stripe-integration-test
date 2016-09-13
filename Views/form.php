<html>
<head>
    <title>ChatDesk: Make Payment</title>
    <link rel="StyleSheet" href="assets/main.css" type="text/css" >
</head>

<body>
    <div class="container">
        <div class="content">
            <div id="payment-form-div">
                <span class="payment-label">Make Payment!</span>
                <span class="payment-description">You will be charged $2.00 amount</span>
                <br><br>
                <form action="" method="POST" id="payment-form">
                    <label for="number">Card Number: </label> <input data-stripe="number" id="number" type="text"/>
                    <label for="cvc">CVC: </label> <input data-stripe="cvc" id="cvc" type="text"/>
                    <label for="expiry">Expiry Month/Year: </label> <input data-stripe="exp-month" id="expiry" type="text"/>
                    <button id="pay" type="submit">Pay</button>
                </form>
                <span class="messages"></span>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/jquery.js" ></script>
    <script type="text/javascript" src="assets/payment.js" ></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="assets/main.js" ></script>
</body>
</html>
