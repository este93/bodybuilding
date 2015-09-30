// Pretraga - sidebar.php
function showResult(str) {
  var livesearch = document.getElementById("livesearch");
  if (str.length==0) { 
    livesearch.innerHTML="";
    livesearch.style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      livesearch.innerHTML=xmlhttp.responseText;
      livesearch.style.border="1px solid #A5ACB2";
      livesearch.style.padding="5px";
    }
  }
  xmlhttp.open("GET","process/search.php?txt="+str,true);
  xmlhttp.send();
}

// Najnovije,najcitanije.. - sidebar.php
$(document).ready(function(){
  $(".najnovije").click(function(){
    var a = $("#sidebar_news_main").load("sidebar_news.php #najnovije");
    a.hide();
    a.show(200);
    $(".najnovije").css("background","#ad0101");
    $(".najcitanije, .komentari").css("background","#333333");
    $(".najnovije").removeAttr("id"); 
  })
  $(".najcitanije").click(function(){
    var b = $("#sidebar_news_main").load("sidebar_news.php #najcitanije");
    b.hide();
    b.show(200);
    $(".najcitanije").css("background","#ad0101");
    $(".najnovije, .komentari").css("background","#333333");
    $(".najnovije").attr("id","kkk");
  })
  $(".komentari").click(function(){
    var c = $("#sidebar_news_main").load("sidebar_news.php #komentari");
    c.hide();
    c.show(200);
    $(".komentari").css("background","#ad0101");
    $(".najcitanije").css("background","#333333");
    $(".najnovije").attr("id","kkk");
  })
});

// Anketa - sidebar.php
$(function(){
  $("#myForm").submit(function() {
      var radiobutton = $("input[type='radio'][name='pool']:checked").val();
	  if(radiobutton = false){
		return false;
	  }
        $.post("process/vote.php", {name:radiobutton},function(info){
          $("#anketa_response").html(info);
        });
        var div = $("#poll_q");
        div.hide(500);
        var results = $("#results");
        results.show(300);
        return false;
  });
});
$(function(){
  $("#anketa_nazad").click(function() {
        var results = $("#results");
        results.hide(300);
        $(".pool").prop( "checked", false );
        var div = $("#poll_q");
        div.show(300);
  });
});

// Registracija - header.php
$(function(){
  $("#register_submit").click(function(){
    var username = $("input[type='text'][name='username']").val();
    var password = $("input[type='password'][name='password']").val();
    var letters = /^[A-Za-z]+$/;
    if(username.length < 4 || username.length > 10){
        $(".userErr").html("Morate uneti izmedju 4 i 10 karaktera!");
        return false;
      } else $(".userErr").empty();
      if(username.match(letters)){
      }else{
      $(".userErr").html("Dozvoljena su samo slova");
      return false;
     }
     if(password.length < 4 || password.length > 10){
      $(".passErr").html("Morate uneti izmedju 4 i 10 karaktera!");
      return false;
     } else $(".passErr").empty();

    $.post($("#register_form").attr("action"),
      $("#register_form :input").serializeArray(),
      function(info){
        $("#result").empty();
        $("#result").html(info);
        clear();
      });
    $("#register_form").submit(function(){
      return false;
    })
  });
function clear(){
  $("#register_form :input").each(function(){
    $(this).val("");
  })
}
});

