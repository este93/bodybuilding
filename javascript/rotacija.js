var images = [],
    requiredImages = 0,
    position = 0,
    front = true,
    rotating = false,
    doneImages = 0;
var img_paths = ['rotacija/frame_1.png','rotacija/frame_2.png','rotacija/frame_3.png','rotacija/frame_4.png' ,'rotacija/frame_5.png','rotacija/frame_6.png','rotacija/frame_7.png','rotacija/frame_8.png'];
    
function initImages(paths){
	requiredImages = paths.length;
	for (i in paths) {
		var img = new Image();
		img.src = paths[i];
		images[i] = img;
		images[i].onload = function(){
			doneImages++;
		}
	}
}
function checkImages(){
  if (doneImages >= requiredImages){
    $(".preloader").css({"display":"none"});
  } else {
    setTimeout(checkImages,1);
  }
}
function rotate(direction, speed){
 if (rotating == false ){
    rotating = true;
    $('.front').css({"display":"none"});
    $('.back').css({"display":"none"});
    setTimeout(function(){
      if (front){
        front= false;
        $(".back").css({"display":"block"});
      } else {
        front= true;
        $(".front").css({"display":"block"});
      }
    }, speed * 4.5);

    var counter = 0;
    if (direction == 'left'){ 
      var interval = setInterval(function(){
          position--;
          counter++;
          if (position < 0 ){
            position = images.length-1;
          }
         $("#front-image").attr('src', images[position].src);
         if (counter >= 4){
           clearInterval(interval);
           rotating = false;
         }
      },speed);

    } else if (direction == 'right') {
      var interval = setInterval(function(){
          position++;
          counter++;
          if (position >= images.length ){
            position = 0;
          }
         $("#front-image").attr('src', images[position].src);
         if (counter >= 4){
           
           clearInterval(interval);
          rotating = false;
         }
      },speed);
    }
  }
}
$(document).ready(function(){
  $(".klik").click(function(){ 
    $("#popup").animate({"z-index":"10"},0).animate({"opacity":"1"},400);
    var id = this.id;
    var div = $("#a").load("vezbe.php #"+id);
    div.show();
  });
});

initImages(img_paths);
checkImages();
$(document).ready(function(){
  $('.close').each(function(){
     $(this).click(function(){
       $(this).parent().css({"opacity":"0", "z-index":"-9"});
     });
  });
});


