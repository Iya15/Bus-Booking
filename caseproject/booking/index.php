<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Baliwag Transit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            width: 100%;
            height: 100%;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }

        header {
            width: 100%;
            height: 70px;
            background-color: #34532e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
        }

        .logo img {
            height: 60px;
        }

        .header-title {
            color: white;
            font-weight: bold;
            font-size: 25px;
        }

        main {
            display: flex;
            height: calc(97.5vh - 50px);
            background: linear-gradient(to bottom right, rgb(68, 173, 52), rgb(22, 70, 6));
        }

        .bus-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .bus-image {
            height: 80%;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 150px;
        }

        .content h1 {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .book-btn {
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #ffaa00;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
            transition: 0.3s;
        }

        .book-btn:hover {
            background-color: #ff9900;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../images/baliwag_logo.png" alt="BTI Logo" />
        </div>
        <div class="header-title">BALIWAG TRANSIT INC.</div>
    </header>

    <main>
        <div class="bus-container">
            <img src="../images/bus.png" alt="Baliwag Bus" class="bus-image" />
        </div>
        <div class="content">
            <h1>WELCOME TO<br />BALIWAG TRANSIT INC.<br />BUS BOOKING!</h1>
            <button class="book-btn" onclick="window.location.href='busbooking.php'">BOOK NOW</button>
        </div>
    </main>
</body>

</html>