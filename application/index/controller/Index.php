<?php
namespace app\index\controller;
use app\config\model\keyM;
use think\Controller;
use \think\Request;
use \think\View;
class Index extends Common {
    public function index(){
        return \view('index');
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function key(){
        $key_model = new keyM();
        $list = $key_model->get_List();
        return \view('key',['list'=>$list]);
    }
    public function add_key(){
        $flag = Request::instance()->post('flag',0);
        $state = '';
        if ($flag!=0){
            $data['note'] = Request::instance()->post('note','');
            $data['number'] = Request::instance()->post('number',20);
            $data['day'] = Request::instance()->post('day',30);
            $user = session('AdminUser');
            $data['code'] = md5($user['id'].$user['username'].$user['email'].date('Y-m-d:h:m:i'));
            $data['u_id'] = $user['id'];
            $data['use_number'] = 0;
            $data['status'] = 1;/** 在使用，或停止 */
            $data['state'] = 1; /** 删除 */
            $data['type'] = 1;
            $data['add_time'] = date('Y-m-d');
//            var_dump($data);exit();

            $key_model = new keyM();
            $key_model->insert_Info($data);
//            $state = '添加成功，请继续添加或关闭';
            return \view('key');
        }
        return \view('add_key',['state'=>$state]);
    }
}
