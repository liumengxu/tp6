<?php

namespace app\index\controller;

use app\index\model\Num;
use app\index\validate\NumValidate;
use think\App;
use think\console\Table;
use think\Controller;
use think\Db;
use think\Model;
use think\Loader;
use think\Validate;
use think\exception\ValidateException;

class Index extends CommonController
{
    public function index()
    {
        return "首页";
    }


    public function insert()
    {
        $num = new Num;
//        echo 22;die;
        $data = [
            'name' => "ThinkPhp",
            'num' => "1234",
            'create_time' =>time(),
            'update_time' =>time(),
        ];
        try {
            $result = Validate(NumValidate::class)->scene('insert')->check($data);
//            var_dump($result);die;
            if (true !== $result) {
                return Validate(NumValidate::class)->getError();
            } else {
                $info = $this->add("p_num",$data);
                return $info;
            }
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            dump($e->getError());
        }

    }

//    public function add()
//    {
////        echo 22;
////        die;
//        $data = [
//            'name' => "ThinkPhp",
//            'num' => "1234",
//        ];
//        try {
//            $result = Validate(NumValidate::class)->scene('insert')->check($data);
//            if (true !== $result) {
//                return Validate(NumValidate::class)->getError();
//            } else {
////                $info = Db::name('Num') ->insert($data);
//                $info = \model('Num')->save($data);
////                $data = \model("Num")->getLastSql();
////                echo $data;
////                var_dump($info);die;
//                return $info;
//            }
//        } catch (ValidateException $e) {
//            // 验证失败 输出错误信息
//            dump($e->getError());
//        }
//
//    }

    public function delete()
    {
        $time = time() - 86400;
        $info = Db::name('Num')->where('create_time', '<', $time)->delete();
        return $info;
    }


    public function update()
    {
        $data = [
            'name' => "test",
            'num' => '200'
        ];
//        $table = Db::name("Num");
//        $info = Db::name('Num')->where('id', 12)->update($data);
        $info = $this->upda("p_num",$data);
        var_dump($info);die;
//        $res = $table->getLastSql();
//        echo $res;die;
        return $info;
    }

    public function show()
    {
//        echo 22;die;
        $info = Db::table('p_num')->select();
//        $info = Db::table('p_num')->show();
        return $info;
    }
}
