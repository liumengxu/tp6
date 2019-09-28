<?php


namespace app\index\validate;


use think\Validate;

class NumValidate extends Validate
{
    //定义规则
    protected $rule=[
        'name'=> 'require|max:20',
        'num' => 'number|require'
    ];

    //定义提示语
    protected $msg=[
        'name.require' => '名称必须',
        'name.max'     => '名称不能超过20个汉字',
        'num.number'   => '数量必须是纯数字',
        'num.require'   => '数量不能为空',
    ];

    //场景
    protected $scene = [
        'insert'  =>  ['name','num'],
        'update'  =>  ['name','num'],
    ];
}