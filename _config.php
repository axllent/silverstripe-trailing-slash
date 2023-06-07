<?php
/**
 * Disable redirection via Silverstripe middleware
 */
use SilverStripe\Control\Middleware\CanonicalURLMiddleware;

if (class_exists(CanonicalURLMiddleware::class)) {
    $c = CanonicalURLMiddleware::singleton();

    if (method_exists($c, 'setEnforceTrailingSlashConfig')) {
        $c->setEnforceTrailingSlashConfig(false);
    }
}
