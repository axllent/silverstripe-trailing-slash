SilverStripe Trailing Slash
===

An extension to ensure that a single trailing slash is always added to the URL.
If a URL is detected with no trailing slash, or ending in multiple slashes, the
request is redirected.

URLs accessed via Ajax, or that contain an extension are ignored.

## Examples
- `example.com/contact` is redirected to `example.com/contact/`
- `example.com/contact//` is redirected to `example.com/contact/`
- `example.com/view?var=1` is redirected to `example.com/view/?var=1`

## Requirements
- SilverStripe 3.0+

## Installation and configuration
- Extract (or use composer) to add to your SilverStripe webroot.
- Run `?flush=1`
- There are no configuration options