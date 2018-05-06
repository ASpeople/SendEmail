<?php
namespace app\index\controller;
use app\config\model\userM;
use think\Controller;
use \think\Request;
use \think\View;
class Login extends Controller {
    public function index(){
        $state = Request::instance()->get('state','');
        $email = '';
        return \view('login',['state'=>$state,'email'=>$email]);
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function login(){
        // 提交表单的操作，判断是否有提交
        $flag = Request::instance()->post('flag',0);
        $state = '';
        $email = '';
        if($flag==1){
            $email = Request::instance()->post('email','');
            $password = Request::instance()->post('password','');
            $user_model = new userM();
            $data = $user_model->get_Info(array('email'=>$email,'password'=>$password));
//            $data = array('a_username'=>'admin','a_password'=>'admin');
            if ($data==NULL){
                $state = "邮箱或密码错误";
            }else{
                session('AdminUser',$data);
//                start_session(6000);
                $this->redirect('/index.php/index/index');
                exit();
            }
        }
        $this->assign('state',$state);
        return \view('login',['email'=>$email]);
    }
    public function register(){
        // 提交表单的操作，判断是否有提交
        $flag = Request::instance()->post('flag',0);
        $state = '';
        $username = '';
        if($flag==1){
            $data['email'] = Request::instance()->post('email','');
            $data['password'] = Request::instance()->post('password','');
            $data['username'] = Request::instance()->post('username','');
            $user_model = new userM();
            $result = $user_model->get_Info(array('email'=>$data['email']));
//            $data = array('a_username'=>'admin','a_password'=>'admin');
            if ($result==NULL){
                $data['add_time'] = date('Y-m-d');
                $data['status'] = 1;/** 用户状态-1为可用 */
                $data['type'] = 2;/** 用户类型--2为普通用户*/
                $user_model->insert_Info($data);
                $state = "注册成功，请登录";
                return \view('login',array('state'=>$state,'email'=>$data['email']));
            }else{
                $state = "邮箱已存在";
            }
        }
        return \view('register',array('state'=>$state));
    }
    /**
     * 登出操作
     */
    public function logout() {
        session('AdminUser', null);
        $this->redirect('/index.php/index/index');
        exit();
//        $this->get_session();
    }
}
