<?php
class Session {
	public static function startSession() {
		if(!isset($_SESSION)){
			session_start();
		}
	}
	public static function set($key,$value) {
		self::startSession();
		$_SESSION[$key] = $value;
	}
	public static function get($key, $default=null){
		self::startSession();
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		} else {
			return $default;
		}
	}
}