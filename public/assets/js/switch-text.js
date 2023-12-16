const userTypeSelect = document.getElementById("userTypeSelect");
const messageContainer = document.getElementById("messageContainer");
const selectedUserType = document.getElementById("selectedUserType");

userTypeSelect.addEventListener("change", function() {

    const selectedValue = userTypeSelect.value;

    if (selectedValue === "user" || selectedValue === "breeder") {
        selectedUserType.textContent = selectedValue;
        messageContainer.style.display = "block";
    
        if (selectedValue === "breeder") {
            window.location.href = "breeder.php";
        } else if (selectedValue === "user") {
            window.location.href = "user.php";
        }
    } else if (selectedValue === "admin") {
        window.location.href = "admin.php";
    } else {
        messageContainer.style.display = "none";
    }    
});

