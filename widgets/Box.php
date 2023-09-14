<?php 

namespace app\widgets;


class Box extends BaseWidget {

  
  public function init()
  {
    parent::init();
  }

  public function run()
  {
    return $this->render('box/index.php',[]);

  }
}