<?php include('www/header.inc.php'); ?>

<div class="flex flex-row mb-5">
    <h1 class="text-4xl font-black">Mes factures</h1>
    <a href="mon-compte" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold  hover:bg-white hover:text-violet-500 transition-colors">Retour à mon compte</a>
</div>

<table class="w-full mt-10">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <th class="px-2">Date d'achat</th>
        <th class="px-2">Montant</th>
        <th class="px-2"></th>
    </thead>
    <tbody>
        <?php foreach($invoices as $invoice): ?>
            <?php 
            $date = new DateTime($invoice->InvoiceDate);
            $date_format = $date->format('d/m/Y');
            ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg">Facture du <?= $date_format ?></td>
                <td class="p-2"><?= $invoice->Total ?>€</td>
                <td class="p-2 rounded-r-lg text-right"><a href="mon-compte/factures/<?= $invoice->InvoiceId ?>" class="py-2 px-5 bg-violet-500 uppercase text-xs font-bold">Voir le détail</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include('www/footer.inc.php'); ?>