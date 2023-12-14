<?php include('www/header.inc.php'); ?>

<div class="flex flex-row mb-5">
    <h1 class="text-4xl font-black">Mes musiques</h1>
    <a href="mon-compte" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold hover:bg-white hover:text-violet-500 transition-colors">Retour à mon compte</a>
</div>


<table class="w-full mt-10">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <th class="px-2">Titre</th>
        <th class="px-2">Artiste</th>
        <th class="px-2">Durée</th>
        <th class="px-2"></th>
    </thead>
    <tbody>
        <?php foreach($tracks as $track): ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $track->Name ?></td>
                <td class="p-2"><?= $track->getArtist()->Name ?></td>
                <td class="p-2"><?= $track->getDurationInMinutes() ?></td>
                <td class="p-2 rounded-r-lg text-right"><i class="fa-solid fa-download cursor-pointer" title="Télécharger la musique"></i></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center text-xl mt-5">
    <?php if($page > 0): ?>
        <a href="mon-compte/musiques/?page=<?= $page - 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page précédente"><i class="fa-solid fa-arrow-left"></i></a>
    <?php endif; ?>
    
    <?php if(sizeof($tracks) == 25): ?>
        <a href="mon-compte/musiques/?page=<?= $page + 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page suivante"><i class="fa-solid fa-arrow-right"></i></a>
    <?php endif; ?>
</div>

<?php include('www/footer.inc.php'); ?>