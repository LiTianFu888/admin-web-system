 
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>layui客户后台系统</title>
    <link rel="stylesheet" href="<?php echo base_url().'static/common/layui/css/layui.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'static/admin/css/login.css'?>">
    <script src="<?php echo base_url().'static/common/layui/layui.js'?>"></script>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
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
        <li class="layui-nav-item">
          <a href="javascript:;">用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/user/index">用户查询</a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">内容主体区域
      <div class ="layui-form-item">
      </div>
      <div id="main1" style="width: 800px;height:400px;" ></div>
      <div class ="layui-form-item">
      </div>
      <div id="main2" style="width: 800px;height:400px;" ></div>
      <div class ="layui-form-item">
      </div>
      <div id="main3" style="width: 800px;height:400px;" ></div>
      <div class ="layui-form-item">
      </div>
      <div id="main4" style="width: 800px;height:400px;" ></div>
</div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="<?php echo base_url().'static/common/layui/layui.js'?>"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
<script>
   function echart1()
   {
       $.post('/home/echart12',function(info){
           //查看info是否为json对象 如果是不用JSON.parse
           //如果是json字符串需要转成json对象
           info = JSON.parse(info);
           console.log(info);
           chart.setOption({
               series:[{
                   data:info,
               }],
               legend: {                                //图例，每个图表最多仅有一个图例。
                   data: [
                       info[0]['name'],
                       info[1]['name'],
                       info[2]['name'],
                       info[3]['name'],
                       info[4]['name'],
                   ],
               },
           })
       });
       var chart = echarts.init(document.getElementById('main1'));
       // 指定图表的配置项和数据
       var option = {
           title: {
               text: '商品前五名销售额占比',        //主标题文本
               subtext: '销售额(元)',            //副标题文本
               x: 'center'                    //标题水平安放位置
           },
//                calculable: true,                        //是否启用拖拽重计算特性，默认关闭
           series: [{                                //数据内容
               name: '销售额',                        //系列名称，如启用legend，该值将被legend.data索引相关
               type: 'pie',                        //图表类型，必要参数！
               radius: '55%',                        //半径
               center: ['50%', '60%'],                //圆心坐标
               data: [],
           }],
           tooltip: {                         //提示框，鼠标悬浮交互时的信息提示
               trigger: 'item',            //触发类型，默认数据触发，可选值有item和axis
               formatter: "{a} <br/>{b} : {c} ({d}%)",    //鼠标指上时显示的数据  a（系列名称），b（类目值），c（数值）, d（占总体的百分比）
               backgroundColor: 'rgba(0,0,0,0.7)'    //提示背景颜色，默认为透明度为0.7的黑色

           },
           legend: {                                //图例，每个图表最多仅有一个图例。
               orient: 'vertical',                    //布局方式，默认为水平布局，可选值有horizontal(竖直)和vertical(水平)
               x: 'left',                            //图例水平安放位置，默认为全图居中。可选值有left、right、center
               data: [],
           },
           toolbox: {                                //工具箱，每个图表最多仅有一个工具箱。
               show: true,                            //显示策略，可选为：true（显示） | false（隐藏）
               feature: {                            //启用功能
//                        mark: {                            //辅助线标志
//                            show: true
//                        },
                   dataView: {                        //数据视图
                       show: true,
                       readOnly: false                //readOnly 默认数据视图为只读，可指定readOnly为false打开编辑功能
                   },
                   restore: {                        //还原，复位原始图表   右上角有还原图标
                       show: true
                   },
                   saveAsImage: {                    //保存图片（IE8-不支持），默认保存类型为png，可以改为jpeg
                       show: true,
                       type:'jpeg',
                       title : '保存为图片'
                   }
               }
           }
       };
       // 使用刚指定的配置项和数据显示图表。
       chart.setOption(option);
   }
   echart1();
</script>
<script>
   function echart2()
   {
       $.post('/home/linechart1',function(info){
           //查看info是否为json对象 如果是不用JSON.parse
           //如果是json字符串需要转成json对象
           info = JSON.parse(info);
           console.log(info);
           linechart.setOption({
               series:[{
                   data:info,
               }],
               xAxis: [{                                //图例，每个图表最多仅有一个图例。
                   data: [
                       info[0]['name'],
                       info[1]['name'],
                       info[2]['name'],
                       info[3]['name'],
                       info[4]['name'],
                   ],
               }],
           })
       });
       var linechart = echarts.init(document.getElementById('main2'));
       var  option = {
           title: {
               text: '品牌前五名销售量',        //主标题文本
               subtext: '销售量(订单数）',            //副标题文本
               x: 'center'                    //标题水平安放位置
           },
           color: ['#3398DB'],
           tooltip: {
               trigger: 'axis',
               axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                   type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
               }
           },
           grid: {
               left: '3%',
               right: '4%',
               bottom: '3%',
               containLabel: true
           },
           xAxis: [
               {
                   type: 'category',
                   data: [],
                   axisTick: {
                       alignWithLabel: true
                   }
               }
           ],
           yAxis: [
               {
                   type: 'value'
               }
           ],
           series: [
               {
                   name: '销售量',
                   type: 'bar',
                   barWidth: '60%',
                   data: [],
               }
           ]
       };
       linechart.setOption(option);
   }
   echart2();
</script>
<script>
    function echart3()
    {
        $.post('/home/echart34',function(info){
            //查看info是否为json对象 如果是不用JSON.parse
            //如果是json字符串需要转成json对象
            info = JSON.parse(info);
            console.log(info);
            chart2.setOption({
                series:[{
                    data:info,
                }],
                legend: {                                //图例，每个图表最多仅有一个图例。
                    data: [
                        info[0]['name'],
                        info[1]['name'],
                        info[2]['name'],
                        info[3]['name'],
                        info[4]['name'],
                    ],
                },
            })
        });
        var chart2 = echarts.init(document.getElementById('main3'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '品牌前五名销售额占比',        //主标题文本
                subtext: '销售额(元)',            //副标题文本
                x: 'center'                    //标题水平安放位置
            },
//                calculable: true,                        //是否启用拖拽重计算特性，默认关闭
            series: [{                                //数据内容
                name: '销售额',                        //系列名称，如启用legend，该值将被legend.data索引相关
                type: 'pie',                        //图表类型，必要参数！
                radius: '55%',                        //半径
                center: ['50%', '60%'],                //圆心坐标
                data: [],
            }],
            tooltip: {                         //提示框，鼠标悬浮交互时的信息提示
                trigger: 'item',            //触发类型，默认数据触发，可选值有item和axis
                formatter: "{a} <br/>{b} : {c} ({d}%)",    //鼠标指上时显示的数据  a（系列名称），b（类目值），c（数值）, d（占总体的百分比）
                backgroundColor: 'rgba(0,0,0,0.7)'    //提示背景颜色，默认为透明度为0.7的黑色

            },
            legend: {                                //图例，每个图表最多仅有一个图例。
                orient: 'vertical',                    //布局方式，默认为水平布局，可选值有horizontal(竖直)和vertical(水平)
                x: 'left',                            //图例水平安放位置，默认为全图居中。可选值有left、right、center
                data: [],
            },
            toolbox: {                                //工具箱，每个图表最多仅有一个工具箱。
                show: true,                            //显示策略，可选为：true（显示） | false（隐藏）
                feature: {                            //启用功能
//                        mark: {                            //辅助线标志
//                            show: true
//                        },
                    dataView: {                        //数据视图
                        show: true,
                        readOnly: false                //readOnly 默认数据视图为只读，可指定readOnly为false打开编辑功能
                    },
                    restore: {                        //还原，复位原始图表   右上角有还原图标
                        show: true
                    },
                    saveAsImage: {                    //保存图片（IE8-不支持），默认保存类型为png，可以改为jpeg
                        show: true,
                        type:'jpeg',
                        title : '保存为图片'
                    }
                }
            }
        };
        // 使用刚指定的配置项和数据显示图表。
        chart2.setOption(option);
    }
    echart3();
</script>
<script>
    function echart4()
    {
        $.post('/home/linechart2',function(info){
            //查看info是否为json对象 如果是不用JSON.parse
            //如果是json字符串需要转成json对象
            info = JSON.parse(info);
            console.log(info);
            linechart2.setOption({
                series:[{
                    data:info,
                }],
                xAxis: [{                                //图例，每个图表最多仅有一个图例。
                    data: [
                        info[0]['name'],
                        info[1]['name'],
                        info[2]['name'],
                        info[3]['name'],
                        info[4]['name'],
                    ],
                }],
            })
        });
        var linechart2 = echarts.init(document.getElementById('main4'));
        var  option = {
            title: {
                text: '商品前五名销售量',        //主标题文本
                subtext: '销售量(订单数）',            //副标题文本
                x: 'center'                    //标题水平安放位置
            },
            color: ['#3398DB'],
            tooltip: {
                trigger: 'axis',
                axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: [],
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: '销售量',
                    type: 'bar',
                    barWidth: '60%',
                    data: [],
                }
            ]
        };
        linechart2.setOption(option);
    }
    echart4();
</script>
</body>
</html>
