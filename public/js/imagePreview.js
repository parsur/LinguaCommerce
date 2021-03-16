// Get media after selecting the picture
document.getElementById("images").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
      // get loaded data and render thumbnail.
      var img = document.getElementById("picture");
      img.src = e.target.result;
      // Image input style
      document.getElementById("images").style.marginBottom = "10px";
      // Hidden input
      document.getElementById("hidden_image").value = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};