<?php
namespace Mouf\Utils\Action;

use Mouf\Utils\Value\ValueInterface;

/**
 * This action performs an HTTP redirect.
 * 
 * @author David Négrier
 */
class Redirect implements ActionInterface {
	
	private $url;
	
	/**
	 * The redirect URL.
	 * Absolute if it starts with / or http:// or https://.
	 * Relative to root directory otherwise.
	 * 
	 * @Important
	 * @param string|ValueInterface $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * Performs the action the object was designed to do.
	 */
	public function run() {
		if ($this->url === null) {
			throw new \Exception("No URL configured for redirection.");
		}
		if (strpos($this->url, '/') === 0 || strpos($this->url, 'http://') === 0 || strpos($this->url, 'https://') === 0) {
			$url = ValueInterface::val($this->url);
		} else {
			$url = ROOT_URL.ValueInterface::val($this->url);
		}
		header("Location: ".$url);
	}
}
