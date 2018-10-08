<?php

namespace MarsupilamiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarsupilamiBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
