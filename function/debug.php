<?php

$debug_flg = false;

function d($s)
{
  global $debug_flg;
  if ($debug_flg) {
    error_log($s);
  }
}

function p($s)
{
  return print_r($s, true);
}
