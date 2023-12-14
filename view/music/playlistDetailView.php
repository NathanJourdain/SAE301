<?php 
include('www/header.inc.php'); 
?>

<div class="grid grid-cols-[30%_70%] gap-5 mb-10">
    <img src="www/static/Playlists/<?= $playlist->Image ?>" alt="Image de la playlist" class="w-full aspect-square object-cover">
    <div class="self-end">
        <p class="uppercase font-bold">Playlist</p>
        <h1 class="text-4xl font-black mb-5"><?= $playlist->Name ?></h1>
        <p><?= $numberOfTracks ?> titres</p>
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
            <?php $artist = $track->getArtist(); ?>
            <tr class="hover:bg-white/25">
                <td class="p-2 rounded-l-lg"><?= $track->Name ?> • <a href="artistes/<?= $artist->ArtistId ?>" class="text-slate-300"><?= $artist->Name ?></span></td>
                <td class="p-2"><?= $track->getDurationInMinutes() ?></td>
                <td class="p-2"><?= $track->UnitPrice ?>€</td>
                <?php if($user instanceof Customer): ?>
                    <?php if($user->hasTrack($track->TrackId)): ?>
                        <td class="p-2 rounded-r-lg text-right">
                            <i class="fa-solid fa-download" title="Télécharger la musique"></i>
                        </td>
                    <?php else: ?>
                        <td class="p-2 rounded-r-lg text-right">
                            <i class="fa-solid fa-cart-shopping cursor-pointer" title="Acheter la musique"></i>
                        </td>
                    <?php endif; ?>
                <?php elseif($user instanceof Employee && ($user->Title=="IT Staff" || $user->Title == "IT Manager")): ?>
                    <td class="p-2 rounded-r-lg text-right">
                        <a href="admin/playlists/<?= $playlist->PlaylistId ?>/remove/<?= $track->TrackId ?>" class="text-slate-300 hover:text-red-600">
                            <i class="fa-solid fa-trash" title="Supprimer la musique"></i>
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center text-xl mt-5">
    <?php if($page > 0): ?>
        <a href="playlists/<?= $id ?>?page=<?= $page - 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page précédente"><i class="fa-solid fa-arrow-left"></i></a>
    <?php endif; ?>
    
    <?php if($numberOfTracks > $page * 25 + 25): ?>
        <a href="playlists/<?= $id ?>?page=<?= $page + 1 ?>" class="py-1 px-2 rounded mr-1 bg-white/25 hover:bg-white/50" title="Page suivante"><i class="fa-solid fa-arrow-right"></i></a>
    <?php endif; ?>
</div>


<?php include('www/footer.inc.php'); ?>