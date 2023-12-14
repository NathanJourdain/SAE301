<?php 
include('www/header.inc.php'); 
?>

<div class="flex flex-row items-center mb-5">
    <h1 class="text-4xl font-black">Liste des employés</h1>
    <a href="admin/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">
        Retour à l'accueil
    </a>
</div>

<table class="w-full mb-5">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <tr>
            <th class="px-2">Prénom</th>
            <th class="px-2">Nom</th>
            <th class="px-2">Adresse mail</th>
            <th class="px-2">Téléphone</th>
            <th class="px-2">Poste</th>
            <th class="px-2">Adresse</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($employees as $employee): ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $employee->FirstName ?></td>
                <td class="p-2"><?= $employee->LastName ?></td>
                <td class="p-2"><?= $employee->Email ?></td>
                <td class="p-2"><?= $employee->Phone ?></td>
                <td class="p-2"><?= $employee->Title ?></td>
                <td class="p-2 rounded-r-lg"><?= $employee->getFullAddress() ?>€</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<div class="text-center text-xl">
    <?php if($page > 0): ?>
        <a href="admin/liste-employes/?page=<?= $page - 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page précédente"><i class="fa-solid fa-arrow-left"></i></a>
    <?php endif; ?>
    
    <?php if(sizeof($employees) == 25): ?>
        <a href="admin/liste-employes/?page=<?= $page + 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page suivante"><i class="fa-solid fa-arrow-right"></i></a>
    <?php endif; ?>
</div>

<?php include('www/footer.inc.php'); ?>
