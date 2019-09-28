<?php
namespace app\index\controller;

use app\index\model\Num;
use app\index\validate\NumValidate;
use think\console\Table;
use think\Controller;
use think\Db;
use think\Model;
use think\Loader;
use think\Validate;
use think\exception\ValidateException;

class Index extends Controller
{
    public function index()
    {
        return "首页";
    }


    public function insert(){
//        echo 22;die;
        $data = [
            'name'=> "ThinkPhp",
            'num' => "1234",
        ];
        try {
            $result = Validate(NumValidate::class)->scene('insert')->check($data);
            if(true !== $result){
                return Validate(NumValidate::class)->getError();
            }else{
//                $info = Db::name('Num') ->insert($data);
                $info = \model('Num')->save($data);
//                var_dump($info);die;
                return $info;
            }
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            dump($e->getError());
        }

    }

    public function delete(){
        $time =time()-86400;
        $info = Db::name('Num')->where('create_time','<',$time)->delete();
        return $info;
    }
}
