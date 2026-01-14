<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }
        .box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2 {
            color: #16a34a;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>✅ Inscription réussie</h2>
        <p>Votre compte a été créé avec succès.</p>
        <p>⏳ En attente de validation par l’administrateur.</p>

        <a href="{{ route('login') }}">Aller à la connexion</a>
    </div>
</body>
</html>