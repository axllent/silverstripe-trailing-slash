<?php
/**
 * An extension to ensure that a single trailing slash is always added.
 * URLs accessed via Ajax, or that contain an extension are ignored.
 * All other getVars() are preserved.
 */

class TrailingSlashExt extends Extension {

	public function onBeforeInit() {
		$this->redirectIfNecessary();
	}

	public function redirectIfNecessary() {

		$request = $this->owner->request;

		if ($request && $request->isGET()) {
			$url = $request->getVar('url');

			/* ignore Ajax requests and URLs that contain a an extension */
			if (Director::is_ajax() || isset(pathinfo($url)['extension'])) {
				return false;
			}

			/* remove all trailing slashes if more than 1 */
			$url = preg_replace('/\/\/+$/', '', $url);
			if (strlen($url) > 1 && substr($url, -1, 1) != '/') {
				$params = $request->getVars();
				unset($params['url']);
				$redirect = Controller::join_links(
					$url, '/', ($params) ? '?' . http_build_query($params) : null
				);
				return $this->owner->redirect($redirect, 301);
			}
		}

	}

}