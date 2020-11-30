<?php
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */

require_once(QQ_CONNECT_SDK_CLASS_PATH."ErrorCase.class.php");
class Recorder{
    private static $data;
    private $inc;
    private $error;

    public function __construct(){
        $this->error = new ErrorCase();

        //-------读取配置文件
        //file（） 把文本文件读成字符串
        $incFileContents = '{"appid":"101916581","appkey":"b4e8cbb74e6ce59c5245c6655b4bcbb2 \u5ba1\u6838\u4e2d...","callback":"http://oauth.aring88.xyz/callback.php",
        "scope":"get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr"
        ,"errorReport":true,"storageType":"file","host":"localhost","user":"QQ_CONNECT_SDK_ROOT","password":"QQ_CONNECT_SDK_ROOT","database":"test"}';
        $this->inc = json_decode($incFileContents);


        /*$this->inc->appid='101916581';
        $this->inc->appkey='b4e8cbb74e6ce59c5245c6655b4bcbb2';
        $this->inc->callback='http://oauth.aring88.xyz/callback.php';
        $this->inc->scope='get_user_info,add_share,list_album,add_album,upload_pic,add_topic
                           ,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t
                           ,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr';
        $this->inc->errorReport=true;
        $this->inc->storageType='file';*/



        if(empty($this->inc)){
            $this->error->showError("20001");
        }

        if(empty($_SESSION['QC_userData'])){
            self::$data = array();
        }else{
            self::$data = $_SESSION['QC_userData'];
        }
    }

    public function write($name,$value){
        self::$data[$name] = $value;
    }

    public function read($name){
        if(empty(self::$data[$name])){
            return null;
        }else{
            return self::$data[$name];
        }
    }

    public function readInc($name){
        if(empty($this->inc->$name)){
            return null;
        }else{
            return $this->inc->$name;
        }
    }

    public function delete($name){
        unset(self::$data[$name]);
    }

    function __destruct(){
        $_SESSION['QC_userData'] = self::$data;
    }
}
