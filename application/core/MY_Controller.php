<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

/**
 * Description of my_controller
 *
 * @author http://www.roytuts.com
 */
class MY_Controller extends MX_Controller {

	var $cache;

    function __construct() {
		
		parent::__construct();


        set_exception_handler(function(Throwable $th) {

			throw $th;
		});

		// set_error_handler(function($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
		// 	throw new ErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
		// });

		register_shutdown_function(function() {
			$last_error = error_get_last();
			if (isset($last_error) &&
				($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
			{
				_error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
				throw new ErrorException($last_error['message'], 0, $last_error['type'], $last_error['file'], $last_error['line']);
			}
		});

		date_default_timezone_set('Asia/Jakarta');

		$this->output->enable_profiler(false);
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
