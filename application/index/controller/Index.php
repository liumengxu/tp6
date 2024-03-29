<?php

namespace app\index\controller;

use app\index\model\Num;
use app\index\validate\NumValidate;
use think\App;
use think\console\Table;
use think\Controller;
use think\Db;
use think\Loader;
use think\Validate;
use think\exception\ValidateException;

class Index extends CommonController
{
    public function index()
    {
//        return $this->response("index");
        return $this->fetch();
    }


    public function insert()
    {
        $num = new Num;
        $data = [
            'name' => $this->request->param('name', 'tp'),
            'num' => $this->request->param('num', '22'),
            'create_time' => time(),
            'update_time' => time(),
        ];
        try {
            $result = Validate(NumValidate::class)->scene('insert')->check($data);
            if (true !== $result) {
                return Validate(NumValidate::class)->getError();
            } else {
//                $info = $this->add("p_num", $data);
                $num = new Num;
                $info = $num->add($data);
//                var_dump($info);die;
                return $this->response($info);
            }
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            dump($e->getError());
        }

    }


    public function delete()
    {

        $time = time() - 86400;
//        $info = Db::name('Num')->where('create_time', '<', $time)->delete();
//        $table = Db::name("Num")->find();
        $table = Num::select()->toArray();
        $arr = [];
        foreach($table as $k=>$v){
            $arr[] = $v;
        }
//        $info = $this->del('p_num', $table);
        $info = Num::where(['id'=>$v['id']])->delete();
        return $this->response($info);
    }


    public function update()
    {
        $data = [
            'name' => "tp",
            'num' => '10'
        ];
//        $table = Db::name("Num");
//        $info = Db::name('Num')->where('id', 12)->update($data);
        $table = Num::select()->toArray();
        $arr = [];
        foreach($table as $k=>$v){
            $arr[] = $v;
        }
        $num = new Num();
        $info = $num->where(['id'=>$v['id']])->update($data);
//        $info = $this->upda("p_num", $data, $table, $id);
        if ($info) return $this->response($info);
        else return $this->rep($info,'404');
    }

    public function show()
    {
        $info = Num::show();
//        var_dump($info);die;
//        $info = Db::table('p_num')->select();
//        $info = $this->exhibition('p_num');
        if ($info) return $this->response($info);
        else return $this->rep($info,'404');
    }

    public function showFirst()
    {
//        $info = $this->shfirst('p_num');
        $info = Num::find();
        if ($info) return $this->response($info);
        else return $this->rep($info,'404');

    }

    public function test(){
        echo "test";
        echo "branch";
    }
}
