const hamburger = document.querySelector('.hamburger');

function toggleNav() {
    const navParent = document.querySelector(".navParent");
    if (navParent) {
        const navLeftPosition = navParent.style.left === "-600px" ? "0px" : "-600px"; // Toggles between opening and closing
        navParent.style.left = navLeftPosition;
        console.log("Nav toggled");
        
        // Change hamburger icon based on nav position
        hamburger.innerHTML = navLeftPosition === "-600px" ? '<img src="icons/menu.svg" alt="menu">' : '<img src="icons/cross.svg" alt="menu">';
    } else {
        console.error("Could not find .navParent element.");
    }
}

if (hamburger) { // Check if hamburger element exists
    hamburger.addEventListener('click', function() {
        toggleNav();
    });
} else {
    console.error("Could not find .hamburger element.");
}

const search = document.querySelector('.search');

function toggleSearch() {
    const searchContainer = document.querySelector(".searchContainer");
    if (searchContainer) {
        const searchdisplay = searchContainer.style.display === "none" ? "flex" : "none"; // Toggles between opening and closing
        searchContainer.style.display = searchdisplay;
        console.log("search toggled");
        
        // Change hamburger icon based on nav position
        search.innerHTML = searchdisplay === "none" ? '<lord-icon src="https://cdn.lordicon.com/fkdzyfle.json" trigger="hover" style="width:25px;height:25px"> </lord-icon>' : '<img src="icons/cross.svg" width="24" height="24" alt="menu">';
    } else {
        console.error("Could not find .navParent element.");
    }
}

if (search) { // Check if hamburger element exists
    search.addEventListener('click', function() {
        toggleSearch();
    });
} else {
    console.error("Could not find .hamburger element.");
}



