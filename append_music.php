<?php
function add_music(){

	//校验用户有没有输入标题
if(empty($_POST['tittle'])){
	$GLOBALS['error_message'] = '请输入标题';
	return;
}
//校验用户有没有输入歌手
if(empty($_POST['actor'])){
	$GLOBALS['error_message']='请输入歌手';
	return;
}

//校验用户有没有上传文件

//判断客户端提交的表单有没有文件域
if(empty($_FILES['img'])){
	$GLOBALS['error_message']='请正确提交文件';
	return;
}
//判断用户是否上传了图片文件
$img=$_FILES['img'];

if(!($img['error']===UPLOAD_ERR_OK)){
	$GLOBALS['error_message']='请上传图片文件';
	return;
}
//校验文件大小和类型

if($img['size'] > 10* 1024 *1024){
	$GLOBALS['error_message']='图片文件过大';
	return;
}
if($img['size'] < 2 * 1024 ){
	$GLOBALS['error_message']='图片文件过小';
	return;
}

$allowed_pictures_type=array('image/png','image/jpg','image/jpeg');
if(!in_array($img['type'], $allowed_pictures_type)){
	$GLOBALS['error_message']='不支持的格式';
	var_dump($_FILES);
	return;
}


//校验用户上传的的表单有没有文件域
if(empty($_FILES['song'])){
	$GLOBALS['error_message']='请正确提交文件';
	return;
}

//校验用户是否上传了音乐文件
$song=$_FILES['song'];
if(!($song['error']===UPLOAD_ERR_OK)){
	$GLOBALS['error_message']='请上音乐文件';
	return;
}
//校验文件大小和类型

if($song['size'] > 50* 1024 *1024){
	$GLOBALS['error_message']='音乐文件过大';
	return;
}
if($song['size'] < 100 * 1024 ){
	$GLOBALS['error_message']='音乐文件过小';
	return;
}

$allowed_songs_type=array('audio/mp3','audio/wav','audio/wma','audio/ape','audio/flac','audio/ogg','audio/mpeg');
if(!in_array($song['type'], $allowed_songs_type)){
	$GLOBALS['error_message']='不支持的格式';
	return;
}

//移动图片文件
$picture_target='pictures/'.uniqid().'-'.$img['name'];
if(!move_uploaded_file($img['tmp_name'], $picture_target)){
	$GLOBALS['error_message']='上传失败';
	return;
}
//移动音乐文件
$song_target='songs/'.uniqid().'-'.$song['name'];
if(!move_uploaded_file($song['tmp_name'], $song_target)){
	$GLOBALS['error_message']='上传失败';
	return;
}

//数据存储

$tittle_append=$_POST['tittle'];
$actor_append=$_POST['actor'];
$image_path=$picture_target;
$song_path=$song_target;

$origin=json_decode(file_get_contents('storage.json'),true);

$origin[]=array(
'id'=>uniqid(),
'musicsname'=>$tittle_append,
'actor'=>$actor_append,
'image'=>$image_path,
'musicsource'=>$song_path
);

$json=json_encode($origin);
file_put_contents('storage.json', $json);


//跳转
echo "<script language='javascript' type='text/javascript'>";
echo "window.location.href='http://site2.pc/musiclist.php'";
echo "</script>";

}

if($_SERVER['REQUEST_METHOD']==='POST'){
	add_music();
}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>添加音乐</title>
	<link rel="stylesheet" type="text/css" href="append_music.css">
</head>
<body>
<div class="appendmusic">
	<h1 class="h1">添加新音乐</h1>
	<hr>
	<?php if (isset($error_message)): ?>
	<div class="alert">
		<?php echo $error_message; ?>
	</div>
     <?php endif ?>
	<form action="" method="post" <?php echo $_SERVER['PHP_SELF']; ?> enctype="multipart/form-data">
		<div class="form">
			<label class="tittle" for="tittle">标题</label><br>
			<input class="input" type="text" name="tittle" id="tittle">
		</div>
		<div class="form">
			<label class="tittle" for="tittle">歌手</label><br>
			<input class="input" type="text" name="actor" id="actor">
		</div><div class="form">
			<label class="tittle" for="">海报</label><br>
			<input class="file" type="file" name="img" id="img">
		</div><div class="form">
			<label class="tittle" for="">音乐</label><br>
			<input class="file" type="file" name="song" id="song">
			<button type="subbmit" class="btn">保 存</button>
	</form>
</div>

</body>
</html>