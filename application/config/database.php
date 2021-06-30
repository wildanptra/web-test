<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $active_group = 'default';
$exp = explode('.', $_SERVER['HTTP_HOST']);

$active_group = 'v5';


$query_builder = TRUE;

$db['sqlserver'] = array(
	'dsn'	=> '',
	'hostname' => '36.89.171.31',
	'username' => 'prioritas',
	'password' => 'prioritas123',
	'database' => 'DBPRIOR',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => APPPATH . 'cache',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['live'] = array(
	'dsn'	=> '',
	'hostname' => '104.43.14.90,6969',
	'username' => 'sa',
	'password' => '2019Pr3d4t0r030317',
	'database' => 'predator_4',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['beta'] = array(
	'dsn'	=> '',
	'hostname' => '168.63.242.2,6969',
	'username' => 'user',
	'password' => '2019predator030317',
	'database' => 'predator_4_beta',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['v5'] = array(
	'dsn'	=> '',
	'hostname' => '104.43.14.90,6969',
	'username' => 'sa',
	'password' => '2021Pr3d4t0r_5',
	'database' => 'predator_5',
	// 'database' => 'predator_4_pelatihan',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['demo'] = array(
	'dsn'	=> '',
	'hostname' => '168.63.242.2,6969',
	'username' => 'SA',
	'password' => '2019Pr3d4t0r030317',
	// 'database' => 'predator_5_pelatihan_ho',
	// 'database' => 'predator_5',
	// 'database' => 'predator_4_demo',
	'database' => 'predator_4_dev',
	// 'database' => 'predator_4_betacol',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => TRUE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
