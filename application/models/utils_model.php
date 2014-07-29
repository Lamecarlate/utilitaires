<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils_model extends CI_Model {

	function oldget_util($code = NULL) {

		$this->db->select('code, nom, description')->from('liste_utils');

		if($code !== NULL) {
			$this->db->where('code', $code);
		}
		
		$exec = $this->db->get();

		if($exec->num_rows() > 0) {
			if($code !== NULL) {
				return $exec->row();
			}
			return $exec->result();
		}
		return FALSE;

	}

	function get_util($code = NULL) {

		$utils_view_folder = APPPATH . "views/utils/";

		if($code !== NULL) {
			$fp = read_file($utils_view_folder . $code . ".php");

			if($fp) {
				$util = $this->get_info_file($fp);
				return $util;
			}
			return FALSE;
		}
		else {
			$directory = directory_map($utils_view_folder);

			$utils = array();
			foreach($directory as $file) {
				$fp = read_file($utils_view_folder . $file);
				$utils[] = $this->get_info_file($fp);
			} 

			return $utils;
		}
		
	}

	function get_info_file($fp) {

		$infos = new stdClass();

		$identifier = substr($fp, 5, (strpos($fp, '-->') - 6));
		$a_identifier = explode(';', $identifier );

		foreach($a_identifier as $a) {
			$e = explode('=', $a);
			$infos->{trim($e[0])} = trim($e[1]);
		}

		return $infos;

	}

	function util_dice($args) {

		return array(
			'dice_type' => $args['dice_type'],
			'result' => mt_rand(1,$args['dice_type'])
		);
		
	}

}