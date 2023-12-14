<?php include('www/header.inc.php'); ?>

<div class="flex flex-row items-center max-w-3xl mb-5">
    <h1 class="text-4xl font-black">Les playlists</h1>
    <a href="admin/playlists/create/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">
        <i class="fa-solid fa-plus"></i>
        <span>Créér une playlist</span>
    </a>
</div>



<ul class="max-w-3xl">
    <?php foreach($playlists as $playlist): ?>
        <li class="mb-2">
           <p class="hover:bg-white/25 p-2 flex flex-row items-center rounded-lg">
            <span><?= $playlist->Name ?></span>
            <a href="admin/playlists/<?= $playlist->PlaylistId ?>/delete" class="py-2 px-5 text-violet-500 uppercase text-xs font-bold ml-auto">
                <i class="fa-solid fa-trash" title="Supprimer la playlist"></i>
            </a>
            <a href="playlists/<?= $playlist->PlaylistId ?>" class="py-2 px-5 bg-violet-500 uppercase text-xs font-bold">
                <i class="fa-solid fa-pen-to-square" title="Modifier la playlist"></i>
            </a>
           </p>
        </li>
    <?php endforeach; ?>
</ul>


<?php include('www/footer.inc.php'); ?>