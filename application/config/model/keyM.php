<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/10/24
 * Time: 18:01
 */
namespace app\config\model;
use phpDocumentor\Reflection\Types\Null_;
use think\Model;

class keyM extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'key';
    public function get_Info($where=null){
        $data = keyM::where($where)->find();
        if ($data!=null){
            return $data->getData();
        }else{
            return $data;
        }
    }


    public function update_Info($data,$where){
        keyM::save($data,$where);
    }
    public function insert_Info($data){
        keyM::save($data);
    }
    public function get_List($where=null){
        $list = keyM::where($where)->select();
        return $list;
    }
    public function delete_Info($id){
        $data = $this->get_filebedInfo(array('id'=>$id));
        $data['state'] = 3;
        $data['out_time'] = date('Y-m-d');
        keyM::save($data,['id'=>$id]);
    }

}