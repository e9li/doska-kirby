<img src="assets/icon.svg" alt="Doska logo" width="84" height="75">

# Doska for Kirby

Dev-only toolbar for a Kirby site. Point at an element, write a note, and copy a prompt that names the PHP snippet and, in content mode, the content file and block. A connected agent can also read and resolve notes through the stateless MCP endpoint.

The plugin does nothing unless Kirby's `debug` option is true. It answers only local requests unless remote access is explicitly enabled.

## Install

```bash
composer require --dev doska/kirby
```

`getkirby/composer-installer` puts the plugin in `site/plugins/doska`.

```php
// site/config/config.php
return [
    'debug' => true,
    'doska.kirby' => [
        'enabled' => true,
        'allow_remote_access' => false,
        'dock' => 'bottom',
    ],
];
```

A Kirby page has one Dev / Content toggle on the toolbar. Dev leads the prompt with the PHP snippet. Content leads with the content file, field, block id, and block type, so a note can change a title without editing PHP. The choice is saved in the browser.

See the [canonical Doska README](https://git.e9li.com/e9li/doska) for configuration, source mapping, notes, and agent setup. Development happens in that monorepo; this package repository is generated and is read-only. The published package contains the toolbar asset and all shared PHP classes.

## License

MIT
