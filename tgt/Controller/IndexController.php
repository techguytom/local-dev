<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction()
    {
        return new response('hello');
    
    }

}
