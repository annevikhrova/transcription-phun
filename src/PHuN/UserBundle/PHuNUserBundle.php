<?php

namespace PHuN\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PHuNUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}
