
 
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>layui客户后台系统</title>
    <link rel="stylesheet" href="<?php echo base_url().'static/common/layui/css/layui.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'static/admin/css/login.css'?>">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">客服后台系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="/goods/manage">商品管理</a></li>
      <li class="layui-nav-item"><a href="/order/index">订单管理</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          <?php $user =$this->session->userdata('user');
		echo $user['username'];?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/login/logout">logout</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/goods/brand">品牌管理</a></dd>
            <dd><a href="/goods/manage">商品管理</a></dd>
            <dd><a href="/goods/size">尺码管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">订单管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/order/index">订单查询</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">库存管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/stock/index">库存查询</a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
        <div class ="layui-form-item">

        </div>  
        <div class="demoTable">
                <div class="demoTable">
                  品牌号：
                  <div class="layui-inline">
                  <input name="id" class="layui-input" id="demoReload" autocomplete="off" placeholder="请输入品牌号">
                  </div>
                <button class="layui-btn" data-type="reload">搜索</button>
        </div>
        </div>
        <div class ="layui-form-item">

        </div>  
        <div class="layui-btn-group demoTable">
                <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
                <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
                <button class="layui-btn" data-type="isAll">验证是否全选</button>
        </div>
   <div style="padding: 15px;">
 
<table class="layui-hide" id="LAY_table_user" lay-filter="demo"></table>
<!--    <table class="layui-table" lay-filter="demo" lay-data="{width: 892, height:330, url:'/goods/brandTable', page:true, id:'idTest'}">
    <thead>
    <tr>
      <th lay-data="{type:'checkbox', fixed: 'left'}"></th>
      <th lay-data="{field:'id', width:160, sort: true, fixed: true}">品牌ID</th>
      <th lay-data="{field:'name', width:80}">品牌名</th>
      <th lay-data="{field:'des', width:200}">描述</th>
      <th lay-data="{field:'is_del', width:160}">是否下架</th>
      <th lay-data="{field:'add_time', width:200, sort: true}">添加时间</th>
      <th lay-data="{fixed: 'right', width:178, align:'center', toolbar: '#barDemo'}">操作</th>
    </tr>
  </thead> -->
</table>
    </div>
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="<?php echo base_url().'static/common/layui/layui.js'?>"></script>
<script>
layui.use('table', function(){
  var table = layui.table;
   //监听表格复选框选择
  table.on('checkbox(demo)', function(obj){
    console.log(obj)
  });
  //监听工具条
  table.on('tool(demo)', function(obj){
    var data = obj.data;
    if(obj.event === 'detail'){
      layer.msg('ID：'+ data.id + ' 的查看操作');
    } else if(obj.event === 'del'){
      layer.confirm('确认关闭？', function(index){
                   $.ajax({
                        url: "/goods/brandDel",
                        type: "POST",
                        data: {id: data.id},
                        success: function (msg) {
                            if (msg == 200) {
                                //删除这一行
                                //关闭弹框
                                layer.close(index);
                                layer.msg("关闭成功！请刷新", {icon: 6});
                                location.reload();
                            } else {
                                layer.msg("关闭失败", {icon: 5});
                            }
                        }
                    });
        });
    } else if(obj.event === 'edit'){
      layer.alert('编辑行：<br>'+ JSON.stringify(data))
    }
  });
   
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
    ,url: '/goods/brandTable'
    ,cols: [[
      {type:'checkbox', fixed: 'left'}
      ,{field:'id', title: '品牌号', width:160, sort: true, fixed: true}
      ,{field:'name', title: '名称', width:160}
      ,{field:'des', title: '描述', width:200}
      ,{field:'is_del', title: '是否下架', width:160}
      ,{field:'add_time', title: '添加时间', sort: true, width:200}
      ,{fixed: 'right', title:"操作",width:178, align:'center', toolbar: '#barDemo'}
    ]]
    ,id: 'testReload'
    ,page: true
    ,height: 310
    ,width:1000
  });
 var $ = layui.$, active = {
     getCheckData: function(){ //获取选中数据
      var checkStatus = table.checkStatus('testReload')
      ,data = checkStatus.data;
      layer.alert(JSON.stringify(data));
    }
    ,getCheckLength: function(){ //获取选中数目
      var checkStatus = table.checkStatus('testReload')
      ,data = checkStatus.data;
      layer.msg('选中了：'+ data.length + ' 个');
    }
    ,isAll: function(){ //验证是否全选
      var checkStatus = table.checkStatus('testReload');
      layer.msg(checkStatus.isAll ? '全选': '未全选')
    }
	, reload: function(){
      var demoReload = $('#demoReload');
      
      //执行重载
      table.reload('testReload', {
        page: {
          curr: 1 //重新从第 1 页开始
        }
        ,where: {
            id: demoReload.val()
        }
	,url: '/goods/brandTable'
       	,method: 'get'
      }, 'data');
    }
  };
  
  $('.demoTable .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>

<script id="barDemo" type="text/html">
  <a class="layui-btn layui-btn-xs" lay-event="edit">查看</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">下架</a>
</script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>
