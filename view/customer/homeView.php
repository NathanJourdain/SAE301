<?php include('www/header.inc.php'); ?>

<h1 class="text-4xl font-black mb-5">Bonjour <?= $user->FirstName ?></h1>

<section>
    <div class="flex flex-row mb-2">
        <h2 class="text-2xl font-semibold">Tes derniers achats</h2>
        <a href="mon-compte/musiques" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold ">Voir toutes mes musiques</a>
    </div>
    <div class="grid grid-cols-4 gap-5">
        <?php for ($i=0; $i < 4; $i++): ?>
        <a href="album/<?= $last_tracks[$i]->AlbumId ?>" class="relative bg-slate-400 aspect-square hover:scale-[1.05] transition delay-25 duration-100">
            <img src="<?= $last_tracks[$i]->getImage() ?>" alt="Image de l'album" class="w-full h-full">
            <span class="absolute bottom-0 block w-full text-center bg-black/75 py-2 backdrop-blur-sm text-xl"><?= $last_tracks[$i]->Name ?></span>
        </a>
        <?php endfor; ?>
    </div>
</section>

<section class="mt-5">
    <h2 class="text-2xl font-semibold">Tes genres préférés</h2>
    <div class="grid grid-cols-4 gap-5">
        <?php foreach($top_genres as $genre): ?>
            <a href="genres/<?= $genre->GenreId ?>" style="background-image: url('www/static/genres/<?= $genre->Image ?>')" class="h-28 item-stretch bg-slate-400 bg-cover bg-center hover:scale-[1.05] transition delay-25 duration-100 ">
                <span class="w-full h-full backdrop-blur-sm flex items-center justify-center uppercase font-black"><?= $genre->Name ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>


<?php include('www/footer.inc.php'); ?>