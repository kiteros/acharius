//Water intensity request
var slider2 = document.getElementById("myRange2");
var output2 = document.getElementById("demo2");
output2.innerHTML = slider2.value + "ml/sec"; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider2.oninput = function() {
    output2.innerHTML = this.value + "ml/sec";
}

$("#lsatus2").change(function() {
    if(this.checked) {
      //Light enabled
      $("#textcchange2").css('color', '#ffffff');
      $("#demo2").css('color', '#ffce0a');
      $.ajax({
        url: "http://88.122.117.20:1234/?w_s=1",
        context: document.body
      }).done();
    }else{
      //light disabled

      $("#textcchange2").css('color', '#6d6d6d');
      $("#demo2").css('color', '#6d6d6d');
      $.ajax({
        url: "http://88.122.117.20:1234/?w_s=0",
        context: document.body
      }).done();
    }
});
