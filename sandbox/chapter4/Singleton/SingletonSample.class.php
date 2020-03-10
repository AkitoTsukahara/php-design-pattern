<?php
class Singletonsample{

    /**
     * メンバー変数
     */
    private $id;

    /**
     * 唯一のインスタンスを保持する変数
     */
    private static $instance;

    /**
     * コンストラクタ
     * IDとして、生成日時のハッシュ値を作成
     */
    private function __construct(){
        $this->id = md5(date('r') . mt_rand());
    }

    /**
     * 唯一のインスタンスを返すためのメソッド
     * @return Singletonsampleインスタンス
     */
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Singletonsample();
            echo 'a SingletonSample instance was created!';
        }

        return self::$instance;
    }

    /**
     * IDを返す
     * @return インスタンスのID
     */
    public function getID(){
        return $this->id;
    }

    /**
     * このインスタンスの複製を許可しない様にする
     * @throws RuntimeException
     */
    public final function __clone(){
        // TODO: Implement __clone() method.
        throw new RuntimeException('Clone is not allowed against' . get_class($this));
    }

}