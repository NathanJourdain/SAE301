<?php 
$scripts = ['www/static/scripts/albumDetailView.js'];
include('www/header.inc.php'); 
?>

<div class="grid grid-cols-[30%_70%] gap-5 mb-10">
    <img src="<?= $album->Image ?>" alt="Image de l'album" class="w-full aspect-square object-cover">
    <div class="self-end">
        <p class="uppercase font-bold">Album</p>
        <h1 class="text-4xl font-black mb-5"><?= $album->Title ?></h1>
        <p class="flex flex-row items-center gap-1">
            <img src="<?= $artist->Image ?>" alt="Image de l'artiste" class="rounded-full h-8">
            <a href="artistes/<?= $artist->ArtistId ?>">
                <?= $artist->Name ?>
            </a>
            - <?= sizeof($tracks) ?> titres
        </p>
    </div>
</div>

<table class="w-full">
    <thead class="text-slate-400 text-left uppercase text-xs">
        <th class="px-2">Titre</th>
        <th class="px-2">Durée</th>
        <th class="px-2">Prix</th>
        <th class="px-2"></th>
    </thead>
    <tbody>
        <?php foreach($tracks as $track): ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $track->Name ?></td>
                <td class="p-2"><?= $track->getDurationInMinutes() ?></td>
                <td class="p-2"><?= $track->UnitPrice ?>€</td>
                <?php if($user instanceof Customer): ?>
                    <?php if($user->hasTrack($track->TrackId)): ?>
                        <td class="p-2 rounded-r-lg"><i class="fa-solid fa-download" title="Télécharger la musique"></i></td>
                    <?php else: ?>
                        <td class="p-2 rounded-r-lg"><i class="fa-solid fa-cart-shopping cursor-pointer" title="Acheter la musique"></i></td>
                    <?php endif; ?>
                <?php elseif($user->Title == "IT Manager" || $user->Title == "IT Staff"): ?>
                    <td class="relative text-right p-2 rounded-r-lg">
                        <button type="button" class="add-to-playlist-button">
                            <i class="fa-solid fa-plus" title="Ajouter à une playlist"></i>
                        </button>
                        <div class="playlists-popup bg-slate-700 rounded-lg absolute -left-64 hidden z-10 text-left">
                            <ul class="w-72 p-2 h-48 shadow-2xl overflow-y-scroll">
                                <?php foreach($allPlaylists as $playlist): ?>
                                    <li class="ml-2 my-2">
                                        <a href="admin/playlists/<?= $playlist->PlaylistId ?>/add/<?= $track->TrackId ?>" class="text-slate-300 hover:text-white"><?= $playlist->Name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include('www/footer.inc.php'); ?>