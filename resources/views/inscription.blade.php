<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription - DataCenter Manager</title>
<style>
    /* 1. Global Reset & Font */
    * { 
        margin: 0; padding: 0; box-sizing: border-box; 
        font-family: 'Inter', 'Segoe UI', sans-serif; 
    }

    body {
        min-height: 100vh;
        width: 100vw;
        display: flex;
         min-height: 100vh;

     background-image: url("/images/login.png"); 
     background-size: cover;        
     background-position: center;   
     background-repeat: no-repeat;
    }

    .register-box {
        width: 100%;
        padding: 49px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h2 {
        margin-bottom: 30px;
        color: #3003f7;
        font-size: 40px;
        font-weight: 700;
    }

    form {
        width: 100%;
        max-width: 850px;
        background: #bdcbf9;
        padding: 35px;
        border-radius: 0px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .input-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 25px;
        position: relative;
    }

    .input-group label {
        font-size: 14px;
        font-weight: 600;
        color: #416ba5;
        margin-bottom: 8px;
        transition: 0.3s;
    }

    /* 2. Style de  -inputs -validation */
    .input-group input, 
    .input-group select {
        width: 100%;
        padding: 15px 18px;
        border-radius: 10px;
        border: 2px solid #e2e8f0; 
        font-size: 16px;
        background: #fff;
        outline: none;
        transition: all 0.3s ease;
    }

    /* 3. Les champs Invalid */
    /* en rouge si sont vide */
    .input-group input:placeholder-shown {
        border-color: #e2e8f0; 
    }

    .input-group input:not(:placeholder-shown):invalid {
        border-color: #ef4444; /* en rouge s il ya un erreur dans email */
        background-color: #fef2f2;
    }

    /* 4. Les champs Valid) */
    .input-group input:not(:placeholder-shown):valid,
    .input-group select:valid {
        border-color: #22c55e; /* Vert si valide */
        background-color: #f0fdf4;
    }

    /* Focus effect */
    .input-group input:focus {
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
    }

    /* 5. Style de Select */
    .input-group select {
        cursor: pointer;
        appearance: none;
       
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }

    /* 6. Bouton de -inscription */
    .btn-register {
        width: 100%;
        padding: 18px;
        background: #1e293b; /* Noir/Bleu foncé  */
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-register:hover {
        background: #334155;
        transform: translateY(-2px);
    }

    .login-link {
        text-align: center;
        margin-top: 25px;
        color: #64748b;
    }

    .login-link a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
    }
    .alert-success {
    background-color: #dcfce7;
    color: #945d66;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 600;
    border: 1px solid #86efac;
}
</style>
</head>
<body>
    

<div class="register-box">
    <h2>Créer un compte</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        @if ($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:10px;margin-bottom:20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="input-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Nom" required>
        </div>

        <div class="input-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        </div>

        <div class="input-group">
            <label for="password_confirmation">Confirmer mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required>
        </div>

        <div class="input-group">
            <label for="roles">vous êtes qui ?</label>
            <select name="roles" id="roles" required>
                <option value="">Sélectionner rôle</option>
                <option value="utilisateur_interne">Ingénieur / Enseignant / Doctorant</option>
                <option value="responsable">Responsable</option>
            </select>
        </div>

        <button type="submit" class="btn-register">S'inscrire</button>

        <div class="login-link">
            si vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </form>
</div>

</body>
</html>