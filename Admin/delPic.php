<?php
/**
 * 删除图片  地址+源图
 */
header("content-type:text/html;charset=utf8");
require_once '../Common/function.php';
require_once '../Common/mysql.php';
initDb();
checkLogin();

$id = isset($_GET['id']) ? $_GET['id'] : 0;
if($id <= 0){
	back('参数错误');
}

// 根据主键id查找图片信息，获取图片地址去服务器上删除源图
$sql = "select * from pics where id = {$id} limit 1";
$pic = findOne($sql);
// 删除源图 unlink
unlink('../Public/Upload/' . $pic['pic_url']);

// 删除数据库中的对应记录
$sql = "delete from pics where id = {$id}";
$rs = mysql_query($sql);
if($rs){
	jump('图片删除成功', 'Admin/picList.php', 3);
} else {
	jump('图片删除失败', 'Admin/picList.php', 3);
}