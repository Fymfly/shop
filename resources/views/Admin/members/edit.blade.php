<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/js/Admin/html5.js"></script>
<script type="text/javascript" src="/js/Admin/respond.min.js"></script>
<script type="text/javascript" src="/js/Admin/PIE_IE678.js"></script>
<![endif]-->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/Admin/style.css"/>       
<link href="/assets/css/codemirror.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/ace.min.css" />
      <link rel="stylesheet" href="/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
<link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />

</head>
<body>
   <div class="page_right_style">
   <div class="type_title">修改商品</div>
	<form action="{{route('members_doedit',['id'=>$members->id])}}" method="post" class="form form-horizontal" id="form-article-add">
		@csrf
        <div class="clearfix cl">
         <label class="form-label col-2"><span class="c-red">*</span>用户名：</label>
		 <div class="formControls col-10"><input type="text" class="input-text" value="{{$members->name}}" placeholder="" id="" name="name"></div>
		</div>
		<div class=" clearfix cl">
         <label class="form-label col-2">性别</label>
	     <div class="formControls col-10">
         <input name="sex" type="radio" class="ace" value="男" @if($members->sex=='男') checked @endif><span class="lbl">男</span>&nbsp;&nbsp;&nbsp;
        <input name="sex" type="radio" class="ace" value="女" @if($members->sex=='女') checked @endif><span class="lbl">女</span>                                                                                                       
         </div>
		</div>
		<div class="clearfix cl">
         <label class="form-label col-2"><span class="c-red">*</span>移动电话：</label>
		 <div class="formControls col-10"><input type="text" class="input-text" value="{{$members->mobile}}" placeholder="" id="" name="mobile"></div>
		</div>
        <div class="clearfix cl">
         <label class="form-label col-2"><span class="c-red">*</span>电子邮件：</label>
		 <div class="formControls col-10"><input type="text" class="input-text" value="{{$members->email}}" placeholder="" id="" name="email"></div>
		</div>
        <div class="clearfix cl">
         <label class="form-label col-2"><span class="c-red">*</span>家庭住址：</label>
		 <div class="formControls col-10"><input type="text" class="input-text" value="{{$members->region}}" placeholder="" id="" name="region"></div>
		</div>
        <div class="clearfix cl">
         <label class="form-label col-2"><span class="c-red">*</span>等级：</label>
		 <div class="formControls col-10"><input type="text" class="input-text" value="{{$members->grade_id}}" placeholder="" id="" name="grade_id"></div>
		</div>
	
		<div class="clearfix cl">
			<div class="Button_operation">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="icon-save "></i>保存并提交审核</button>
				<button onClick="article_save();" class="btn btn-secondary  btn-warning" type="button"><i class="icon-save"></i>保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
    </div>
</div>
</div>
<script src="/js/Admin/jquery-1.9.1.min.js"></script>   
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/typeahead-bs2.min.js"></script>
<script src="/assets/layer/layer.js" type="text/javascript" ></script>
<script src="/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="/Widget/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Widget/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/Widget/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Widget/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script src="/js/Admin/lrtk.js" type="text/javascript" ></script>
<!-- <script type="text/javascript" src="/js/Admin/H-ui.js"></script> 
<script type="text/javascript" src="/js/Admin/H-ui.admin.js"></script>  -->

</body>
</html>