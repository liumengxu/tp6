<?php


namespace app\index\model;


use think\Model;

class Num extends Model
{

    protected $table = 'p_num';

    // 字段合法性检测
    protected $field = true;

//    // 自动时间戳
    protected $autoWriteTimestamp = true ;

    // 主键
    protected $pk = 'uid';



    public function add($data=[]){
//        return self::save($data);
        return self::save($data);

    }

    public static function show(){
        return self::select();
    }

//    public static function del($id){
//
//        return self::where('id',$id)->delete();
//    }
}