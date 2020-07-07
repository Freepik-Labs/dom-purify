# DOMPurify php wrapper

A simple wrapper to [Dom Purify](https://github.com/cure53/DOMPurify) js library

## Requirements
- php:  *>7.4*

## Installation

```bash
composer require freepik-labs/dom-purify
````

## Usage

```php
<?php
    use FreepikLabs\DomPurify\Purifier;

    $process = new Purifier;
    $output = $process->clean('<svg><g onload="alert(\'test\')"></g>', [
        'USE_PROFILES' => [
            'svg' => true
        ]
    ]);

    $this->assertEquals('<svg><g></g></svg>', $output);
```
