<?php include('www/header.inc.php'); ?>

<div class="flex flex-row items-center max-w-3xl mb-5">
    <h1 class="text-4xl font-black">Création d'une playlist</h1>
    <a href="admin/playlists/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">
        Retour aux playlists
    </a>
</div>

<form action="admin/playlists/create" method="post" class="max-w-3xl p-10 rounded-3xl flex flex-col gap-5" enctype="multipart/form-data">
    <?php if(isset($_SESSION['erreur'])) : ?>
        <p><?= $_SESSION['erreur'] ?></p>
    <?php endif; unset($_SESSION['erreur']); ?>
        
    <label class="flex flex-col">
        <span>Nom de la playlist</span>
        <input type="text" name="name" class="px-2 py-1 rounded-lg bg-transparent border-b-2 border-violet-500" require>
    </label>

    <label class="flex flex-col">
        <span>Image</span>
        <input type="file" name="image" class="px-2 py-1 rounded-lg bg-transparent border-b-2 border-violet-500" accept=".jpg, image/jpg">
    </label>

    <button type="submit" class="py-2 px-5 bg-violet-500 uppercase w-max mx-auto">
        <i class="fa-solid fa-plus"></i>
        <span>Créér la playlist</span>
    </button>
</form>



<?php include('www/footer.inc.php'); ?>