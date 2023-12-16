let fileInput = document.getElementById("file-input");
let imageContainer = document.getElementById("images");
let numOfFiles = document.getElementById("num-of-files");

function preview() {
    let selectedFiles = fileInput.files;

    if (selectedFiles.length > 0 && selectedFiles.length <= 5) {
        numOfFiles.textContent = `${selectedFiles.length} Files Selected`;

        // Clear previous images
        imageContainer.innerHTML = "";

        for (let i = 0; i < selectedFiles.length; i++) { // Fix here
            let reader = new FileReader();
            let figure = document.createElement("figure");

            reader.onload = () => {
                let img = document.createElement("img");
                img.setAttribute("src", reader.result);
                figure.appendChild(img); // Append only the image, without file name
            };

            reader.readAsDataURL(selectedFiles[i]);
            imageContainer.appendChild(figure);
        }
    } else if (selectedFiles.length > 5) {
        numOfFiles.textContent = "You can select a maximum of 5 files.";
    } else {
        numOfFiles.textContent = "No Files Chosen";
    }
}

 // JavaScript to open and close the modal for homepage post
 const openModalBtn = document.getElementById('openModalBtn');
 const closeModalBtn = document.getElementById('closeModalBtn');
 const modal = document.getElementById('myModal');

 openModalBtn.addEventListener('click', () => {
     modal.style.display = 'block';
 });

 closeModalBtn.addEventListener('click', () => {
     modal.style.display = 'none';
 });

 // Close the modal if the user clicks outside of it
 window.addEventListener('click', (event) => {
     if (event.target === modal) {
         modal.style.display = 'none';
     }
 });

// Get the like button and the count span
const likeButton = document.querySelector('.like-button');
const countSpan = document.querySelector('.like-count');

let count = 0;
let liked = false; // Track if the post has been liked

// Function to update the count and display it
function updateCount() {
    countSpan.textContent = count;
}

// Add an event listener for the like button
likeButton.addEventListener('click', () => {
    if (!liked) {
        count++;
        liked = true;
        likeButton.innerHTML = '<i class="fas fa-thumbs-up" style="color:#48aae2;"></i> Liked';
        countSpan.style.display = 'inline'; // Show the count span
        updateCount();
    } else {
        count--;
        liked = false;
        likeButton.innerHTML = '<i class="far fa-thumbs-up"></i> Like';
        countSpan.style.display = 'none'; // Hide the count span
        updateCount();
    }
});
