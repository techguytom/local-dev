<?php

namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction(Application $app)
    {
        $count    = 0;
        $viewData = array(
            'title' => 'TechGuyTom Development Sites',
            'nav'   => array(
                array(
                    'name' => 'Github Nerdery',
                    'url'  => 'http://github.com/thenerdery',
                ),
                array(
                    'name' => 'Github Personal',
                    'url'  => 'http://github.com/techguytom',
                ),
                array(
                    'name' => 'Git Reference',
                    'url'  => 'http://gitref.org',
                ),
            ),
            'phpVersion' => phpversion(),
        );

        foreach (glob($app['siteDirectories'] . '/*') as $file) {
            $viewData['sites'][$count]['siteName'] = basename($file);
            if (is_dir($file . '/build/output')) {
                $viewData['sites'][$count]['prod'] = true;
            }
            
            if (file_exists($file . '/web/favicon.ico')) {
                $viewData['sites'][$count]['favicon'] = true;
            }

            $count++;
        }

        return $app['twig']->render('index.html.twig', $viewData);

    }
}
