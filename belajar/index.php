<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Membaca</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #e6f7ff;
            margin: 20px;
        }
        
        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            z-index: -1;
        }

        #content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button {
            padding: 10px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
        }

        #randomText {
            font-size: 48px;
            font-weight:bold;
            margin: 20px;
        }
    </style>
</head>
<body>
    <video autoplay muted loop id="videoBackground"  poster="bg.jpg">
        <source src="bg3.mp4">
        Your browser does not support the video tag.
    </video>

    <div id="content">
        <h2>Belajar Membaca</h2>
        <button onclick="generateRandomText()">Klik Aku</button>
        <p id="randomText"></p>
    </div>

    <script>
        function generateRandomText() {
            var consonants = 'bcdfghjklmnpqrstvwxyz';
            var vowels = 'aeiou';

            var randomText = getRandomElement(consonants) + getRandomElement(vowels) +
                             getRandomElement(consonants) + getRandomElement(vowels);

            document.getElementById("randomText").innerHTML = randomText.toUpperCase();
        }

        function getRandomElement(str) {
            return str.charAt(Math.floor(Math.random() * str.length));
        }
    </script>

</body>
</html>
