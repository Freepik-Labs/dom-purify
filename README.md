# DOMPurify php wrapper

A simple wrapper to [Dom Purify](https://github.com/cure53/DOMPurify) js library.

Check [this page](https://github.com/cure53/DOMPurify/tree/main/demos#what-is-this) for more config options

## Requirements
- php:  *>=7.4*
- node: *>=10.21.0*

## Installation

```bash
composer require freepik-labs/dom-purify
````

## Usage

```php
<?php
    use FreepikLabs\DomPurify\Purifier;

    $process = new Purifier;

    // Output will look like <svg><g></g></svg>
    $sanitized = $process->clean('<svg><g onload="alert(\'test\')"></g>', [
        'USE_PROFILES' => [
            'svg' => true
        ]
    ]);
```
