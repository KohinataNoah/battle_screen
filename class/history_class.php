<?php

class History
{
  public static function set(...$s)
  {
    foreach ($s as $n)
      $_SESSION['history'][] = $n;
  }

  public static function clearAll()
  {
    self::clear();
    self::clearOld();
  }

  public static function clear()
  {
    unset($_SESSION['history']);
  }

  public static function clearOld()
  {
    unset($_SESSION['historyOld']);
  }
}
