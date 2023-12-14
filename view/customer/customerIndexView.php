<?php include('../www/header.inc.php'); ?>

    
    <form action="./auth/login" method="post" class="w-[58rem] mx-auto p-10 rounded-lg bg-slate-800 gap-5 gap-x-20 text-white grid grid-cols-2">
        <h1 class="text-4xl">Bonjour Truc Bidul</h1>
        <a href="auth/logout" class="py-2 px-5 rounded-full bg-white/25 w-max bg-[#b453dd] ml-auto">Se déconnecter</a>
            <a href="artistes/" class="relative w-52 ml-auto border-solid border-2  py-2 border-[#b453dd] text-xl rounded-md  text-center hover:bg-[#b453dd]">
            <i class="fa-solid fa-music"></i>
           Mes Musiques
            </a>
            <a href="artistes/" class="relative w-52 mr-auto border-solid border-2  py-2 border-[#b453dd] text-xl rounded-md  text-center hover:bg-[#b453dd]">
            <i class="fa-solid fa-cart-shopping"></i>
                 Mes Commandes
            </a>
          <h2 class="text-2xl col-span-2">Informations générales</h2>
        <label class="flex flex-col gap-1">
            <span>Prenom</span>
            <input type="Prenom" name="Prenom" placeholder="Prenom" class="p-2 text-black rounded-full">
        </label>

        <label class="flex flex-col gap-1">
            <span>Nom</span>
            <input type="Nom" name="Nom" placeholder="Nom" class="p-2 text-black rounded-full">
        </label>
        <label class="flex flex-col gap-1">
            <span>Adresse Mail</span>
            <input type="Adresse Mail" name="Adresse Mail" placeholder="Adresse Mail" class="p-2 text-black rounded-full">
        </label>
        <label class="flex flex-col gap-1">
            <span>Mot de passe</span>
            <input type="password" name="password" placeholder="Password" class="p-2 text-black rounded-full">
        </label>
        <label class="flex flex-col gap-1">
            <span>Telephone</span>
            <input type="telephone" name="telephone" placeholder="Telephone" class="p-2 text-black rounded-full">
        </label>
        <label class="flex flex-col gap-1">
            <span>Companie</span>
            <input type="Companie" name="Companie" placeholder="Companie" class="p-2 text-black rounded-full">
        </label>
    
        <button type="submit" class="py-2 px-5 rounded-full bg-white/25 w-max bg-[#b453dd] ">Modifier les informations</button>
    </form>

    <?php include('../www/footer.inc.php'); ?>