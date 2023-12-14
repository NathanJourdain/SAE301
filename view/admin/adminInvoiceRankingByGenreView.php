<?php include('www/header.inc.php'); ?>

<div class="flex flex-row items-center max-w-3xl mb-5">
    <h1 class="text-4xl font-black">Classement des genres</h1>
    <a href="admin/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">
        Retour à l'accueil
    </a>
</div>

<table class="w-full max-w-3xl">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <tr>
            <th class="px-2">Rang</th>
            <th class="px-2">Genre</th>
            <th class="px-2">Montant des ventes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($invoiceRanking as $index=>$genre): ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg w-8">#<?= $index+1 ?></td>
                <td class="p-2"><a href="genres/<?= $genre->GenreId ?>"><?= $genre->Name ?></a></td>
                <td class="p-2 rounded-r-lg"><?= $genre->Total ?>€</td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php include('www/footer.inc.php'); ?>