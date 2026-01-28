<!-- <!DOCTYPE html>
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
            background: url('/images/login.png.jpeg') no-repeat center center fixed;
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
</html> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion – DataCenter Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            height: 100vh;
            background: radial-gradient(circle at top, #0f172a, #020617);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e5e7eb;
        }

        .login-container {
            width: 900px;
            max-width: 95%;
            height: 520px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            background: rgba(15, 23, 42, 0.85);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(16px);
        }

        /* LEFT SIDE */
        .login-visual {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(
                135deg,
                rgba(37, 99, 235, 0.15),
                rgba(15, 23, 42, 0.95)
            );
        }

        .login-visual h1 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #f8fafc;
        }

        .login-visual p {
            font-size: 16px;
            line-height: 1.6;
            color: #cbd5f5;
            max-width: 380px;
        }

        .login-visual .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            font-size: 20px;
            font-weight: 600;
            color: #f8fafc;
        }

        .login-visual .brand i {
            color: #60a5fa;
        }

        /* RIGHT SIDE */
        .login-form {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h2 {
            font-size: 26px;
            margin-bottom: 24px;
            color: #f8fafc;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            background: #020617;
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            color: #f8fafc;
            font-size: 15px;
            outline: none;
        }

        .input-group input::placeholder {
            color: #64748b;
        }

        .input-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
        }

        .btn-login {
            margin-top: 10px;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
        }

        .error-box {
            background: #dc2626;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
            text-align: center;
        }

        .register-link {
            margin-top: 24px;
            font-size: 14px;
            color: #cbd5f5;
        }

        .register-link a {
            color: #60a5fa;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                height: auto;
            }

            .login-visual {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="login-container">

    <!-- LEFT VISUAL -->
    <div class="login-visual">
        <div class="brand">
            <i class="fa-solid fa-server"></i>
            DataCenter Manager
        </div>

        <h1>Centralisez vos ressources</h1>
        <p>
            Accédez à l’ensemble des ressources du Data Center, consultez leur
            disponibilité et gérez vos demandes de réservation depuis une
            interface sécurisée et centralisée.
        </p>
    </div>

    <!-- RIGHT FORM -->
    <div class="login-form">
        <h2>Connexion</h2>

        @error('email')
            <div class="error-box">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
        @enderror

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>

            <div class="register-link">
                Pas encore de compte ?
                <a href="{{ route('register') }}">S’inscrire</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
