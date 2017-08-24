<?php 
  header("content-type:text/html;charset=utf8");
  require_once('../Common/function.php');
  require_once('../Common/mysql.php');
  initDb();
  //判断用户是否有提交数据
  if(!empty($_POST)){
      // echo '<pre>';
      // var_dump($_POST);
      // echo '</pre>';
      // exit;
      if(empty($_POST['username'])) back('用户名不能为空');
      if(empty($_POST['password'])) back('密码不能为空');
      if($_POST['password'] !== $_POST['password1']) back('两次密码不一致');
      if(empty($_POST['mobile'])) back('手机号不能为空');

  //保证用户名的唯一性
  $sql = "select * from user where username = '{$_POST['username']}'";
  $query = mysql_query($sql);
  $result = mysql_fetch_array($query,MYSQL_ASSOC);
  if(!empty($result)){
    back('用户'.$_POST['username'].'已经被注册，请更改用户名');
  }

  //用户信息入库
  $_POST['password'] = md5($_POST['password']);//md5加密密码
  $now = time();//当前时间戳
  //组合入库的SQL语句
  $sql = "INSERT INTO user VALUES(NULL,'{$_POST['username']}','{$_POST['password']}','{$_POST['email']}','{$_POST['mobile']}',{$now})";
  $result = mysql_query($sql);
  if($result){
      jump('注册成功','Admin/login.php',3);
  }else{
      jump('注册失败','Admin/regist.php',3);
  }
  }
  
?> 
 
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>后台注册页</title>
   <link rel="stylesheet" href="../Public/css/basic.css" />
 </head>
 <body>
  <div class="top"><h2>注册页面</h2></div>
  <div class="main">
    <form class="form" action="" method="post"> 
      <label>用&ensp;户&ensp;名：<input type="text" name="username" /></label><br>
      <label>密&#12288;&#12288;码：<input type="password" name="password" /></label><br>
      <label>确认密码：<input type="password" name="password1" /></label><br>  
      <label>邮&#12288;&#12288;箱：<input type="text" name="email" /></label><br>
      <label>手&ensp;机&ensp;号：<input type="text" name="mobile" /></label><br>
      <div class="btn">
        <input type="reset" />
        <input type="submit" value="注册" />
        <a href="login.php">已有账号？点击登录</a>
      </div>
    </form>
  </div>
</body>
</html>