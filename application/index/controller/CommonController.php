<?php


namespace app\index\controller;

use think\Controller;
use think\App;
use PDO;
use think\Request;
use utils\RedisService;

//use
class CommonController extends Controller
{
    protected $request;
    //单例模式连接数据库
    private static $instance;
    private static $table_name;
    private static $pdo;
//    //防止类直接进行实例化
//    private function __construct()
//    {
//        parent::__construct();
//    }
     function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=lmx", "root", "root");
        $this->pdo->query("set names utf8");

         if (is_null($request)) {
             $request = Request::instance();
         }

         $this->request = $request;

         // 控制器初始化
         $this->_initialize();
    }

    //控制器初始化
    protected function _initialize()
    {
    }
   //禁止克隆对象
    private function __clone()
    {
//        // TODO: Implement __clone() method.
//
    }
//
//    private function __construct(App $app = null)
//    {
//        parent::__construct($app);
//    }
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
    //添加
    public function add($table_name,$data){
        $keys = implode(",",array_keys($data));

        $value = "'".implode(",",array_values($data))."'";
        $values = str_replace(',',"','",$value);

        $sql = "insert into $table_name ($keys) values ($values)";
        $result = $this->pdo->exec($sql);
//        $this->error();
        return $result;
    }

    //删除
    public function del($table_name,$table){
        $id = $table['id'];
        $sql = "delete from $table_name where id=$id";
        $result = $this->pdo->exec($sql);
        return $result;

    }

    //修改
    public function upda($table_name,$data,$table,$id){
//        $id = $table['id'];
//        unset($id);
        $arr = [];
        foreach($data as $k=>$v){
            $arr[] = $k."=".'"'.$v.'"';

        }
//        var_dump($arr);die;
        $str = implode(",", $arr);
        $sql = "update $table_name set $str where id=$id";
//        var_dump($sql);
        $result = $this->pdo->exec($sql);
        return $result;
    }

    //查询
    public function exhibition($table_name){
        $sql = "select * from $table_name";
//        $sql = "select * from p_num";
//        var_dump($sql);die;
        $result = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function shfirst($table_name){
        $sql = "select * from $table_name";
//        $sql = "select * from p_num";
//        var_dump($sql);die;
        $result = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }




}

