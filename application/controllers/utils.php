<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->model('utils_model');

		$this->load->driver('cache', array('adapter' => 'file'));

		if ( ! $menu = $this->cache->get('menu')) {
		    $menu = $this->utils_model->get_util();
		    $this->cache->save('menu', $menu, 30000);
		}

		$this->menu = $this->cache->get('menu');


//		xdebug_start_trace(null,XDEBUG_TRACE_HTML);

	}

	public function _remap($code) {

		$is_ajax = $this->input->is_ajax_request();

		if($is_ajax) {
			$input_data = $this->input->get();
		}
		else {
			$input_data = $this->input->post();
		}

		switch ($code) {
			case 'index':
				$data = $this->_get_home();
				break;
			default: 
				$data = $this->_get_util($code, $input_data, $is_ajax);
				break;
		}
		if($is_ajax){
		 	echo json_encode($data);
		}
		else {
			$this->_display($data);
		}
		
		
	}

	private function _display($data) {

		$data_output = array();

		if(!$data) {
			// erreur 404
			set_status_header(404);
			$data_output['menu'] = $this->layout->load_view('menu', array('menu' => $this->menu));
			$data_output['code'] = "404";
			$data_output['content'] = $this->layout->load_view('404');
			$data_output['page_title'] = "Page non trouvée";
			$this->layout->output_view($data_output);
		}
		else {
			$data_output = $data;

			if(!isset($data['no_menu']) || !$data['no_menu']) {
				$data_output['menu'] = $this->layout->load_view('menu', array('menu' => $this->menu, 'current' => $data['code']));
			}
			
			$data_output['content'] = $data['content'];
			$data_output['page_title'] = $data['page_title'];
			$data_output['code'] = $data['code'];
			if(file_exists('assets/js/' . $data['code'] . '.js')) {
				$data_output['js'] = $data['code'] . '.js';
			}
			$this->layout->output_view($data_output);
		}
	}

	private function _get_home() {

		return array(
			'code' => 'home',
			'content' => $this->layout->load_view('home', array('menu_home' => $this->menu)),
			'page_title' => 'Accueil',
			'no_menu' => TRUE
		);

	}

	private function _get_util($code, $input_data = FALSE, $is_ajax = FALSE) {

		$line = $this->utils_model->get_util($code);

		if($line !== FALSE) {

			$processed_data = FALSE;

			if($input_data !== FALSE){
				$function_name = 'util_' . $code;
				if(method_exists($this->utils_model, $function_name)){
					$processed_data = $this->utils_model->$function_name($input_data);
					if($is_ajax){
						return $processed_data;
					}
				}
				else {
					echo 'pas de fonction' . $function_name . '()';
				}
			}

			$data = array(
				'is_util' => TRUE,
				'code' => $code,
				'content' => $this->layout->load_view('utils/' . $code, array('processed_data' => $processed_data)),
				'page_title' => $line->title
			);

			return $data;
		}
		return FALSE;
	}

}

/* End of file utils.php */
/* Location: ./application/controllers/utils.php */