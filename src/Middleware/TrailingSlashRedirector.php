<?php
namespace Axllent\TrailingSlash\Middleware;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\Core\Config\Config;

/**
 * Ensure that a single trailing slash is always added to the URL.
 * URLs accessed via Ajax, contain $_GET vars, or that contain
 * an extension are ignored.
 */
class TrailingSlashRedirector implements HTTPMiddleware
{
    /**
     * URLS to ignore
     *
     * @var array
     */
    private static $ignore_paths = [
        'admin/',
        'dev/',
    ];

    /**
     * User-Agents to ignore
     *
     * @var array
     */
    private static $ignore_agents = [];

    /**
     * Process request
     *
     * @param HTTPRequest $request  HTTP request
     * @param callable    $delegate Delegate
     *
     * @return HTTPResponse
     */
    public function process(HTTPRequest $request, callable $delegate)
    {
        $ignore_paths = [];

        $ignore_config = Config::inst()
            ->get(TrailingSlashRedirector::class, 'ignore_paths');

        foreach ($ignore_config as $iurl) {
            if ($quoted = preg_quote(ltrim($iurl, '/'), '/')) {
                array_push($ignore_paths, $quoted);
            }
        }

        if ($request && ($request->isGET() || $request->isHEAD())) {
            // skip $ignore_paths and home (`/`)
            if ($request->getURL() == ''
                || preg_match(
                    '/^(' . implode('|', $ignore_paths) . ')/i',
                    $request->getURL()
                )
            ) {
                return $delegate($request);
            }

            $requested_url = $_SERVER['REQUEST_URI'];

            $expected_url = rtrim(
                Director::baseURL() . $request->getURL(), '/'
            ) . '/';

            $urlPathInfo = pathinfo($requested_url);

            $params = $request->getVars();

            $ignore_agents = Config::inst()->get(TrailingSlashRedirector::class, 'ignore_agents');

            if (!Director::is_ajax()
                && !($ignore_agents && in_array(
                    $request->getHeader('User-Agent'),
                    $ignore_agents
                ))
                && !isset($urlPathInfo['extension'])
                && empty($params)
                && !preg_match(
                    '/^' . preg_quote($expected_url, '/') . '(?!\/)/i',
                    $requested_url
                )
            ) {
                $params       = $request->getVars();
                $redirect_url = Controller::join_links($expected_url, '/');
                $response     = new HTTPResponse();

                return $response->redirect($redirect_url, 301);
            }
        }

        $response = $delegate($request);

        return $response;
    }
}
