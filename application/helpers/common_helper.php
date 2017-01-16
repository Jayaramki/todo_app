<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('site_name')) {
	function site_name() {
		return $GLOBALS['ARR_CONFIG']['site_name'];
	}
}

if ( ! function_exists('showMessage')) {
	function showMessage($message,$type) {
  		if($type == 'error'){
			return  '<div class="col-lg-12 col-sm-12 col-xs-12 msg_div" > <div class="alert alert-dismissable alert-danger"  > '.$message.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';	
		}else if($type == 'success'){
			return '<div class="col-lg-12 col-sm-12 col-xs-12 msg_div" > <div class="alert alert-dismissable alert-success"  > '.$message.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';	
		} else if($type == 'warning'){
			return '<div class="col-lg-12 col-sm-12 col-xs-12 msg_div" > <div class="alert alert-dismissable alert-warning"  > '.$message.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';	
		} 
		 
	}
}