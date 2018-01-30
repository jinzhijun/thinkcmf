<?php if (!defined('THINK_PATH')) exit(); $portal_index_lastnews="1,2"; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/3.jpg", "slide_url"=>"", ), ); $CSS_URL = $tmpl."Public/hp/css/"; $IMG_URL = $tmpl."Public/hp/img/"; $JS_URL = $tmpl."Public/hp/js/"; $SITE_URL = $tmpl."Public/hp/js/"; $I_URL = $tmpl."Public/hp/i/"; $CITY_URL = $tmpl."Public/hp/js/"; $DATA_URL = $tmpl."Public/hp/data/"; ?>

<link rel="stylesheet" href="<?php echo ($CSS_URL); ?>amazeui.min.css"/>
<link rel="stylesheet" href="<?php echo ($CSS_URL); ?>admin.css">



<div class="am-cf admin-main">

  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">预约</strong> / <small>Appointment</small></div>
      </div>

      <hr>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <!--<div class="am-btn-toolbar">-->
            <!--<div class="am-btn-group am-btn-group-xs">-->
              <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>-->
              <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>-->
              <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>-->
              <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>-->
            <!--</div>-->
          <!--</div>-->
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <!--<div class="am-form-group">-->
            <!--<select data-am-selected="{btnSize: 'sm'}">-->
              <!--<option value="option1">所有类别</option>-->
              <!--<option value="option2">IT业界</option>-->
              <!--<option value="option3">数码产品</option>-->
              <!--<option value="option3">笔记本电脑</option>-->
              <!--<option value="option3">平板电脑</option>-->
              <!--<option value="option3">只能手机</option>-->
              <!--<option value="option3">超极本</option>-->
            <!--</select>-->
          <!--</div>-->
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field" id="queryStr">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button" onclick="Jumppage()">搜索</button>
          </span>
          </div>
        </div>
      </div>

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <div id="tablelist">

            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox"/></th>
                <th class="table-id">ID</th>
                <th class="table-title">患者</th>
                <th class="table-title">医生</th>
                <th class="table-date am-hide-sm-only">就诊日期</th>
                <th class="table-date am-hide-sm-only">就诊时间</th>
                <th class="table-title">联系电话</th>

                <!--<th class="table-set">操作</th>-->
              </tr>
              </thead>
              <tbody>
              <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$appointment): $mod = ($i % 2 );++$i;?><tr>
                <td><input type="checkbox"/></td>
                <td><?php echo ($appointment["id"]); ?></td>
                <td><?php echo ($appointment["patientname"]); ?></td>
                <td><?php echo ($appointment["doctorname"]); ?></td>
                <td class="am-hide-sm-only"><?php echo ($appointment["curetime"]); ?></td>
                <?php if(($appointment["flag"] == 0)): ?><td class="am-hide-sm-only">上午</td>
                  <?php elseif(($appointment["flag"] == 1)): ?>
                  <td class="am-hide-sm-only">下午</td>
                  <?php else: ?>
                  <td class="am-hide-sm-only">未知</td><?php endif; ?>

                <td class="am-hide-sm-only"><?php echo ($appointment["mobile"]); ?></td>

                <!--<td>-->
                  <!--<div class="am-btn-toolbar">-->
                    <!--<div class="am-btn-group am-btn-group-xs">-->
                      <!--<?php if(($appointment["statuscode"]) == "0"): ?>-->
                        <!--<button class="am-btn am-btn-default am-btn-xs am-text-secondary"-->
                                <!--onclick='passAppointment("<?php echo ($appointment["id"]); ?>")'><span-->
                                <!--class="am-icon-pencil-square-o"></span> 审核通过-->
                        <!--</button>-->
                        <!--<button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"-->
                                <!--onclick='cancelAppointment("<?php echo ($appointment["id"]); ?>")'><span-->
                                <!--class="am-icon-pencil-square-o"></span>-->
                          <!--审核失败-->
                        <!--</button>-->
                        <!--<?php else: ?>-->
                        <!--已处理-->
                      <!--<?php endif; ?>-->
                    <!--</div>-->
                  <!--</div>-->
                <!--</td>-->
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>

              </tbody>
            </table>
              </div>
            <!--<div id="pages">-->
              <!--<?php $__FOR_START_1851351579__=1;$__FOR_END_1851351579__=$pagenum;for($i=$__FOR_START_1851351579__;$i < $__FOR_END_1851351579__;$i+=1){ ?>-->
                <!--<span><a onclick="Jumppage(<?php echo ($i); ?>);" href="#"><?php echo ($i); ?></a>-->
                <!--</span>-->
              <!--<?php } ?>-->
            <!--</div>-->
            <div class="am-cf" id="tableFooter">
              共 <?php echo ($recordnum); ?> 条记录
              <div class="am-fr">
                <div id="pages">

                <ul class="am-pagination">
                  <li class="am-disabled"><a href="#">«</a></li>
                    <?php $__FOR_START_1179160976__=1;$__FOR_END_1179160976__=$pagenum+1;for($i=$__FOR_START_1179160976__;$i < $__FOR_END_1179160976__;$i+=1){ if(($i == 1)): ?><li class="am-active"><a onclick="Jumppage(this);" href="#"><?php echo ($i); ?></a></li>
                        <?php else: ?>
                        <li><a onclick="Jumppage(this);" href="#"><?php echo ($i); ?></a></li><?php endif; } ?>
                  <li><a href="#">»</a></li>
                </ul>
                  </div>
              </div>
            </div>
            <hr />
            <p>注：.....</p>
          </form>
        </div>

      </div>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>



  </div>
  <!-- content end -->
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php $portal_index_lastnews="1,2"; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.2.0发布啦！", "slide_pic"=>$tmpl."Public/assets/images/demo/3.jpg", "slide_url"=>"", ), ); $CSS_URL = $tmpl."Public/hp/css/"; $IMG_URL = $tmpl."Public/hp/img/"; $JS_URL = $tmpl."Public/hp/js/"; $SITE_URL = $tmpl."Public/hp/js/"; $I_URL = $tmpl."Public/hp/i/"; $CITY_URL = $tmpl."Public/hp/js/"; $DATA_URL = $tmpl."Public/hp/data/"; ?>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php echo ($JS_URL); ?>amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo ($JS_URL); ?>jquery.min.js"></script>
<!--<![endif]-->
<script src="<?php echo ($JS_URL); ?>amazeui.min.js"></script>
<script src="<?php echo ($JS_URL); ?>app.js"></script>


<script>
    jQuery("#logout").on("click", function(){
        $.post("/index.php/Admin/Doctor/../Index/logout",function(data,textStatus){
            if(data['rescode'] == "00" && textStatus == "success"){
//                alert("您已经登出成功!")
//                alert(data['msg']);
                window.location.href = "<?php echo ($CONTROLLER); ?>/../Login/login";
            }
            else{
                alert(data['msg']);
            }
        });
    })
</script>

<script>
  function Jumppage(page){
    var pagesize = 10;
    var pageNum = 1;
    var url = '/index.php/Admin/Doctor/appointment';
    var queryStr = $('#queryStr').val()
    if(page)  pageNum = page.innerHTML;


    jQuery(".am-active").removeClass("am-active");
    jQuery(page).parent("li").addClass("am-active");

    $("<div></div>").load(url,{queryStr:queryStr,page:pageNum,pagesize:pagesize},function(){

      var data = $(this).find("#tablelist").html();
      $('#tablelist').html(data);

      if(!page){
        var tableFooter = $(this).find("#tableFooter").html();
        $('#tableFooter').html(tableFooter);
      }

      $(this).remove();
    });
  }

  function passAppointment(appointmentId) {

    if (confirm("审核通过?")) {
      $.post("/index.php/Admin/Doctor/passAppointment", {id: appointmentId}, function (data, textStatus) {
        Jumppage();
      });
    }
  }

  function cancelAppointment(appointmentId) {

    if (confirm("审核失败?")) {
      $.post("/index.php/Admin/Doctor/cancelAppointment", {id: appointmentId}, function (data, textStatus) {
//      alert(data);
        Jumppage();
      });
    }
  }
</script>
</body>
</html>