<?php include('www/header.inc.php'); ?>

<div class="grid grid-cols-[30%_70%] gap-5 mb-10">
    <img src="<?= $artist->Image ?>" alt="Image de l'artsite" class="w-full aspect-square object-cover rounded-full">
    <div class="self-end">
        <p class="uppercase font-bold">Artiste</p>
        <h1 class="text-4xl font-black mb-5"><?= $artist->Name ?></h1>
    </div>
</div>


<h2 class="text-3xl mb-5">Albums</h2>
<section class="grid grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] gap-5">
    <?php foreach($albums as $album): ?>
        <a href="album/<?= $album->AlbumId ?>" class="relative bg-slate-400 rounded-md aspect-square hover:scale-[1.05] transition delay-25 duration-100">
            <img src="<?= $album->Image ?>" alt="Image de l'album" class="w-full h-full">
            <span class="absolute bottom-0 block w-full text-center bg-black/75 py-2 backdrop-blur-sm text-xl"><?= $album->Title ?></span>
        </a>
    <?php endforeach; ?>
</section>


<?php include('www/footer.inc.php'); ?>