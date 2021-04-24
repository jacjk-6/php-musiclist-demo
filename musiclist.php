
<?php

	$contents=file_get_contents('storage.json');
	// var_dump($contents);
	$data=json_decode($contents,true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>千比特</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="list.css">

<style type="text/css">
  img{
        width: 100px;
        height: 60px;
  }
  *{
    margin: 0;
    padding:0;
  }
  a{
    text-decoration: none;
    font-style: normal;
    color:black;
  }
  footer{
    width: 100%;
    height: 50px;
    position: fixed;
    bottom: 0;
    font-size: 5px;
    text-align: center;
  }
 
</style>
</head>
<body class="body">
	<div class="banner">
	<div class="tittle ">音乐列表</div>
<a class="tj" href="http://www.1kbit.com/append_music.php">添 加 音 乐</a>
<hr>
<table class="tb"  cellpadding="5" cellspacing="0" >
  <thead class="thead">
  <tr>
    <td>歌名</td>
    <td>歌手</td>
    <td>海报</td>
    <td>音乐</td>
    <td>操作</td>
  </tr>
  <tbody class="t-b">
  	<?php foreach ($data as $item): ?>
  <tr>
    <td><?php echo $item['musicsname'] ?></td>
    <td><?php echo $item['actor'] ?></td>
    <td><img src="<?php echo $item['image'] ?>"></td>
    <td><audio class="audio" src=" <?php echo $item['musicsource'] ?>" controls="controls"></audio></td>
    <td><a href="http://www.1kbit.com/delete_music.php?id=<?php echo $item['id'] ?>" class="dele">删除</a></td>
  </tr>
      <?php endforeach ?>
  </tbody>
  </thead>
</table>
	</div>

<footer><p calss="text-content">©
<a href="http://www.1kbit.com">1kbit.com</a>
版权所有 个人备案号：
<a href="http://beian.miit.gov.cn">青ICP备20000750</a>
</p></footer>
<script src="list.js"></script>
</body>
</html>