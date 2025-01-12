function initializeImageSwitch(isURL, obrazok) {

    const fileOption = document.getElementById('imageSwitchFile');
    const urlOption = document.getElementById('imageSwitchURL');
    const fileUploadContainer = document.getElementById('fileUploadContainer');
    const urlInputContainer = document.getElementById('urlInputContainer');
    const fileInput = document.getElementById('fileInput'); // File input field
    const urlInput = document.getElementById('urlInput');   // URL input field


    if (isURL == 1) {
        urlOption.checked = true;
        fileUploadContainer.style.display = 'none';
        urlInputContainer.style.display = 'block';
        urlInput.value = obrazok;
    } else {
        fileOption.checked = true;
        fileUploadContainer.style.display = 'block';
        urlInputContainer.style.display = 'none';
        urlInput.value = '';
    }


    fileOption.addEventListener('change', function () {
        if (fileOption.checked) {
            fileUploadContainer.style.display = 'block';
            urlInputContainer.style.display = 'none';
            urlInput.value = '';
        }
    });

    urlOption.addEventListener('change', function () {
        if (urlOption.checked) {
            fileUploadContainer.style.display = 'none';
            urlInputContainer.style.display = 'block';
            fileInput.value = '';
        }
    });
}
function switchForm() {
    var loginForm = document.querySelector('.form-signin');
    var signupForm = document.querySelector('.form-signup');

    if (loginForm.style.display !== 'none') {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
    } else {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
    }
}
function submitUserUpdateForm(event) {
    event.preventDefault();
    var form = document.getElementById('userUpForm');
    var formData = new FormData(form);



    fetch("http://localhost/?c=admin&a=update", {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(updatedUsers => {

            updateTable(updatedUsers);
            alert('Changes have been saved successfully.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}

function updateTable(users) {
    var table = document.getElementById('userTable');
    table.innerHTML = '';


    var tableHTML = '<tr><th>Username</th><th>Is Admin</th><th>Delete User</th></tr>';
    users.forEach(user => {
        tableHTML += '<tr>';
        tableHTML += '<td>' + user.meno + '</td>';
        tableHTML += '<td><input type="checkbox" name="admin[]" value="' + user.id + '" ' + (user.admin ? 'checked' : '') + '></td>';
        tableHTML += '<td><input type="checkbox" name="delete[]" value="' + user.id + '"></td>';
        tableHTML += '</tr>';
    });
    table.innerHTML = tableHTML;
}

document.addEventListener("DOMContentLoaded", () => {
    const stars = document.querySelectorAll(".star-icon");
    const favouritesContainer = document.querySelector(".favourites-container");

    stars.forEach(star => {
        star.addEventListener("click", () => {
            const postId = star.getAttribute("data-id");
            const isFilled = star.classList.contains("filled");
            const action = isFilled ? "remove" : "add";

            // Send JSON data to the server
            fetch("http://localhost/?c=favourite&a=update", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ postId, action }),
            })
                .then(response => response.json())
                .then(() => {
                    if (action === "add") {
                        addFavouriteToUI(postId, star);
                    } else {
                        star.className = "star-icon far fa-star";
                        removeFavouriteFromUI(postId);
                    }
                })
                .catch(err => console.error("Error updating favourites:", err));
        });
    });


    function addFavouriteToUI(postId, star) {
        const noFavouritesMessage = document.querySelector(".no-favourites");


        const existingFavourite = favouritesContainer.querySelector(`[data-id="${postId}"]`);
        if (existingFavourite) return;


        const postCard = star.closest(".image-container");
        const imageElement = postCard.querySelector("img");
        const favouriteClone = document.createElement("div");


        favouriteClone.className = "col-md-3 col-6 mb-4 favourite-item";
        favouriteClone.setAttribute("data-id", postId);
        favouriteClone.innerHTML = `
            <a href="#">
                <img src="${imageElement.src}" alt="Favourite Book" class="img-fluid rounded shadow-sm">
            </a>
            <i class="star-icon filled fas fa-star" data-id="${postId}"></i>
        `;


        const favouriteStar = favouriteClone.querySelector(".star-icon");
        favouriteStar.addEventListener("click", () => {
            const isFilled = favouriteStar.classList.contains("filled");
            const action = isFilled ? "remove" : "add";


            fetch("http://localhost/?c=favourite&a=update", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ postId, action }),
            })
                .then(response => response.json())
                .then(() => {
                    if (action === "remove") {
                        removeFavouriteFromUI(postId); // Remove from favourites
                    }
                })
                .catch(err => console.error("Error updating favourites:", err));
        });


        if (noFavouritesMessage) {
            noFavouritesMessage.remove();
        }


        favouritesContainer.appendChild(favouriteClone);


        star.className = "star-icon filled fas fa-star";
    }


    function removeFavouriteFromUI(postId) {

        const favouriteToRemove = favouritesContainer.querySelector(`[data-id="${postId}"]`);


        if (favouriteToRemove) {
            favouritesContainer.removeChild(favouriteToRemove);
        } else {
            console.error(`Favourite with postId ${postId} not found in the favourites section.`);
        }


        if (favouritesContainer.children.length === 0) {
            const noFavouritesHTML = '<p class="text-center text-light no-favourites"> You have no favourites!</p>';
            favouritesContainer.innerHTML = noFavouritesHTML;
        }


        const mainStar = document.querySelector(`.image-container .star-icon[data-id="${postId}"]`);
        if (mainStar) {
            mainStar.className = "star-icon far fa-star";
        }
    }
});






