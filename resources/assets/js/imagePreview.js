// Get media after selecting the picture
document.getElementById("image").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
      // get loaded data and render thumbnail.
      var img = document.getElementById("picture");
      img.src = e.target.result;
      img.classList.add("image");
      // Image input style
      document.getElementById("image").style.marginBottom = "20px";
      // Hidden input
      document.getElementById("hidden_image").value = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};