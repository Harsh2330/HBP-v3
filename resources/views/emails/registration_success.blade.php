<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 255, 0.2);
            border-radius: 8px;
            margin-top: 50px;
            border-left: 5px solid #007bff;
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #0056b3;
        }
        .signature {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #007bff;
            font-size: 14px;
            color: #555;
        }
        .signature strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Platform!</h1>
        <p>Your registration was successful.</p>
        <p><strong class="highlight">User ID:</strong> {{ $mailData['id'] }}</p>
        <p><strong class="highlight">Email:</strong> {{ $mailData['email'] }}</p>
        <p><strong class="highlight">Password:</strong> {{ $mailData['password'] }}</p>
        <p>We sincerely welcome you to our platform and appreciate your trust in us.</p>
<p>If you have any questions or require any assistance, please do not hesitate to reach out to our support team. We are always here to help.</p>
<p>Once again, thank you for joining us. We look forward to serving you.</p>


        <div class="signature">
            <p><strong>Regards,</strong></p>
            <p><strong>Ranjeet Kumar</strong></p>
            <p>Software Executive | Team- IT</p>
            <p>Deepak Foundation - ISBRI</p>
            <p>(Within Nijanand Ashram Premises)</p>
            <p>Adjoining L & T Knowledge City</p>
            <p>Near Laxmi Studio, NH - 48 Bypass</p>
            <p>Ajwa-Waghodia Road, Vadodara- 390019</p>
            <p><strong>Office:</strong> 7572890011/12/13/14/15</p>
            <p><strong>Intercom:</strong> 220</p>
            <p><strong>Mobile:</strong> +91 8460402762</p>
            <p><strong>Email:</strong> ranjeet.rohit@deepakfoundation.org</p>
            <p><strong>IT Help:</strong> ITHelpDesk@deepakfoundation.on.spiceworks.com</p>
            <p><strong>Website:</strong> <a href="https://www.deepakfoundation.org" target="_blank">www.deepakfoundation.org</a></p>
        </div>
    </div>
</body>
</html>
