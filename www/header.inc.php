<!doctype html>
<html lang="fr">
<head>
    <base href="/SAE301/">
    <meta charset="utf-8">
    <title>Toutuï - Catalogue musical</title>

    <link rel="shortcut icon" href="www/static/favicon.png" type="image/png">

    <link rel="stylesheet" href="www/static/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php if(isset($scripts)): ?>
        <?php foreach($scripts as $script): ?>
            <script src="<?= $script ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    

    <script>
        addEventListener('DOMContentLoaded', () => {
            const audio = new Audio("www/static/Toutuï.mp3");
            audio.load();
            let lastClick;
            document.querySelector('.logo').addEventListener('click', () => {
                const now = Date.now();
                if (lastClick && now - lastClick < 500) {
                    audio.currentTime = 0;
                    audio.play();
                }
                lastClick = now;
            })
        });
    </script>

</head>
<body class="grid grid-cols-[auto_1fr] bg-slate-900	text-white">
    <div class="row-span-2">
        <header class="bg-slate-700 ml-10 mt-10 rounded-t-xl sticky top-10">
            <img src="www/static/logotoutui.png" alt="logo" class="logo h-20">
        </header>
        <nav class="bg-slate-700 ml-10 mb-10 rounded-b-xl h-max sticky top-[7.5em]">
            <ul class="px-10">
                <?php if($_SESSION['user'] instanceof Customer): ?>
                    <li>
                        <a href="" class="mb-5 inline-block text-slate-300 hover:text-white">
                            <i class="fa-solid fa-home"></i>
                            <span class="pl-2">Accueil</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="genres" class="mb-5 inline-block text-slate-300 hover:text-white">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span class="pl-2">Genre</span>
                    </a>
                </li>
                <li>
                    <a href="artistes" class="mb-5 inline-block text-slate-300	hover:text-white">
                    <i class="fa-solid fa-microphone"></i>
                        <span class="pl-2">Artistes</span>
                    </a>
                </li>
                <li>
                    <a href="playlists" class="mb-5 inline-block text-slate-300	hover:text-white">
                        <i class="fa-solid fa-list"></i>
                        <span class="pl-2">Playlists</span>
                    </a>
                </li>
                <?php if($_SESSION['user'] instanceof Customer): ?>
                    <li>
                        <a href="mon-compte" class="mb-5 inline-block text-slate-300	hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="pl-2">Mon compte</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($_SESSION['user'] instanceof Employee): ?>
                    <li>
                        <a href="admin" class="mb-5 inline-block text-slate-300	hover:text-white">
                            <i class="fa-solid fa-user"></i>
                            <span class="pl-2">Admin</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <main class="p-10 col-start-2 row-start-1 row-end-3">