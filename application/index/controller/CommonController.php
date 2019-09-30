<?php


namespace app\index\controller;

use think\Controller;
use think\App;
use think\exception\PDOException;
use PDO;

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
     function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=lmx", "root", "root");
        $this->pdo->query("set names utf8");
    }
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
    public function add($table_name,$data){
        $keys = implode(",",array_keys($data));

        $value = "'".implode(",",array_values($data))."'";
        $values = str_replace(',',"','",$value);

        $sql = "insert into $table_name ($keys) values ($values)";
        $result = $this->pdo->exec($sql);
//        $this->error();
        return $result;
    }
    public function upda($table_name,$data){
//        $keys = implode(",",array_keys($data));
//        $value = "'".implode(",",array_values($data))."'";
//        var_dump($keys);
//        var_dump($value);

//        $id = $data['id'];
//        unset($id);
        $arr = [];
        foreach($data as $k=>$v){
            $arr[] = $k."'='"."$v";
            var_dump($arr);die;

        }


        $sql = "update $table_name set $keys=$value where id='$id'";
        var_dump($sql);
    }
    public function delete(){

    }
}

