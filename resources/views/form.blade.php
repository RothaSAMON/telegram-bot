<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
            background-color: white;
        }

        .input-group select:focus {
            border-color: #007BFF;
            outline: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .input-group input, .input-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .input-group input:focus, .input-group textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background: #0056b3;
        }

        .footer-text {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            color: #555;
        }

        .footer-text a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form class="form" action="form-submit" method="POST">
            @csrf

            <h2>My Form</h2>

            <div class="input-group">
                <label for="telegram_user">Select Recipient</label>
                <select id="telegram_user" name="telegram_user" required>
                    <option value="">Choose a recipient</option>
                    @if(isset($users))
                        @foreach($users as $user)
                            <option value="{{ $user->chat_id }}">
                                {{ $user->first_name }} {{ $user->last_name ?? '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if(isset($users))
                    <small>Total users: {{ $users->count() }}</small>
                @endif
            </div>

            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
