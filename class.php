<?php

class Monsters
{
  protected $name;
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

  public function attack()
  {
    $atkPoint = mt_rand($this->minAtkPoint, $this->maxAtkPoint);
    $_SESSION['playerHp'] -= $atkPoint;
    $_SESSION['history'] .= $this->name . 'は' . $atkPoint . 'ポイントのダメージを与えた！';
  }

  // public function setHP()

  public function getName()
  {
    return $this->name;
  }
}
