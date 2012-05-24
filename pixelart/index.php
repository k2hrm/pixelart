<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="euc-jp">
    <title>gessojs</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/bootstrap/images/favicon.ico">
    <link rel="apple-touch-icon" href="/bootstrap/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">gessojs</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="/pixelart/">Pixel Art</a></li>
              <li><a href="/about.html">About</a></li>
              <li><a href="/contact.html">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Pixel Art</h1>
        <h2>gallery</h2>
        <p>ドット絵を作って投稿してみよう！！</p>
     </div>
     <!-- Example row of columns -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
  /*
  function setC() {
          var cc = document.f1.color.value;
          window.localStorage.setItem("color", cc);
          $("body").css("background-color",cc);
  }
  */
  $("select[name=color]").change(function(){
          var cc = document.f1.color.value;
          window.localStorage.setItem("color", cc);
          $("body").css("background-color",cc);
          });

  $("select[name=paintcolor]").change(function() {
          var pc = document.f1.paintcolor.value;
          window.localStorage.setItem("pcolor", pc);
          });


  function dLoad() {
          var ccc = window.localStorage.getItem("color");
          $("body").css("background-color",ccc);
          $("#grid div").each(function(i){
          var dcall = window.localStorage.getItem("dcol"+i);
          $("#grid div").eq(i).attr("class",dcall);
          });
          }

  function dSave() {
      $("#grid div").each(function(i) {
          var cls = $("#grid div").eq(i).attr("class");
          window.localStorage.setItem("dcol"+i,cls);
      });
  }


  $(function(){
    dLoad();
      for(var i=0;i<24*24;i++){
       $("#grid").append("<div>");
       $("#grid div").eq(i).attr({id:"div"+i});
       window.localStorage.setItem("div"+i,"off");
   }
   $("#grid div").click(function(){
     var pcol = window.localStorage.getItem("pcolor");
     $(this).toggleClass("on").addClass(pcol);
   });
 });

 //10秒おきに自動保存
 setInterval(function() {  dSave() }, 10000);

 $(function(){
   $("#grid div").click(function(){
     var gridval = $("#grid").html();
   $("input[name=text]").val(gridval);
   });
 });
</script>
<style>
div#grid,
div.grid {
  border-top:#ccc 1px solid;
  border-right:#ccc 1px solid;
  width: 264px;
  height: 264px;
}

div#grid div,
div.grid div {
  width:10px;
  height:10px;
  border-left:#ccc 1px solid;
  border-bottom:#ccc 1px solid;
  float:left;
}
div.on {
  background-color:#ccc;
}
div.on.red {
  background-color:red;
}
div.on.black {
  background-color:black;
}
div.on.blue {
  background-color:blue;
}
div.on.orange {
  background-color:orange;
}
div.on.brown {
  background-color:brown;
}

input[name=text] {
  display:none;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<form name="f1"> 背景色
  <select name="color">
  <option value="black" selected>black</option>
  <option value="red">red</option>
  <option value="blue">blue</option>
  <option value="orange">orange</option>
  <option value="brown">brown</option>
</select> 描画色
  <select name="paintcolor">
  <option value="black" selected>black</option>
  <option value="red">red</option>
  <option value="blue">blue</option>
  <option value="orange">orange</option>
  <option value="brown">brown</option>
</select>
</form>
<input type="button" value="保存！" onClick="javascript:dSave()">
<input type="button" value="保存データを呼び出し！" onClick="javascript:dLoad()">
<div id="grid"></div>
<?php
//データベースへの接続
mysql_connect( "mysql507.phy.lolipop.jp", "LA02758750","wfbsg6"); //データベースへ接続
mysql_select_db( "LA02758750-dentaqdb"); //データベースを選択

//----------------必要なデーターを集めデータを登録します-------------------

//ページから書き込みを受け取ります。
$text = $_POST["text"];
$name = $_POST["name"];

if(($text != "") and ($name != "")){ //新規データが空でない（つまり有る）ならば

$sql = 'INSERT INTO `bbs` (`no`, `name`, `text`) VALUES (\'\', \''.$name.'\', \''.$text.'\')';
mysql_query( $sql );
//bbsにデータを追加しなさい。というSQL文
}

//------------------ＨＴＭLフォーム出力部分---------------------------------

 //入力フォームを書き出します。
    echo "<br>";
    echo "<FORM action = \"index.php\" method=\"POST\">";
    echo "名前：<INPUT size=\"20\" type=\"text\" name=\"name\">　";
    echo "<INPUT size=\"50\" type=\"text\" name=\"text\">";
    echo "<INPUT type=\"submit\" value=\"書き込み\">";
    echo "</FORM>";
//------------------データベースを読みながら、HTMLを出力します-------------。

$sql = 'SELECT *FROM `bbs` ORDER BY `no` DESC LIMIT 0, 30 '; 
$res = mysql_query( $sql );
//bbsテーブルから、noを基準に０-３０件のデータを逆順（desc)で得る

while ( $row = mysql_fetch_array($res)){ //最後のデータになるまで繰返し

echo "<HR>"; // 線を引く
echo "【".$row["name"]."】"; 	//【名前】：文章で出力
echo '<div class="grid">';
echo $row["text"]; 	//【名前】：文章で出力
echo '</div>';
$i = 0;
$i = $i + 1;
}
?>
<hr>
<footer>
<p>&copy; gessojs 2012</p>
</footer>
</div> <!-- /container -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/bootstrap/js/jquery.js"></script>
<script src="/bootstrap/js/bootstrap-transition.js"></script>
<script src="/bootstrap/js/bootstrap-alert.js"></script>
<script src="/bootstrap/js/bootstrap-modal.js"></script>
<script src="/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="/bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="/bootstrap/js/bootstrap-tab.js"></script>
<script src="/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="/bootstrap/js/bootstrap-popover.js"></script>
<script src="/bootstrap/js/bootstrap-button.js"></script>
<script src="/bootstrap/js/bootstrap-collapse.js"></script>
<script src="/bootstrap/js/bootstrap-carousel.js"></script>
<script src="/bootstrap/js/bootstrap-typeahead.js"></script>
</body>
</html>
