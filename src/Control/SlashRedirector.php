<?php

namespace Axllent\TrailingSlash\Control;

use SilverStripe\Core\Extension;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;

/**
 * An extension to ensure that a single trailing slash is always added.
 * URLs accessed via Ajax, or that contain an extension are ignored.
 * All other getVars() are preserved.
 */

class SlashRedirector extends Extension
{

    public function onBeforeInit()
    {
        $this->redirectIfNecessary();
    }

    public function redirectIfNecessary()
    {
        $request = $this->owner->request;
        $params = $request->getVars();

        if ($request && $request->isGET()) {
            $requested_url = $_SERVER['REQUEST_URI'];
            $expected_url = rtrim(Director::baseURL() . $request->getURL(), '/') . '/';
            $urlPathInfo = pathinfo($requested_url);

            // ignore Ajax requests and URLs that contain an extension eg: .jpg
            if (Director::is_ajax() || isset($urlPathInfo['extension']) || !empty($params)) {
                return false;
            }

            if (!preg_match('/^' . preg_quote($expected_url, '/') . '(?!\/)/i', $requested_url)) {
                $params = $request->getVars();
                $redirect = Controller::join_links(
                    $expected_url, '/', ($params) ? '?' . http_build_query($params) : null
                );
                return $this->owner->redirect($redirect, 301);
            }
        }
    }
}
