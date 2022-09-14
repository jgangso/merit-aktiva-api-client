[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
# MeritAktiva API Client

A PHP client library for [MeritAktiva API](https://api.merit.ee/connecting-robots/reference-manual/).

The aim is to provide a consistent, fully tested developer experience across endpoints, while preserving transparency to the API, so that the library itself isn't preventing developers from fully leveraging all capabilities of it.


## Features

- Internal models for all MeritAktiva entities
- Service-oriented approach. Each API endpoint is represented by a service.


## Installation

Add the library to your project with composer.

```bash
  composer req jgangso/merit-aktiva-api-client
```


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`MERIT_API_ID` - from MeritAktiva settings

`MERIT_API_KEY` - from MeritAktiva settings

`MERIT_API_LOCALE` - The localization of the API. This is not related to any specific transaction, but to connect [to the correct API](https://api.merit.ee/connecting-robots/reference-manual/endpoints/). Either `ee`, `pl` or `fi`.

`MERIT_DEFAULT_ITEM_CODE` - A valid (existing) item code to use as _fallback_. It's up to the implementor whether to ensure that all items exist before creating a sales invoice or not, for instance.

`MERIT_DEFAULT_CUSTOMER_NAME` - A valid (existing) customer name to use as _fallback_. Same principle applies as with item code.



## Usage/Examples

```php
<?php

// Create API client instance
$merit = new MeritAktiva(
    $_ENV['MERIT_API_ID'], 
    $_ENV['MERIT_API_KEY'], 
    $_ENV['MERIT_API_LOCALE']
);

// Get list of sales invoices
$invoices = $merit->getSalesInvoiceService()->query( [
    'Periodstart' => date('Ymd', strtotime('-3 months')),
    'PeriodEnd'   => date('Ymd', strtotime('now'))
] );

```

## Running Tests

To set up the test environment for the first time, copy `phpunit.xml.dist` to `phpunit.xml` and fill in the values for environment variables (refer to the section [environment variables](#Environment-Variables)).

To run tests, do the following:

```bash
  php vendor/bin/phpunit -vvv tests
```


## Roadmap

- Implement all methods from the MeritAktiva API.


## Contributing

Contributions are always welcome! Submit PRs, report bugs and make suggestions.


## Feedback

If you have any feedback, please reach out to me at jgangso at gmail dot com.


## Authors

- [@jgangso](https://www.github.com/jgangso)

