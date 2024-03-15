var popup = document.getElementById('popup');

if(popup){
    // Fermer le popup
    function closePopup() {
        popup.style.display = 'none';
    }
    
    document.addEventListener('click', function(e) {
        if (!popup.contains(e.target)) {
            closePopup();
        }
    })
}