//scheduling atomizer
var listarray2 = [];
var results2 = [];
var liststring2 = [];

//when time of the day is checked
$(".hour2").click(function(e)
{
  //check which class it belongs to
  var classList2 = this.className.split(/\s+/);
  for (var i = 0; i < classList2.length; i++) {
      if (classList2[i] === 'active') {
          //do something
          $(this).css("background-color", "#eee");
          $(this).removeClass("active");
      }else{
        $(this).css("background-color", "red");
        $(this).addClass("active");
      }
  }

  //Add class to element
  //but check before if id is in array. if so, remove it
  if(listarray2.includes(parseInt($(this).attr('id')))){
    //remove it
    var pos2 = listarray2.indexOf(parseInt($(this).attr('id')));
    listarray2.splice(pos2,1);
  }else{
    //add it
    listarray2.push(parseInt($(this).attr('id')));
  }

  if(listarray2.length>0){
    //arrange text
    var total2 = 0;
    listarray2.sort(function(a, b){return a-b});
    results2 = [];
    var first2 = true;
    var current2 = 0;
    for(var i = 0; i < listarray2.length; i++){
      if(first2){
        results2.push(listarray2[i]);
        current2 = listarray2[i];
        first2 = false;
        continue;
      }
      if(i == listarray2.length - 1){
        if(listarray2[i] - current2 > 1){
          results2.push(current2);
        }

        results2.push(listarray2[i]);
      }else{
        if(listarray2[i] == current2+1){
          current2 = listarray2[i];

        }else{
          results2.push(current2);
          current2 = listarray2[i];
          results2.push(listarray2[i]);
        }
      }

    }
    //phase 2
    var textpair2 = [];
    var next2 = 0;
    if(results2.length % 2 ==0){
      for(var i = 0; i < results2.length; i+=2){

        if(results2[i+1] +1 == 24){
          next2 = 0;
        }else{
          next2 = results2[i+1] +1;
        }
        if(next2 == 0){
          total2 += 24 - results2[i];
        }else{
          total2 += next2 - results2[i];
        }

        textpair2.push("From " + results2[i] + "h00 to " + next2 + "h00");
      }
    }else{
      for(var i = 0; i < results2.length-1; i+=2){
        if(results2[i+1] +1 == 24){
          next2 = 0;
        }else{
          next2 = results2[i+1] +1;
        }
        textpair2.push("From " + results2[i] + "h00 to " + next2 + "h00");

        if(next2 == 0){
          total2 += 24 - results2[i];
        }else{
          total2 += next2 - results2[i];
        }
      }
      if(results2[i] +1 == 24){
        next2 = 0;
      }else{
        next2 = results2[i] +1;
      }
      textpair2.push("From " + results2[i] + "h00 to " + next2 + "h00");

      if(next2 == 0){
        total2 += 24 - results2[i];
      }else{
        total2 += next2 - results2[i];
      }
    }
  }
  $("#sched2").empty();
  first2 = false;
  for(var i = 0; i < textpair2.length; i++){
    if(first2){
      $("#sched2").append("<br/>");
    }
    $("#sched2").append(textpair2[i]);
    first2 = true;
  }
  $("#tot2").empty();
  $("#tot2").append("<span class=\"data\">" + total2 + "</span>");
  //add to text
});

// When the user clicks on div, open the popup
function myFunction2() {
  var popup2 = document.getElementById("myPopup2");
  popup2.classList.toggle("show");
  blocked2 = true;
}
