<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $active_group = 'default';
$exp = explode('.', $_SERVER['HTTP_HOST']);

$active_group = 'sqlserver';
$query_builder = TRUE;

$db['sqlserver'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', //
	'username' => 'root',
	'password' => '',
	'database' => 'DBPRIOR',
	'dbdriver' => 'mysqli',
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
