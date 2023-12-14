<?php include('www/header.inc.php'); ?>

<div class="flex flex-row items-center mb-5">
    <h1 class="text-4xl font-black">
        Bonjour <?= $user->FirstName ?> <?= $user->LastName ?>
    </h1>
    <a href="auth/logout/" class="py-2 px-5 bg-violet-500 uppercase text-xs font-bold ml-auto  hover:bg-white hover:text-violet-500 transition-colors">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Me déconntecter
    </a>
</div>

<?php if ($user->Title == 'Sales Support Agent' || $user->Title == 'Sales Manager' || $user->Title == 'General Manager') : ?>
    <a href="admin/classement-genres/" class="py-2 px-5 mr-5 bg-violet-500 uppercase text-xs font-bold">
        Classement des genres
    </a>
    <a href="admin/clients-par-pays/" class="py-2 px-5 mr-5 bg-violet-500 uppercase text-xs font-bold">
        Clients par pays
    </a>
    <a href="admin/resume-achats-clients/" class="py-2 px-5 bg-violet-500 uppercase text-xs font-bold">
        Achats des clients
    </a>
<?php endif; ?>
<?php if ($user->Title == 'IT Staff' || $user->Title == 'IT Manager') : ?>
    <a href="admin/playlists/" class="py-2 px-5 mr-5 bg-violet-500 uppercase text-xs font-bold">
        Modifier les playlists
    </a>
    <a href="admin/liste-clients/" class="py-2 px-5 mr-5 bg-violet-500 uppercase text-xs font-bold">
        Liste des clients
    </a>
    <a href="admin/liste-employes/" class="py-2 px-5 bg-violet-500 uppercase text-xs font-bold">
        Liste des employés
    </a>
<?php endif; ?>


<form action="admin/" method="post" class="mt-5 max-w-[56rem] p-10 rounded-t-lg bg-slate-800 gap-5 gap-x-20 text-white grid grid-cols-2">
    <h2 class="text-2xl font-semibold col-span-2">Informations générales</h2>
    <?php if (isset($_SESSION['error_infos'])) : ?>
        <span class="text-red-500 text font-semibold col-span-2"><?= $_SESSION['error_infos'] ?></span>
    <?php
        unset($_SESSION['error_infos']);
    endif; ?>
    <?php if (isset($_SESSION['success_infos'])) : ?>
        <span class="text-green-500 font-semibold col-span-2"><?= $_SESSION['success_infos'] ?></span>
    <?php
        unset($_SESSION['success_infos']);
    endif; ?>
    <label class="flex flex-col gap-1">
        <span>Prénom</span>
        <input type="text" name="FirstName" placeholder="Prénom" value='<?= $user->FirstName ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Nom</span>
        <input type="text" name="LastName" placeholder="Nom" value='<?= $user->LastName ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Adresse Mail</span>
        <input type="email" name="Email" placeholder="Email" value='<?= $user->Email ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Téléphone</span>
        <input type="tel" name="Phone" placeholder="Téléphone" value='<?= $user->Phone ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Vérification du mot de passe</span>
        <input type="password" name="password" placeholder="Mot de passe" value='' class="px-5 py-2 text-black rounded-full" required>
    </label>

    <input type="hidden" name="infos">
    <button type="submit" class="py-2 px-5 rounded-full w-max bg-violet-500 col-span-2 ">Modifier les informations</button>
</form>

<form action="admin/" method="post" class="w-[56rem] mb-5 px-10 py-5 rounded-b-lg bg-slate-800 gap-5 gap-x-20 text-white grid grid-cols-2">

    <h2 class="text-2xl font-semibold col-span-2">Habitation</h2>
    <?php if (isset($_SESSION['error_location'])) : ?>
        <span class="text-red-500 text font-semibold col-span-2"><?= $_SESSION['error_location'] ?></span>
    <?php
        unset($_SESSION['error_location']);
    endif; ?>
    <?php if (isset($_SESSION['success_location'])) : ?>
        <span class="text-green-500 font-semibold col-span-2"><?= $_SESSION['success_location'] ?></span>
    <?php
        unset($_SESSION['success_location']);
    endif; ?>
    <label class="flex flex-col gap-1 col-span-2">
        <span>Addresse</span>
        <input type="text" name="Address" placeholder="Adresse" value='<?= $user->Address ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>CodePostal</span>
        <input type="text" name="PostalCode" placeholder="Code postal" value='<?= $user->PostalCode ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Ville</span>
        <input type="text" name="City" placeholder="Ville" value='<?= $user->City ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Département</span>
        <input type="text" name="State" placeholder="Département" value='<?= $user->State ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1">
        <span>Pays</span>
        <input type="text" name="Country" placeholder="Pays" value='<?= $user->Country ?>' class="px-5 py-2 text-black rounded-full" required>
    </label>
    <label class="flex flex-col gap-1  col-span-1">
        <span>Vérification du mot de passe</span>
        <input type="password" name="password" placeholder="Mot de passe" value='' class="px-5 py-2 text-black rounded-full" required>
    </label>

    <input type="hidden" name="location">
    <button type="submit" class="py-2 px-5 rounded-full w-max bg-violet-500 col-span-2 ">Modifier les informations</button>
</form>

<?php include('www/footer.inc.php'); ?>