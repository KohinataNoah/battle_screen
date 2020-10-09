<?php

$debug_flg = true;

function d($s)
{
  global $debug_flg;
  if ($debug_flg) {
    error_log($s);
  }
}
