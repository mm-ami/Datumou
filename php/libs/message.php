<?php 
namespace lib;
use model\AbstractModel;
use Throwable;

class Message extends AbstractModel{
  
  protected static $SESSION_NAME = '_msg';
  public const ERROR = 'error';
  public const INFO = 'info';
  public const DEBUG = 'debug';

  public static function push($type, $msg) {

    if(!is_array(static::getSession())) {
      static::init();
    }

    $msgs = static::getSession();
    $msgs[$type][] = $msg;
    static::setSession($msgs);
  }

  public static function display() {

    try {
      $msgs_with_type = static::getSessionAndDisplay() ?? [];

      foreach($msgs_with_type as $type => $msgs) {
        if($type === static::DEBUG && !DEBUG) {
          continue;
        }

        $color = $type === static::ERROR ? 'error' : 'info';

        foreach($msgs as $msg) {
          echo "<div class=$color>{$msg}</div>";
        }
      }

    } catch (Throwable $e) {
      Message::push(Message::ERROR, 'Message::display()で例外が発生しました。');
    }
  }

  private static function init() {
    static::setSession([
      static::ERROR => [],
      static::INFO => [],
      static::DEBUG => []
    ]);
  }
}