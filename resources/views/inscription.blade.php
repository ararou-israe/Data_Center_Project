<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription - DataCenter</title>
<link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
<style>
    
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
                <option value="">Sélectionner</option>
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