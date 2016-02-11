$(document).ready(function(){

  $("#area").load("tabcontent.html #container_one"); //load default (input)

  $("#tabone").click(function(){
    $(this).addClass("active");
    $("#tabtwo").removeClass("active");
    $("#tabthree").removeClass("active");
    $("#area").load("#container_one"); //input
  });

  $("#tabtwo").click(function(){
    $(this).addClass("active");
    $("#tabone").removeClass("active");
    $("#tabthree").removeClass("active");
    $("#area").load("#container_two"); //validation
  });

  $("#tabthree").click(function(){
    $(this).addClass("active");
    $("#tabone").removeClass("active");
    $("#tabtwo").removeClass("active");
    $("#area").load("#container_three"); //output
  });

})
