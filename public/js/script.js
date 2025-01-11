function initializeImageSwitch(isURL, obrazok) {
    // Get the radio buttons and corresponding containers
    const fileOption = document.getElementById('imageSwitchFile');
    const urlOption = document.getElementById('imageSwitchURL');
    const fileUploadContainer = document.getElementById('fileUploadContainer');
    const urlInputContainer = document.getElementById('urlInputContainer');
    const fileInput = document.getElementById('fileInput'); // File input field
    const urlInput = document.getElementById('urlInput');   // URL input field

    // Initialize based on isURL value
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

    // Event listener to toggle between URL input and file upload
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


    // Send the form data to the PHP backend using AJAX
    fetch("http://localhost/?c=admin&a=update", {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json(); // Parse the JSON response
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(updatedUsers => {
            // Update the displayed table with the updated user data
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
    table.innerHTML = ''; // Clear the existing table

    // Rebuild the table with the updated user data
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
                         // Fill the star in the main section
                        addFavouriteToUI(postId, star);
                    } else {
                        star.className ="star-icon fas fa-star";
                        removeFavouriteFromUI(postId);
                    }
                })
                .catch(err => console.error("Error updating favourites:", err));
        });
    });

    // Function to add a favourite to the favourites section
    function addFavouriteToUI(postId, star) {
        const noFavouritesMessage = document.querySelector(".no-favourites");
        // Check if the card already exists in the favourites section
        const existingFavourite = favouritesContainer.querySelector(`[data-id="${postId}"]`);
        if (existingFavourite) return; // Do nothing if it already exists

        // Clone the post card from the main section
        const postCard = star.closest(".image-container");
        const favouriteClone = postCard.cloneNode(true);
        star.className = "star-icon filled fas fa-star";

        // Update the cloned card's star icon
        const favouriteStar = favouriteClone.querySelector(".star-icon");
        if (favouriteStar) {
            favouriteStar.className ="star-icon filled fas fa-star"; // Always filled in the favourites section
            favouriteStar.addEventListener("click", () => {
                // Handle toggle for the cloned card
                const isFilled = favouriteStar.classList.contains("filled");
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
                        if (action === "remove") {
                            removeFavouriteFromUI(postId); // Remove from favourites section
                        }
                    })
                    .catch(err => console.error("Error updating favourites:", err));
            });
        }

        // Ensure the cloned card has the correct `data-id` attribute
        favouriteClone.setAttribute("data-id", postId);

        // Remove "no favourites" message if present
        if (noFavouritesMessage) {

            try {
                noFavouritesMessage.remove();
                console.log("Message removed successfully.");
            } catch (error) {
                console.error("Failed to remove noFavouritesMessage:", error);
            }
        } else {
            console.log("noFavouritesMessage not found.");
        }

        // Append the cloned card to the favourites section
        favouritesContainer.appendChild(favouriteClone);
    }

    // Function to remove a favourite from the favourites section
    function removeFavouriteFromUI(postId) {
        // Find the card in the favourites section
        const favouriteToRemove = favouritesContainer.querySelector(`[data-id="${postId}"]`);

        // Ensure the card exists before removing
        if (favouriteToRemove) {
            favouritesContainer.removeChild(favouriteToRemove);
        } else {
            console.error(`Favourite with postId ${postId} not found in the favourites section.`);
        }

        // Show "no favourites" message if the favourites section is now empty
        if (favouritesContainer.children.length === 0) {
            const noFavouritesHTML = '<p class="text-center text-light no-favourites"> You have no favourites!</p></div>';
            favouritesContainer.innerHTML = noFavouritesHTML;
        }

        // Also unfill the star in the main section
        const mainStar = document.querySelector(`.image-container .star-icon[data-id="${postId}"]`);

        if (mainStar) {
            mainStar.className = "star-icon far fa-star";
        }
    }
});





