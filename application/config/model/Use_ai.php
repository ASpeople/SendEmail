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

class Use_ai extends Model{
    /**
     * 主键默认自动识别
     */
//    protected $pk = 'uid';
// 设置当前模型对应的完整数据表名称
    protected $table = 'ai';
    private $face = 2000;  /** @var int 人脸识别处理都是 2000次 */
    private $sound = 2000;  /** @var int 语音合成是 2000次 */
    private $ocr = 400;    /** @var int 文本识别也是 400次 */
    private $image = 400;  /** @var int 图片识别统一是400 次 */
    private $text = 5000; /** @var int 文本识别同一都是5000次 */
    public function get_UseaiInfo($where=null){
        $data = Use_ai::where($where)->find();
        if ($data!=null){
            return $data->getData();
        }else{
            return $data;
        }
    }
    /** 用于查询每个功能所剩余的次数
     * @param $field
     * @return array|int|null
     */
    public function get_UseaiNum($field){
        $date = date('Y-m-d');
        $result = Use_ai::where(array('date'=>$date))->field($field)->find();
        if (empty($result)){
            $this->create_UseaiNum();
            $result = Use_ai::where(array('date'=>$date))->field($field)->find();
        }
//        var_dump($result->getData());
        $result = $result->getData();
        return $result[$field];
//        exit();
    }

    /** 用于减少使用次数
     * @param $field
     */
    public function reduce_UseaiNum($field){
        $date = date('Y-m-d');
        $result = $this->get_UseaiInfo(array('date'=>$date));
        $result[$field] = $result[$field] - 1;
        $this->update_UseaiInfo($result,array('date'=>$date));
//        var_dump($result);
    }
    /**
     * 用于建立新的使用次数记录
     */
    public function create_UseaiNum(){
        $date = date('Y-m-d');
        $state = 1;
        $data = array('state'=>$state,'date'=>$date,'face1'=>$this->face,'face2'=>$this->face,'sound'=>$this->sound,'ocr'=>$this->ocr,
            'image1'=>$this->image,'image2'=>$this->image,'image3'=>$this->image,'image4'=>$this->image,'text1'=>$this->text,'text2'=>$this->text,
            'text3'=>$this->text,'text4'=>$this->text,'text5'=>$this->text,'text6'=>$this->text,'text7'=>$this->text,'text8'=>$this->text,);
        Use_ai::save($data);
    }
    public function update_UseaiInfo($data,$where){
        Use_ai::save($data,$where);
    }
    public function insert_UseaiInfo($data){
        Use_ai::save($data);
    }
    public function get_UserList($where=null){
        $list = Use_ai::where($where)->select();
        return $list;
    }
    public function delete_UserInfo($id){
        $data = $this->get_filebedInfo(array('id'=>$id));
        $data['state'] = 3;
        $data['out_time'] = date('Y-m-d');
        Use_ai::save($data,['id'=>$id]);
    }

}