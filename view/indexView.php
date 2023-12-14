<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="www/static/favicon.png" type="image/png">

    <link rel="stylesheet" href="www/static/tailwind.css">
    
    <title>Connexion</title>
</head>
<body class="bg-slate-900 text-white">
    <form action="./auth/login" method="post" class="max-w-lg w-11/12 mx-auto p-10 rounded-3xl flex flex-col bg-slate-700 gap-5 mt-20">
        <img src="www/static/logotoutui.png" alt="logo" class="h-20 object-contain">

        <h1 class="text-4xl font-black text-center">Formulaire de connexion</h1>
        <?php if(isset($_SESSION['erreur'])) : ?>
            <p class="text-red-500 font-semibold"><?= $_SESSION['erreur'] ?></p>
        <?php endif; unset($_SESSION['erreur']); ?>
            
        <label class="flex flex-col">
            <span>Adresse mail</span>
            <input type="email" name="email" placeholder="example@domain.com" class="px-2 py-1 rounded-lg bg-transparent border-b-2 border-violet-500">
        </label>
    
        <label class="flex flex-col">
            <span>Mot de passe</span>
            <input type="password" name="password" class="px-2 py-1 rounded-lg bg-transparent border-b-2 border-violet-500">
        </label>
    
        <button type="submit" class="py-2 px-5 bg-violet-500 uppercase w-max mx-auto">Se connecter</button>
    </form>

    <footer class="bg-slate-700 mb-10 ml-10 mr-10 mt-10 rounded-xl p-5">
        <p class="text-center"><a href="mentions-legales">Mentions légales</a> - Toutuï par Félix Mathieu Nathan - &copy; 2022</p>
    </footer>
</body>
</html>




