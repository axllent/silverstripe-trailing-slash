# Installation

```
composer require axllent/silverstripe-trailing-slash
```


## Caveats

When using the silverstripe/silverstripe-staticpublishqueue module the REQUEST_URI is updated so what's used for the request will be different from what is defined in $_SERVER['REQUEST_URI']. As the REQUEST_URI can no longer be used to determine if a trailing slash is required then it makes more sense to ignore the user agent for staticpublishqueue.

The User agent can be ignored by this module by setting;

```yaml
Axllent\TrailingSlash\Middleware\TrailingSlashRedirector:
  ignore_agents:
    - 'silverstripe/staticpublishqueue'
```

ref; https://github.com/silverstripe/silverstripe-staticpublishqueue/blob/master/src/Publisher.php#L82-L101
