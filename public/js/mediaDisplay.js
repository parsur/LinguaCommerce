class mediaDisplay {
    // Display media data after editing
    mediaDisplay(data) {
        for (var all in data) {
            // Image
            setImage(data[all].image_url);
        }
    }
}


// Set Image
function setImage(image) {
    var img = document.getElementById("image");
    img.src = "/images/" + image;
    img.classList.add("image");
    // Hidden image
    document.getElementById("hidden_image").value = image;
}

// Get media after selecting the picture
document.getElementById("image_url").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        setImageTarget(e);
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

// Set image target
function setImageTarget(image) {
    // get loaded data and render thumbnail.
    var img = document.getElementById("image");
    img.src = image.target.result;
    img.classList.add("image");
    // Hidden image
    document.getElementById("hidden_image").value = image.target.result;
}