<?php


namespace app\index\controller;

use think\Controller;
use think\App;

//use
class CommonController extends Controller
{

    //单利模式连接数据库

    private static $instance;
    private static $table_name;
    private static $pdo;
//    //防止类直接进行实例化
////    private function __construct()
////    {
//////        parent::__construct();
////    }
////    private function __construct(){
////        $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=test_system", "root", "");
////        $this->pdo->query("set names utf8");
////    }
//
//
//    //禁止克隆对象
    private function __clone()
    {
//        // TODO: Implement __clone() method.
//
    }
//
////    private function __construct(App $app = null)
////    {
////        parent::__construct($app);
////    }
//
    //返回数据库实例对象
    public static function getDb($table_name){
         self::$table_name = $table_name;
         if(self::$instance instanceof self){
            self::$instance = new self;
         }
         return self::$instance;
    }
//
//    //实现增删改查
    public function index(){

    }
    /**
     *
     * @access public
     * @param string $table_name
     * @param array $data
     * @return string
     */
    public function insert($table_name='',$data=''){
        $table_name = "num";
        $data=[
            'name'=>'12'
        ];
        $keys = implode(",",array_keys($data));
        $values = "'".implode(",",array_values($data))."'";
        $sql = "insert into $table_name ($keys) values ($values)";
        $result = $this->pdo->exec($sql);
        $this->error();
        return $result;
    }
//    public function update(){
////        $keys = implode()
//    }
    public function delete(){

    }
}

    function M($table_name){
        $db = Db::getDb($table_name);
        return $db;
    };

    $data = [
        [
            'name'=>'雪碧',
            'class_name'=>'3333333',
        ],
        [
            'name'=>'可乐',
            'class_name'=>'3333333',
        ],
    ];


//    $r = M('user')->delete(726);
//    echo $r;