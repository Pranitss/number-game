<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        input {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            font-size: 16px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Number Guessing Game</h1>

        <?php
        session_start();

        function startNewGame() {
            $_SESSION['target_number'] = rand(1, 10);
            $_SESSION['attempts'] = 0;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['guess'])) {
                $userGuess = (int)$_POST['guess'];

                if ($userGuess >= 1 && $userGuess <= 10) {
                    $_SESSION['attempts']++;

                    if ($userGuess == $_SESSION['target_number']) {
                        $message = "Congratulations! You guessed the correct number in {$_SESSION['attempts']} attempts.";
                        startNewGame();
                    } else {
                        $message = "Incorrect guess. Try again!";
                    }
                } else {
                    $message = "Please enter a number between 1 and 10.";
                }
            }
        } else {
            startNewGame();
        }
        ?>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="guess">Enter your guess (between 1 and 10): </label>
            <input type="number" name="guess" id="guess" min="1" max="10" required>
            <button type="submit">Submit Guess</button>
        </form>

    </div>

</body>
</html>
