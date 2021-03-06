<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>管理员登录 - 电商客户系统</title>
    <link rel="stylesheet" href="<?php echo base_url().'static/common/layui/css/layui.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'static/admin/css/login.css'?>">
    <script src="<?php echo base_url().'static/common/layui/layui.js'?>"></script>
</head>

<body id="login">
<div class="login">
    <h2>客服后台系统</h2>
    <form class="layui-form" method="post" target="_blank" action="">
        <div class="layui-form-item">
            <input type="username" name="uname" placeholder="用户名" class="layui-input" lay-verify="required" />
            <i class="layui-icon input-icon">&#xe66f;</i>
        </div>
        <div class="layui-form-item">
            <input type="password" name="pwd" placeholder="密码"  class="layui-input"  lay-verify="required" />
            <i class="layui-icon input-icon">&#xe673;</i>
        </div>
        <!-- <div class="layui-form-item">
            <input type="checkbox" name="box" lay-skin="primary" title="记住密码" checked=""> <a class="back" href="javascript:;"  style="margin-top: 10px">忘记密码</a>
        </div> -->
        <div class="layui-form-item">
            <button style="width: 100%" class="layui-btn" lay-submit lay-filter="login">立即登录</button>

        </div>
    </form>
    <script>
        layui.use('form', function () {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery;
            form.on('submit(login)', function (data) {
                $.post('/login/signin',data.field,function(res){
                    if(res.code == 1000){
                        layer.msg(res.message, {time: 1000, end: function(){
                                window.location.href = '/home/index';
                            }});
                    }else{
                        layer.msg(res.message, {time: 2000});
                    }
                },'json');
                return false;
            });
        });
    </script>
</div>
</body>

</html>
