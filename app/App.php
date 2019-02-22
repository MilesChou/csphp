<?php

namespace App;

use Symfony\Component\Console\Application;

/**
 * Commands application
 */
class App extends Application
{
    public function __construct()
    {
        parent::__construct('CSPHP', 'dev-master');

        $this->addCommands([
            new Commands\Hi()
        ]);
    }
}
