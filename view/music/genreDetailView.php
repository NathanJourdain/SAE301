<?php include('www/header.inc.php'); ?>

<div style="background-image: url('www/static/genres/<?= $genre->Image ?>')" class="flex justify-center items-center h-72 bg-slate-400 bg-cover bg-center mb-10">
    <h1 class="text-4xl mb-5 font-black"><?= $genre->Name ?></h1>
</div>

<section class="grid grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] gap-5">
    <?php foreach($albums as $album): ?>
        <a href="album/<?= $album->AlbumId ?>" class="relative bg-slate-400 rounded-md aspect-square hover:scale-[1.05] transition delay-25 duration-100">
            <img src="<?= $album->Image ?>" alt="Image de l'album" class="w-full h-full">
            <span class="absolute bottom-0 block w-full text-center bg-black/75 py-2 backdrop-blur-sm text-xl"><?= $album->Title ?></span>
        </a>
    <?php endforeach; ?>
</section>

<div class="text-center text-xl">
    <?php if($page > 0): ?>
        <a href="genres/<?= $id ?>?page=<?= $page - 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page précédente"><i class="fa-solid fa-arrow-left"></i></a>
    <?php endif; ?>
    
    <?php if(sizeof($albums) == 25): ?>
        <a href="genres/<?= $id ?>?page=<?= $page + 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page suivante"><i class="fa-solid fa-arrow-right"></i></a>
    <?php endif; ?>
</div>


<?php include('www/footer.inc.php'); ?>