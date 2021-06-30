<?php
use Illuminate\Database\Capsule\Manager;

class QB extends Manager {
    function __construct()
    {
        
        parent::__construct();
        include(APPPATH.'/config/database.php');

        $active = $db[$active_group];

        $this->addConnection([
            'driver'    => 'sqlsrv',
            'host'      => $active['hostname'],
            'database'  => $active['database'],
            'username'  => $active['username'],
            'password'  => $active['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $this->setAsGlobal();
    }

}
