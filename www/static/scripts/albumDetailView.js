addEventListener('DOMContentLoaded', () => {

    const addTrackToPlaylistButtons = document.querySelectorAll('.add-to-playlist-button');
    
    document.addEventListener('click', (e) => {
        const openPlaylistsPopup = document.querySelector('.playlists-popup:not(.hidden)');
        if(!e.target.parentNode.classList.contains('add-to-playlist-button')) {
            if(openPlaylistsPopup && !openPlaylistsPopup.contains(e.target)) {
                openPlaylistsPopup.classList.add('hidden');
            }
        }
    })

    addTrackToPlaylistButtons.forEach(button => {
        button.addEventListener('click', () => {
            addTrackToPlaylistButtons.forEach(btn => {
                if(btn !== button) {
                    btn.parentNode.querySelector('.playlists-popup').classList.add('hidden');
                } else {
                    btn.parentNode.querySelector('.playlists-popup').classList.toggle('hidden');
                }
            });
        })
    });


});