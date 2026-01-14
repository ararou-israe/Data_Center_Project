<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>Connexion - DataCenter Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: url('/images/login.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.1); /* Effet de verre léger */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        
        .input-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
            font-size: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px 15px 55px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            color: white; 
            font-size: 18px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input::placeholder {
            color: #ddd;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #0072ff;
        }

        .btn-connect {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, #0052D4, #4364F7, #6FB1FC); /* Dégradé bleu */
            color: white;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-connect:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
        }

        .register-link {
            margin-top: 30px;
            color: #eee;
            font-size: 16px;
        }

        .register-link a {
            color: #6FB1FC; 
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Connexion</h2>

        @error('email')
            <div style="color: #ffffff; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 14px;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
        @enderror

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="email" placeholder="Login" value="{{ old('email') }}" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn-connect">Se connecter</button>
            <div class="register-link">
                <p>Si vous n'avez pas de compte <a href="{{ route('register') }}">S'inscrire</a></p>
            </div>
        </form>
    </div>
</body>
</html>