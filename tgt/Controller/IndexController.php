<?php

namespace Controller;

use Silex\Application;

class IndexController
{
    public function indexAction(Application $app)
    {
        $count    = 0;
        $viewData = array(
            'title'      => $app['title'],
            'nav'        => $app['nav'],
            'phpVersion' => phpversion(),
        );

        foreach (glob($app['siteDirectories'] . '/*') as $file) {
            $viewData['sites'][$count]['siteName'] = basename($file);
            if (is_dir($file . '/build/output')) {
                $viewData['sites'][$count]['prod'] = true;
            }

            if (is_dir($file . '/app')) {
                $viewData['sites'][$count]['symfony'] = '/app_dev.php';
            } else {
                $viewData['sites'][$count]['symfony'] = '';
            }

            if (is_dir($file . '/web/wp-content') || is_dir($file . '/web/content')) {
                $viewData['sites'][$count]['favicon'] = '/img/icon-wp.png';
            } elseif (is_file($file . '/web/favicon.ico')) {
                $viewData['sites'][$count]['favicon'] = 'http://' . basename($file) . '.local/favicon.ico';
            } else {
                $viewData['sites'][$count]['favicon'] = '/img/icon-gear.png';
            }

            if (is_file($file . '/Gemfile')) {
                $viewData['sites'][$count]['rails'] = true;
            }

            $count++;
        }

        return $app['twig']->render('index.html.twig', $viewData);

    }
}
