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
            'title' => $app['title'],
            'nav'   => $app['nav'],
            'phpVersion' => phpversion(),
        );

        foreach (glob($app['siteDirectories'] . '/*') as $file) {
            $viewData['sites'][$count]['siteName'] = basename($file);
            if (is_dir($file . '/build/output')) {
                $viewData['sites'][$count]['prod'] = true;
            }
            
            if (is_dir($file . '/web/wp-content') || is_dir($file . '/web/content')) {
                $viewData['sites'][$count]['favicon'] = '/img/icon-wp.png';
            } else {
                $viewData['sites'][$count]['favicon'] = '/img/icon-gear.png';
            }

            $count++;
        }

        return $app['twig']->render('index.html.twig', $viewData);

    }
}
