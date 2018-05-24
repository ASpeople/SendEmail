<?php
namespace app\index\controller;
use app\config\model\emailM;
use app\config\model\keyM;
use think\Controller;
use \think\Request;
use \think\View;
vendor('PHPMailer.PHPMailerAutoload');
class Email extends Common {
    public function index(){
        $eamil_model = new emailM();
        $data = ($eamil_model->get_List());

        return \view('index',array('data'=>$data));
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function email(){
        $tip = Request::instance()->post('tip',0);
        /** 获取发件箱的邮件数量 */
        $eamil_model = new emailM();
        $send_num = count($eamil_model->get_List());
        /** 获取key的数量 */
        $key_model = new keyM();
        $key_list = $key_model->get_List();
//        var_dump($key_list);exit();
        if ($tip!=0){
            $data['to_email'] = Request::instance()->post('toemail','');
            $data['title'] = Request::instance()->post('title','');
            $data['content'] = Request::instance()->post('content','');
            $data['k_id'] = Request::instance()->post('key','');
            $data['add_time'] = date('Y-m-d');
            $data['status'] = 1;
            $data['type'] = 1;
            $data['ip'] = '1';
            $eamil_model->insert_Info($data);
            $this->success("发送成功");
//            exit();
        }
        return \view('email',array('send_num'=>$send_num,'key_list'=>$key_list));
    }
    /**
     * 邮件发送
     */
    public function sendEmail(Request $request){
        // 根据你的内用传入得到相关的参数，在调用我们方才的函数时，传递过去即可。
        $toemail = '641351484@qq.com';
        $title = '';
        $content = '';
        $res = email($toemail, $title, $content);
        echo $res;
        // $res就是sendEmail()返回的值。我们根据返回的相应参数进行处理即可。

    }
}
