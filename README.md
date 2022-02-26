# Shopware 6 additional config commands
Shopware 6 plugin adding additional config commands to the CLI. The default console only supports two commands (`system:config:get` and `system:config:set`). This plugin adds the commands `system:config:list`.

## Installation
```bash
composer require yireo/shopware6-additional-config-commands
bin/console plugin:refresh
bin/console plugin:install YireoAdditionalConfigCommands
bin/console cache:clear
```

## Usage
```bash
bin/console system:config:list
```
