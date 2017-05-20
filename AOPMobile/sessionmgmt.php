<?php
session_start();
class SessionManager{
  public static $LOGGED_IN = 1;
  public static $LOGGED_OFF = 0;
  private static $__status = null;
  public static function Status(){
    if(self::$__status == null){
      if(isset($_SESSION["cust_id"]))
        self::$__status = self::$LOGGED_IN;
      else
        self::$__status = self::$LOGGED_OFF;
    }
    return self::$__status;
  }
  public static function Login($cust_id){
    $_SESSION["cust_id"] = $cust_id;
  }
  public static function Logout(){
    session_unset();
    session_destroy();
    self::$__status = self::$LOGGED_OFF;
  }
}
