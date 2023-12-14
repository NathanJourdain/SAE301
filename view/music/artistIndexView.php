<?php include('www/header.inc.php'); ?>

<h1 class="text-4xl font-black mb-5">Artistes commençant par <span class="font-bold"><?= ucfirst($letter) ?></span></h1>

<div class="mb-5">
    <?php
    $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    foreach($letters as $l): ?>
        <a href="artistes/<?= $l ?>" class="uppercase py-1 px-2 rounded mr-1 mb-2 inline-block bg-white/25 hover:bg-white/50"><?= $l ?></a>
    <?php endforeach; ?>
</div>

<section class="grid grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] gap-5">
    <?php foreach($artists as $artist): ?>
        <a href="artistes/<?= $artist->ArtistId ?>" class="relative bg-slate-400 rounded-md aspect-square hover:scale-[1.05] transition delay-25 duration-100">
            <img src="<?= $artist->Image ?>" alt="Image de l'artiste" class="w-full h-full object-cover">
            <span class="absolute bottom-0 block w-full text-center bg-black/75 py-2 backdrop-blur-sm text-xl"><?= $artist->Name ?></span>
        </a>
    <?php endforeach; ?>
</section>


<?php include('www/footer.inc.php'); ?>