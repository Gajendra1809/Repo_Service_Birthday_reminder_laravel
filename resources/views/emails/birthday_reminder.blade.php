<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        .message {
            margin-bottom: 20px;
        }

        .message p {
            color: #555;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            color: #888;
        }

        a{
            background-color: #04AA6D;
            /* Green */
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
        }

    </style>
</head>

<body>
    <div class="container">
        <img src="background-image: url('https://unsplash.com/photos/selective-focus-photography-of-multicolored-confetti-lot-Xaanw0s0pMk');" alt="">
        <div class="header">
            <h1>🎉 Birthday Reminder 🎉</h1>
        </div>
        <div class="message">
            <p>Hi there!</p>
            <p>We just wanted to remind you that it's <strong>{{ $name }}</strong>'s birthday tomorrow<b></b> 🎂
            </p>
            <p>Don't forget to send your best wishes and make their day special!</p>
        </div>
       <a href="https://amazon.com/">Order a Gift!</a>
        <div class="footer">
            <p>Best Regards,</p>
            <p>Your Birthday Reminder Service</p>
        </div>
    </div>
</body>

</html>
