<?php include('www/header.inc.php'); ?>

<div class="flex flex-row items-center max-w-3xl mb-5">
    <h1 class="text-4xl font-black">Nombres de clients et panier moyen par pays</h1>
    <a href="admin/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold whitespace-nowrap hover:bg-white hover:text-violet-500 transition-colors">
        Retour à l'accueil
    </a>
</div>

<table class="w-full max-w-3xl">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <tr>
            <th class="px-2">Pays</th>
            <th class="px-2">Nombres de clients</th>
            <th class="px-2">Panier moyen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($customersByCountry as $customers): ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $customers->Country ?></td>
                <td class="p-2"><?= $customers->Count ?></td>
                <td class="p-2 rounded-r-lg"><?= $customers->Average ?>€</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('www/footer.inc.php'); ?>