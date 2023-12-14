<?php include("www/header.inc.php");?>

    <h1 class="text-4xl font-black mb-5">Toutes les playlists</h1>

    <section class="grid grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] gap-5">
        <?php foreach($playlists as $playlist): ?>
            <a href="playlists/<?= $playlist->PlaylistId ?>" style="background-image: url('www/static/Playlists/<?= $playlist->Image ?>')" class="relative bg-slate-400 rounded-md aspect-square bg-cover bg-center hover:scale-[1.05] transition delay-25 duration-100">
                
                <span class="absolute bottom-0 block w-full text-center bg-black/75 py-2 backdrop-blur-sm text-xl"><?= $playlist->Name ?></span>
            </a>
        <?php endforeach; ?>
    </section>

<?php include("www/footer.inc.php");?>
