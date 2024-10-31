<!doctype html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Simple Transactional Email</title>
  
  <style>
    .email-container {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border: 1px solid;
    }
    .header {
      background-color: #4f4f4f;
      padding: 20px;
      color: #ffffff;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    .body {
      padding: 20px;
    }
    .body p {
      font-size: 16px;
      line-height: 1.5;
    }
    .button {
      display: inline-block;
      padding: 12px 20px;
      margin-top: 20px;
      background-color: #4f4f4f;
      color:  #fff;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
    }
    .footer {
      background-color: #d6d6d6;
      padding: 15px;
      font-size: 14px;
      color: #777;
    }
  </style>
</head>

<body>
  <div class="email-container">
    
    <!-- Header -->
    <div class="header">
      <h1>Welcome to Our Service</h1>
    </div>

    <!-- Body -->
    <div class="body">
      <p>Hi, <?= $name ?>,</p>
      <p>Thank you for joining us! We’re excited to have you on board. Click the button below to get started:</p>
      <a href="http://localhost:8080" class="button">Get Started</a>
    </div>

    <!-- Footer -->
    <div class="footer">
      &copy; 2024 Your Company. All rights reserved.
    </div>
  </div>
</body>

</html>
