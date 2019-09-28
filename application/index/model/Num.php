<?php


namespace app\index\model;


use think\Model;

class Num extends Model
{

    protected $resultSetType = '\app\common\Collection';
    protected $table = 'p_num';

    // 字段合法性检测
    protected $field = true;

//    // 自动时间戳
//    protected $autoWriteTimestamp = true ;

    // 主键
    protected $pk = 'uid';



    public static function sav(){
        return self::save();

    }
    public static function add(){
        return self::insert();
    }
    public static function show(){
        return self::select();
    }

//    public static function del($id){
//
//        return self::where('id',$id)->delete();
//    }
}