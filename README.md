# SilverStripe Trailing Slash

An extension to ensure that a single trailing slash is always added to the URL.
If a URL is detected with no trailing slash, or ending in multiple slashes, the
request is redirected.

URLs that accessed via Ajax, contain an extension (eg: .json), or have one or
more query parameters are ignored.


## Examples

- `example.com/contact` is redirected to `example.com/contact/`
- `example.com/contact//` is redirected to `example.com/contact/`
- `example.com/contact?test` is not redirected
- `example.com/contact.html` is not redirected

## Requirements

- SilverStripe 4.*

For SilverStripe 3, please refer to the [SilverStripe3 branch](https://github.com/axllent/silverstripe-trailing-slash/tree/silverstripe3).

## Installation and configuration

```
composer require axllent/silverstripe-trailing-slash
```

- Run `?flush=1`
- There are no configuration options
