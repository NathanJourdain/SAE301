<?php include("www/header.inc.php");?>

    
    <h1 class="text-4xl font-black mb-5">Tous les genres</h1>

    <section class="grid grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] gap-5">
        <?php foreach($genres as $genre): ?>
            <a href="genres/<?= $genre->GenreId ?>" style="background-image: url('www/static/genres/<?= $genre->Image ?>')" class="h-28 item-stretch bg-slate-400 bg-cover bg-center hover:scale-[1.05] transition delay-25 duration-100 ">
                <span class="w-full h-full backdrop-blur-sm flex items-center justify-center uppercase font-black"><?= $genre->Name ?></span>
            </a>
        <?php endforeach; ?>
    </section>


<?php include("www/footer.inc.php");?>
