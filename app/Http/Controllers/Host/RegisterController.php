<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Hash;
use DB;

class RegisterController extends Controller
{   

    // 发送短信验证码  
    public function sendmobilecode(Request $req) {
        // return $req->mobile;

      // 生成6位随机数

      $code = rand(100000,999999);

      // 缓存时的名字
      $name = 'code-'.$req->mobile;  //code-18065828390
    //   dd($name);

      // 把随机数缓存起来（10分钟）
      Cache::put($name,$code,10);

      // 发短信
      $config =[
        'accessKeyId'    => 'LTAItkpPFd4YJidB',
        'accessKeySecret' => '9Veh8nTu6QeN5kNHyHNroizZTK9ZA1',
        
    ];
    $client  = new Client($config);
    $sendSms = new SendSms;
    $sendSms->setPhoneNumbers($req->mobile);
    $sendSms->setSignName('刘佳怡的');
    $sendSms->setTemplateCode('SMS_136680080');
    $sendSms->setTemplateParam(['code'=>$code]);

    // 发送
    print_r($client->execute($sendSms));



  }

    
    // 显示注册页面
    public function register() {

        return view('host.login.register');
    }

    // 使用RegisterRequest类进行表验证
    // 1、如果失败返回上一个页面
    // 2、如果成功才允许继续执行
    public function doregist(RegistRequest $req) {

        // 拼出缓存的名字
        $name = 'code-'.$req->mobile;
        // 再根据名字取出验证码
        $code = Cache::get($name); 
        if(!$code || $code != $req->mobile_code) {

            return back()->withErrors(['mobile_code'=>'验证码错误！']);
        }

        // 把密码加密
        $password = Hash::make($req->password);
        // dd($password);

        $user = new User;
        // 把表单中的名字 设置到 模型
        $user->name = $req->name;
         // 把加密 之后的密码设置到模型
        $user->password = $password;
        // 把表单中的手机号设置到 模型
        $user->mobile = $req->mobile;
        // $user->email = $req->email;
 
        // 保存到表中
        $user->save();
        // dd($user);
        return redirect()->route('login');
    }
}
