<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/Admin/style.css"/>       
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
        <link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/js/Admin/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/typeahead-bs2.min.js"></script>
         <script src="/assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/handlers.js"></script>
        
</head>

<body>
<div class=" clearfix">
 <div id="add_brand" class="clearfix">
 <div class="left_add">
   <div class="title_name">添加品牌</div>
   <form action="{{route('brand_docreate')}}" method="post" enctype=multipart/form-data>
   @csrf
   <ul class="add_conent">
    <li class=" clearfix"><label class="label_name"><i>*</i>品牌名称：</label> <input name="name" type="text" class="add_text"/></li>
    <li class="clearfix"><label class="label_name">品牌图片：</label>
        <input type="file" name="logo" id="" class="preview">
    </li>
         <li class=" clearfix"><label class="label_name"><i>*</i>所属地区：</label> <input name="region" type="text" class="add_text" style="width:120px"/></li>
         <li class=" clearfix"><label class="label_name">品牌描述：</label> <textarea name="content" cols="" rows="" class="textarea" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></li>
         <li class=" clearfix"><label class="label_name"><i>*</i>显示状态：</label> 
         <label><input name="is_show" type="radio" class="ace" checked="checked"><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <label><input type="radio" class="ace" name="is_show"><span class="lbl">不显示</span></label>
         </li>
   </ul>
   <div class="">
       <input type="submit" class="btn btn-warning">
       <input type="reset" value="取消" class="btn btn-warning"/></div>
</div>

   </form>
  
</div>
</body>
</html>
<script type="text/javascript" src="/js/Admin/img_preview.js"></script>