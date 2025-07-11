# Silverstripe Trailing Slash

Ensure that a single trailing slash is always added to the URL.

Only GET and HEAD requests are redirected, excluding URLS that contain a file extension or query parameter.
Detected ajax requests are also ignored.

## Note:

This module is no longer actively developed since the majority of the functionality is handled natively within Silverstripe 5 & 6.
To enable trailing slashes **without** the need for this module, simply add the following to your yaml configuration:

```yaml
SilverStripe\Control\Controller:
  add_trailing_slash: true
```

This module has been kept alive for the list of [depended modules](https://github.com/axllent/silverstripe-trailing-slash/network/dependents).


## Examples

- `example.com/contact` is redirected to `example.com/contact/`
- `example.com/contact//` is redirected to `example.com/contact/`
- `example.com/contact?test` is not redirected
- `example.com/contact.html` is not redirected


## Requirements

- Silverstripe ^4.0 || ^ 5.0 || ^6.0

For Silverstripe 3, please refer to the [Silverstripe3 branch](https://github.com/axllent/silverstripe-trailing-slash/tree/silverstripe3).

## Installation and configuration

```
composer require axllent/silverstripe-trailing-slash
```

- Run `?flush=1`


## Configuration

By default it will ignore any `admin/` & `dev/` URLs, as well as all ajax requests.
It also only acts on `$_GET` requests as not to interfere with any posted data, and
ignores any URL containing an extension (eg: `/contact.html`) or query parameter.

You can create additional "ignore_paths" by creating a yaml config
(eg: `app/_config/trailing-slash.yml`):

```yaml
Axllent\TrailingSlash\Middleware\TrailingSlashRedirector:
  ignore_paths:
    - 'events'
    - 'my/other/path'
```

These paths are relative to the base URL (`/`), so `events` will not match `/page/events`,
but will match `/events-2020`.

Please note that paths do not typically contain a trailing slash unless it is only
underlying URLs you wish to redirect. Wildcards etc are not supported in the syntax.
