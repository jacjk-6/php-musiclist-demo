<?php

//判断用户的URL中是否有id 属性
if (empty($_GET['id'])) {
	exit('<h1>必需指定参数<h1>');
}

//找到要删除的数据
$id=$_GET['id'];
// var_dump($id);

$data=json_decode(file_get_contents('storage.json'),true);

foreach ($data as $key) {
	if ($key['id']!=$id) continue;
// //图片删除文件
// 	$picture_file='http://site2.pc/'.$key['image'];
// 	// $picture_file=fopen($picture_path, 'r');
// 	var_dump($picture_file);
// 	if(file_exists($picture_file)){
// 		if(unlink($picture_file)){
// 			echo "文件删除成功";
// 		}else{
// 			echo '文件删除失败';
// 		}
// 	}else{
// 		echo "文件目标不存在";
// 	}
	$index=array_search($key,$data);
	array_splice($data, $index, 1);
	$json=json_encode($data);
	file_put_contents('storage.json', $json);

header('Location: http://site2.pc/musiclist.php');
}


 ?>