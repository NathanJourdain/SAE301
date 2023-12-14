<?php include('www/header.inc.php'); ?>
<?php 
    $date = new DateTime($invoice->InvoiceDate);
    $date_format = $date->format('d/m/Y');
?>

<div class="flex flex-row">
    <h1 class="text-4xl font-black mb-5">Facture du <?= $date_format ?></h1>
    <a href="mon-compte/factures" class="ml-auto py-2 px-5 bg-violet-500 uppercase h-max self-center text-xs font-bold">Retour aux factures</a>
</div>


<table class="w-full mt-5">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <th class="px-2">Titre</th>
        <th class="px-2">Artiste</th>
        <th class="px-2 text-right">Prix</th>
    </thead>
    <tbody>
        <?php foreach($invoiceLines as $line): ?>
            <?php $track = Track::getTrack($line->TrackId);?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $track->Name ?></td>
                <td class="p-2"><?= $track->getArtist()->Name ?></td>
                <td class="p-2 rounded-r-lg text-right"><?= $line->UnitPrice ?>€</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="mt-5 text-right">Total: <em class="font-bold not-italic"><?= $total ?>€</em></p>

<?php include('www/footer.inc.php'); ?>