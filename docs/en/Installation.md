# Installation

```
composer require axllent/silverstripe-trailing-slash
```


## Caveats

Some modules such as `silverstripe/staticpublishqueue` [override](https://github.com/silverstripe/silverstripe-staticpublishqueue/blob/e58a53ab6ce6f5137014a08c47db681f8fc94294/src/Publisher.php#L82-L99) the `REQUEST_URI` to "snapshot" the pages. This can cause conflicts with silverstripe-trailing-slash. To work around this `silverstripe/staticpublishqueue` has been added to an array of "ignored_agents" that are excluded from redirection. You can edit / update this list by setting:

```yaml
Axllent\TrailingSlash\Middleware\TrailingSlashRedirector:
  ignore_agents:
    - 'silverstripe/staticpublishqueue'
```
