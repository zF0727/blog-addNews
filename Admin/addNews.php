<?php
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();
//验证数据合法性
if(!empty($_POST)){
    if(empty($_POST['title'])) back ('标题不能为空');
    if(empty($_POST['content'])) back ('内容不能为空');
    //入库
    $user_id = $_SESSION['user_id']; //当前登录的用户id
	$title   = trim($_POST['title']);
	$content   = trim($_POST['content']);
	$addtime = time();
    $sql = "insert into news values (null, {$user_id}, '{$title}', '{$content}', {$addtime})";
    $rs = mysql_query($sql);
	if($rs){
		// 插入成功
		jump('新闻发布成功', 'Admin/list.php', 3);
	} else {
		// 插入失败
		jump('新闻发布失败', 'Admin/addNews.php', 2);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>发布新闻</title>
  <link rel="stylesheet" href="../Public/css/basic.css">
</head>
<body>
  <div class="top">
  <h2>发布新闻</h2>
</div>
<div class="nav">
  <ul>
   <li><a href="index.php">后台首页</a></li>
   <li><a href="addNews.php">发布文章</a></li>
   <li><a href="list.php">文章列表</a></li>
   <li><a href="addNav.php">导航添加</a></li>
   <li><a href="nav.php">导航列表</a></li>
   <li><a href="addPics.php">上传图片</a></li>
   <li><a href="picList.php">相册列表</a></li>
   <li><a href="logout.php">退出后台</a></li>
 </ul>
</div>
<div class="main">
  <form class="form" action="" method="post">
    <label>标题：<input type="text"  name="title" /></label><br>
    <label>内容：<textarea name="content"></textarea></label><br>
    <div class="btn">
      <input type="reset" />
      <input type="submit" value="发布" />
    </div>
  </form>
</div>
</body>
</html>