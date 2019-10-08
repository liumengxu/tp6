<?php


namespace app\index\controller;

use function PHPSTORM_META\type;
use think\Controller;
use think\App;
use PDO;
use think\Request;
use think\Response;
use utils\RedisService;

//use
class CommonController extends Controller
{
    protected $request;
//    protected $return_type = 'json';

    //连接数据库
    private static $instance;
    private static $table_name;
    private static $pdo;

//    //防止类直接进行实例化
//    private function __construct()
//    {
//        parent::__construct();
//    }
    public function __construct(Request $request = null)
    {
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

    /**
     * 设置json数据格式
     * @access public
     * @param integer $code http状态码
     * @param string $message 请求成功/请求失败
     * @param mixed $data 要返回的数据
     * @return Response
     */
    //返回json数据
    public function return_json($code, $message, $data = [])
    {
        if (!is_numeric($code)) {
            return "";
        }
        $data = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    }

    //请求数据对象

    /**
     * 输出返回数据
     * @access protected
     * @param mixed $data 要返回的数据
     * @param integer $code HTTP状态码
     * @return Response
     */
    protected function response($data, $code = 200)
    {
        return Response::create($data, $this->return_json('200', '请求成功', $data))->code($code);
    }

    protected function rep($data, $code)
    {
        return Response::create($this->return_json($code, '请求失败', $data))->code($code)->send();
    }

    /*
     * 数据为空时
     * @access public
     * @return Response
     */
    public function _empty()
    {
        return Response::create()->code(404)->send();
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
    //返回数据库的实例对象
    public static function getDb($table_name)
    {
        self::$table_name = $table_name;
        if (self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
//
    //实现增删改查
    /**
     *
     * @access public
     * @param string $table_name
     * @param array $data
     * @return string
     */
    //添加
    public function add($table_name, $data)
    {
        $keys = implode(",", array_keys($data));

        $value = "'" . implode(",", array_values($data)) . "'";
        $values = str_replace(',', "','", $value);

        $sql = "insert into $table_name ($keys) values ($values)";
        $result = $this->pdo->exec($sql);
//        $this->error();
        return $result;
    }

    //删除
    public function del($table_name, $table)
    {
        $id = $table['id'];
        $sql = "delete from $table_name where id=$id";
        $result = $this->pdo->exec($sql);
        return $result;

    }

    //修改
    public function upda($table_name, $data, $table, $id)
    {
//        $id = $table['id'];
//        unset($id);
        $arr = [];
        foreach ($data as $k => $v) {
            $arr[] = $k . "=" . '"' . $v . '"';

        }
//        var_dump($arr);die;
        $str = implode(",", $arr);
        $sql = "update $table_name set $str where id=$id";
//        var_dump($sql);
        $result = $this->pdo->exec($sql);
        return $result;
    }

    //查询全部
    public function exhibition($table_name)
    {
        $sql = "select * from $table_name";
//        $sql = "select * from p_num";
//        var_dump($sql);die;
        $result = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //查询单条
    public function shfirst($table_name)
    {
        $sql = "select * from $table_name";
//        $sql = "select * from p_num";
//        var_dump($sql);die;
        $result = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


}

