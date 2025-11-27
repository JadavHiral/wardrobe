$(document).ready(function(){
  $(".sidebar li")
    .on("mouseenter", function(){
      $(this).css({
        "box-shadow": "0 6px 12px rgba(0,0,0,0.2)",
        "transform": "scale(1.05)",
        "transition": "all 0.3s ease"
      });
    })
    .on("mouseleave", function(){
      $(this).css({
        "box-shadow": "0 2px 5px rgba(0,0,0,0.1)",
        "transform": "scale(1)",
        "transition": "all 0.3s ease"
      });
    })
    .on("mousedown", function(){
      $(this).css({
        "transform": "scale(0.97)",
        "background-color": "#f3a6c4"
      });
    })
    .on("mouseup", function(){
      $(this).css({
        "transform": "scale(1.05)",
        "background-color": "#f3b6cc"
      });
    });
});
