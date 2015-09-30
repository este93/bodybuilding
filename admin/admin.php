<?php
	require "model.php"; 
	require_once "../config.php"; 
	$mask = User::Admin|User::SuperAdmin;
	$status = Session::get("status",User::Anonimous);
	if(($mask&$status)!=0){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>   
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../font-awesome-4.3.0/css/font-awesome.min.css">
	<script type="text/javascript" src="/bodybuilding/tinymce/js/tinymce/tinymce.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern",
        "image",
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
	entity_encoding : "raw",
    external_filemanager_path:"/bodybuilding/tinymce/ResponsiveFilemanager-master/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "/bodybuilding/tinymce/ResponsiveFilemanager-master/filemanager/plugin.min.js"}
});
</script>
</head>
<body>
	<div id="container">
		<header>
			<div id="header">
				<h2>BodyBuilding Serbia Admin panel welcome <?php echo strtoupper(Session::get("username")); ?></h2>
			</div>
		</header>
		<div id="main_border">
			<div id="main">
				<div id="sidebar">
					<div id="profile">
						<div id="avatar"><img src="" alt=""></div>
						<ul>
							<li><a href=""><h4>Super-Administrator</h4></a></li>
							<li><a href="http://localhost/bodybuilding/index.php" target="_blank">Pogledaj sajt</a></li>
							<li><a href="logout.php">Odjavi se</a></li>
						</ul>
					</div><!-- end of #profile -->
					<nav>
						<ul id="nesto">
						<?php 
							foreach($pages as $k=>$v){?>
								<li><a href="?id=<?php echo $k; ?>"><?php echo $v['name']; ?></a>
								<?php 
									if(array_key_exists("submenu",$v)){
										if(isset($_GET['id'])&&$_GET['id']==$k){
										echo "<ul id='submenu'>";
										foreach($v['submenu'] as $f=>$h){
											echo "<li><a href='?id={$k}&cat={$h}'>";
											echo ucfirst($f);
											echo "</a></li>";
										}
										echo "</ul>";
									}}
								?>
								<i class="<?php echo $v['icon']; ?>"></i>
								</li>
						<?php		
							}
						?>
						</ul>
					</nav>
				</div><!-- end of #sidebar -->
				<div id="main_content">
					<?php 
					$id_strane = isset($_GET['id'])?$_GET['id']:1;
					foreach($pages as $k=>$v){
						if($id_strane==$k)
							include $v['document'];
					}
					?>
				</div><!-- end of #main_content -->
			</div><!-- end of #main -->
		</div><!-- end of #main_border -->
	</div><!-- end of #container -->
<script>$("#sidebar").height($("#main_content").height());</script>
</body>
</html>
<?php  } else header("location: ../index.php");