# Changelog

Notable changes to this project will be documented in this file.

## [2.2.5]

- Don't rely on `$_SERVER` values for redirect (thanks [wilr](https://github.com/axllent/silverstripe-trailing-slash/pull/14))


## [2.2.4]

- Fixes some setups of unwrapped % in yaml breaking site


## [2.2.3]

- Add `silverstripe/staticpublishqueue` to configurable list of ignored user agents


## [2.2.2]

- Add support for `silverstripe/staticpublishqueue` ([link](https://github.com/axllent/silverstripe-trailing-slash/pull/11))


## [2.2.1]

- Fix deprecation notice on php7.4 (switched parameters in `implode()` function.)


## [2.2.0]

- Add config yaml to skip additional paths


## [2.1.3]

- Better handling as `dev/tasks` do not return getURL() value


## [2.1.2]

- Don't redirect from within `admin/` or `/dev/`


## [2.1.1]

- Remove hardcoded check for 'home'


## [2.1.0]

- Use HTTPMiddleware for SS4


## [2.0.2]

- Switch to silverstripe-vendormodule


## [2.0.1]

- Don't redirect 'home' (endless loop)


## [2.0.0]

- Support for SilverStripe 4
- Different detection logic due to changes in `$request->getURL()`
- Ignore URLs with query parameters
