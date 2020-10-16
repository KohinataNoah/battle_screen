<?php

class Monster
{
  protected $name = '名無しさん';
  protected $img;
  protected $hp;
  protected $minAtkPoint;
  protected $maxAtkPoint;

  public function __construct($name, $img, $hp, $minAtkPoint, $maxAtkPoint)
  {
    $this->name = $name;
    $this->img = $img;
    $this->hp = $hp;
    $this->minAtkPoint = $minAtkPoint;
    $this->maxAtkPoint = $maxAtkPoint;
  }


  public function getName()
  {
    return $this->name;
  }

  public function getImg()
  {
    return $this->img;
  }

  public function getHP()
  {
    return $this->hp;
  }

  public function setHP($num)
  {
    $this->hp = $num;
    // $this->hp = filter_var($num, FILTER_VALIDATE_INT);
  }

  public function attack($num = 7)
  {
    $atkPoint = mt_rand($this->minAtkPoint, $this->maxAtkPoint);
    if (!mt_rand(0, $num)) {
      History::set('つうこんのいちげき！');
      $atkPoint = ($this->maxAtkPoint * mt_rand(11, 20)) / 10;
      round($atkPoint);
    }
    $_SESSION['playerHP'] -= $atkPoint;
    History::set($atkPoint . 'ポイントのダメージをうけた！');
  }
}

class MagicMonster extends Monster
{
  protected $magicAttack;
  public function __construct($name, $img, $hp, $minAtkPoint, $maxAtkPoint, $magicAttack)
  {
    parent::__construct($name, $img, $hp, $minAtkPoint, $maxAtkPoint);
    $this->magicAttack = $magicAttack;
  }

  function attack($num = 7)
  {
    if (!mt_rand(0, 4)) {
      History::set($this->name . 'のまほうこうげき！');
      $_SESSION['playerHP'] -= $this->magicAttack;
      History::set($this->magicAttack . 'ポイントのダメージをうけた！');
    } else {
      parent::attack();
    }
  }
}
