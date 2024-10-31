<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 0.9em;
            color: #555;
            text-align: left;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 12px;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive design for small screens */
        @media (max-width: 400px) {
            h2 {
                font-size: 1.3em;
            }
            .container {
                padding: 15px;
            }
            input[type="email"], input[type="password"], button {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>إعادة تعيين كلمة المرور</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">كلمة المرور الجديدة:</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">تأكيد كلمة المرور الجديدة:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit">تغيير كلمة المرور</button>
        </form>
    </div>
</body>
</html>