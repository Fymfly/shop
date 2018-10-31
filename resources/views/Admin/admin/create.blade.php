<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #F7F7F7;
      font-family: '微软雅黑';
    }

    form {
      max-width: 640px;
      width: 100%;
      margin: 24px auto;
      font-size: 28px;
    }

    label {
      display: block;
      margin: 10px 10px 15px;
      font-size: 24px;
    }

    input {
      display: block;
      width: 100%;
      height: 40px;
      font-size: 22px;
      margin-top: 10px;
      padding: 6px 10px;
      color: #333;
      border: 1px solid #CCC;
      box-sizing: border-box;
    }

    progress {
      display: block;
      width: 100%;
      margin-top: 10px;
    }

    .btn {
      margin-top: 30px;
    }

    .btn input {
      color: #FFF;
      background-color: green;
      border: 0 none;
      outline: none;
      cursor: pointer;
    }

    select {
        display: block;
        width: 100%;
        height: 40px;
        font-size: 22px;
        margin-top: 10px;
        padding: 6px 10px;
        color: #333;
        border: 1px solid #CCC;
        box-sizing: border-box;
    }
  </style>

</head>

<body>
  <form action="{{route('admin_docreate')}}" method="post" enctype=multipart/form-data>
  @csrf
    <fieldset>
      <legend>管理员档案</legend>
      <label for="">
        姓名:
        <input type="text" name="name" required autofocus placeholder="请输入您的姓名" />
      </label>

      <label for="">
        密码:
        <input type="password" name="password" required autofocus placeholder="请输入您的密码" />
      </label>

      <label for="">
        手机号码:
        <input type="tel" name="mobile" pattern="1\d{10}" placeholder="请输入您的手机号码" />
      </label>

      <label for="">
        选择角色:
        <select name="role_name">
            @foreach ($role as $v)
                <option value="{{$v->id}}">{{$v->role_name}}</option>
            @endforeach
        </select>
      </label>

      <label for="">
        邮箱地址:
        <input type="email" name="email" placeholder="请输入您的邮箱地址" />
      </label>

      <label for="" class="btn">
        <input type="submit" value="保存">
      </label>

    </fieldset>
  </form>

</body>


</html>