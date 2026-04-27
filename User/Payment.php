<?php
session_start();
include("../Assets/Connection/Connection.php");
$sel = "select * from tbl_booking where booking_id=".$_SESSION['bid'];
$row = $Con->query($sel);
$data = $row->fetch_assoc();

 if (isset($_POST["submit-btn"])) {
                 
                
                
                
               
               
              
              
              
   
                $upQry1 = "update tbl_booking set booking_status='2' where booking_id='" .$_SESSION["bid"]. "'";
				$Con->query($upQry1);
				
				 
                if($Con->query($upQry1))
                {
					
					
					if(isset($_POST["submit-btn"]))
					{
						?>
                    <script>
					window.location="Loader.php";
					</script>
                    <?php
					}
					else
					{
						?>
							<script>
                            window.location="MyBooking.php";
                            </script>
                            <?php
					}
					
                   
         		  	
					
                }
                 
                
                
   
        }


    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediPay - Secure Payment Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        :root {
            --primary-blue: #1a73e8;
            --secondary-blue: #4285f4;
            --medical-green: #34a853;
            --medical-red: #ea4335;
            --light-gray: #f8f9fa;
            --dark-gray: #5f6368;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
         
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .payment-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .payment-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-blue), var(--medical-green));
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .payment-illustration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: pulse 8s infinite linear;
        }

        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .payment-illustration h2 {
            font-size: 28px;
            margin-bottom: 15px;
            text-align: center;
            z-index: 1;
        }

        .payment-illustration p {
            font-size: 16px;
            opacity: 0.9;
            text-align: center;
            margin-bottom: 30px;
            z-index: 1;
        }

        .payment-card {
            flex: 1;
            background-color: var(--white);
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo i {
            font-size: 28px;
            color: var(--medical-green);
            margin-right: 10px;
        }

        .logo span {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-blue);
        }

        .secure-badge {
            background-color: var(--light-gray);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: var(--medical-green);
            display: flex;
            align-items: center;
        }

        .secure-badge i {
            margin-right: 5px;
            font-size: 14px;
        }

        .payment-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .payment-title h1 {
            font-size: 28px;
            color: var(--primary-blue);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .payment-title h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-blue), var(--medical-green));
            border-radius: 3px;
        }

        .payment-title p {
            color: var(--dark-gray);
            font-size: 14px;
        }

        .payment-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .form-control {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--light-gray);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
        }

        .form-control:hover {
            border-color: var(--primary-blue);
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .amount-display {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
        }

        .amount-label {
            font-size: 16px;
            color: var(--dark-gray);
        }

        .amount-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-blue);
        }

        .submit-btn {
            background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
            color: white;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(26, 115, 232, 0.3);
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 115, 232, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: var(--transition);
            opacity: 0;
        }

        .submit-btn:hover::after {
            animation: shine 1.5s ease;
        }

        @keyframes shine {
            0% { left: -50%; opacity: 0; }
            50% { opacity: 1; }
            100% { left: 150%; opacity: 0; }
        }

        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .payment-method {
            font-size: 32px;
            color: var(--dark-gray);
            transition: var(--transition);
        }

        .payment-method:hover {
            transform: translateY(-5px);
        }

        .fa-cc-visa { color: #1a1f71; }
        .fa-cc-mastercard { color: #eb001b; }
        .fa-cc-amex { color: #016fd0; }
        .fa-cc-paypal { color: #003087; }

        .pill-animation {
            position: absolute;
            width: 50px;
            height: 20px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            animation: float 6s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .pill-1 {
            top: 20%;
            left: 15%;
            animation-delay: 0s;
        }

        .pill-2 {
            top: 60%;
            right: 20%;
            animation-delay: 1s;
        }

        .pill-3 {
            bottom: 30%;
            left: 25%;
            animation-delay: 2s;
        }

        @media (max-width: 768px) {
            .payment-container {
                flex-direction: column;
            }
            
            .payment-illustration {
                padding: 30px 20px;
            }
            
            .payment-card {
                padding: 30px 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <div class="payment-illustration">
            <div class="pill-animation pill-1"></div>
            <div class="pill-animation pill-2"></div>
            <div class="pill-animation pill-3"></div>
            
            <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_obhph3sh.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
            <h2>Secure Payment Processing</h2>
            <p>Your transaction is encrypted and secure. We never store your payment details.</p>
            
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_5tkzkblw.json" background="transparent" speed="1" style="width: 150px; height: 150px;" loop autoplay></lottie-player>
        </div>

        <div class="payment-card">
            <div class="payment-header">
                <div class="logo">
                    <i class="fas fa-heartbeat"></i>
                    <span>MediPay</span>
                </div>
                <div class="secure-badge">
                    <i class="fas fa-lock"></i>
                    <span>Secure Payment</span>
                </div>
            </div>

            <div class="payment-title">
                <h1>Complete Your Payment</h1>
                <p>Please enter your payment details to complete your pharmacy purchase</p>
            </div>

            <form action="" method="post" class="payment-form">
                <div class="form-group">
                    <label for="credit-card">Card Number</label>
                    <input type="text" id="credit-card" class="form-control" required autocomplete="off" 
                           placeholder="1234 5678 9012 3456" title="Enter Correct Card Number" maxlength="19" 
                           name="txtacno">
                </div>

                <div class="form-group">
                    <label for="txtname">Cardholder Name</label>
                    <input type="text" name="txtname" id="txtname" class="form-control" required 
                           autocomplete="off" pattern="[a-zA-z ]{3,15}" title="Enter Correct Name" minlength="3" 
                           placeholder="John Doe">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="credit-card-exp">Expiration Date</label>
                        <input type="text" id="credit-card-exp" class="form-control" name="txtexpdate" required 
                               autocomplete="off" placeholder="MM/YY" pattern="[0-9/]{5,5}" 
                               title="Enter Correct Date" minlength="5" maxlength="5">
                        <span id="datecheck"></span>
                    </div>

                    <div class="form-group">
                        <label for="credit-card-ccv">CVV</label>
                        <input type="text" id="credit-card-ccv" class="form-control" name="txtccv" required 
                               autocomplete="off" placeholder="123" pattern="[0-9]{3,3}" 
                               title="Enter Correct CVV" minlength="3" maxlength="3">
                    </div>
                </div>

                <div class="amount-display">
                    <span class="amount-label">Total Amount</span>
                    <span class="amount-value"><?php echo $data['booking_amount']?></span>
                </div>

                <button type="submit" class="submit-btn" name="submit-btn">
                    <i class="fas fa-lock" style="margin-right: 8px;"></i> Confirm Payment
                </button>
            </form>

            <div class="payment-methods">
                <i class="fab fa-cc-visa payment-method"></i>
                <i class="fab fa-cc-mastercard payment-method"></i>
                <i class="fab fa-cc-amex payment-method"></i>
                <i class="fab fa-cc-paypal payment-method"></i>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const creditCardInput = document.getElementById("credit-card");
            const creditCardExp = document.getElementById("credit-card-exp");
            const creditCardCcv = document.getElementById("credit-card-ccv");

            creditCardInput.addEventListener("input", function () {
                const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
                const formattedValue = formatCreditCard(inputValue);
                this.value = formattedValue;
            });

            creditCardExp.addEventListener("input", function () {
                const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
                const formattedValue = formatExpirationDate(inputValue);
                this.value = formattedValue;
            });

            // Function to validate expiration date
            function validateExpirationDate(inputValue) {
                const month = inputValue.slice(0, 2); // Extract month (assuming format MMYY)
                const year = inputValue.slice(2, 4); // Extract year (assuming format MMYY)

                // Get current date
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100; // Get last two digits of current year
                const currentMonth = currentDate.getMonth() + 1; // getMonth() returns 0-11, so add 1

                // Validate month is between 1 and 12
                const isValidMonth = /^\d{2}$/.test(month) && parseInt(month, 10) >= 1 && parseInt(month, 10) <= 12;

                // Validate year is equal to or greater than current year
                const isValidYear = /^\d{2}$/.test(year) && parseInt(year, 10) >= currentYear;

                let isValidDate = false;

                if (isValidMonth && isValidYear) {
                    const expYear = parseInt(year, 10);
                    const expMonth = parseInt(month, 10);

                    if (expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth)) {
                        isValidDate = true;
                    }
                }

                if (!isValidDate) {
                    // Handle invalid input (e.g., show error message, disable form submission)
                    console.log('Invalid expiration date');
                    alert('Invalid expiration date');
                    document.getElementById("credit-card-exp").value = '';
                    // Optionally, you can clear the input field or show an error message
                    // creditCardExp.value = '';
                }
            }


            // Event listener for onchange
            creditCardExp.addEventListener("change", function () {
                const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
                validateExpirationDate(inputValue);
            });


            creditCardCcv.addEventListener("input", function () {
                const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
                const formattedValue = formatCVV(inputValue);
                this.value = formattedValue;
            });
        });

        function formatCreditCard(value) {
            const groups = value.match(/(\d{1,4})/g) || [];
            return groups.join(' ');
        }

        function formatExpirationDate(value) {
            const groups = value.match(/(\d{1,2})/g) || [];
            return groups.join('/').slice(0, 5);
        }

        function formatCVV(value) {
            return value.slice(0, 3);
        }
    </script>
</body>

</html>