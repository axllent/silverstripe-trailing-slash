<?php

namespace Axllent\TrailingSlash\Middleware;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Middleware\HTTPMiddleware;

/**
 * Ensure that a single trailing slash is always added to the URL.
 * URLs accessed via Ajax, contain $_GET vars, or that contain
 * an extension are ignored.
 */
class TrailingSlashRedirector implements HTTPMiddleware
{
    public function process(HTTPRequest $request, callable $delegate)
    {
        if ($request && ($request->isGET() || $request->isHEAD())) {
            $requested_url = $_SERVER['REQUEST_URI'];
            $expected_url = rtrim(Director::baseURL() . $request->getURL(), '/') . '/';
            $urlPathInfo = pathinfo($requested_url);
            $params = $request->getVars();

            if (!Director::is_ajax() &&
                !isset($urlPathInfo['extension']) &&
                empty($params) &&
                !preg_match('/^' . preg_quote($expected_url, '/') . '(?!\/)/i', $requested_url)
            ) {
                $params = $request->getVars();
                $redirect_url = Controller::join_links($expected_url, '/');
                $response = new HTTPResponse();
                return $response->redirect($redirect_url, 301);
            }
        }

        $response = $delegate($request);

        return $response;
    }
}
