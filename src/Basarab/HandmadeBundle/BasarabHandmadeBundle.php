<?php

namespace Basarab\HandmadeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BasarabHandmadeBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
