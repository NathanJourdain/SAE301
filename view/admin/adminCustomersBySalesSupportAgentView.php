<?php
include('www/header.inc.php'); ?>

<div class="flex flex-row items-center max-w-3xl mb-5">
    <h1 class="text-4xl font-black">Résumé des achats des clients</h1>
    <a href="admin/" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">
        Retour à l'accueil
    </a>
</div>

<form method="get" class="flex flex-row mb-5 items-center gap-2">
    <label>
        <span>Sélectionnez un vendeur :</span>
        <select name="salesSupportAgentId"  class="text-white rounded-lg bg-slate-700 p-2">
            <?php foreach ($salesSupportAgents as $employee) : ?>
                <option value="<?= $employee->EmployeeId ?>" <?php if (isset($salesSupportAgentId) && $salesSupportAgentId == $employee->EmployeeId) echo "selected" ?>>
                    <?= $employee->FirstName ?> <?= $employee->LastName ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit" class="py-2 px-5 bg-violet-500 uppercase h-max text-xs font-bold">Afficher le résumé</button>
</form>

<?php if (isset($salesSupportAgentId)) : ?>

    <table class="w-full max-w-3xl">
        <thead class="text-slate-400 text-left uppercase text-xs">
            <tr>
                <th class="px-2">Pays</th>
                <th class="px-2">Genre</th>
                <th class="px-2">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($statisticsOfSaleSupportAgent as $statistic): ?>
                <tr class="hover:bg-white/25">
                    <td class="p-2 rounded-l-lg"><?= $statistic->Country ?></td>
                    <td class="p-2"><?= $statistic->Genre ?></td>
                    <td class="p-2 rounded-r-lg"><?= $statistic->Total ?>€</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php endif; ?>


<?php include('www/footer.inc.php'); ?>