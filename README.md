# Marketo Rest Api Client

![Build Status](https://img.shields.io/circleci/project/github/generationtux/marketo-rest-api-client.svg?style=flat-square)

## Installation

`composer require generationtux/marketo-rest-api-client`

## Usage

### Instantiation

```php
$client = new Client([
    'api_url' => 'foo.bar/api',
    'client_id' => 'foobarid',
    'client_secret' => 'foobarsecret'
]);
```

### Creating a lead

Click [here](http://developers.marketo.com/rest-api/lead-database/fields/list-of-standard-fields/) to find all valid fields for leads.

```php
$client->leads()->create([
    [
      'firstName' => 'Joe',
      'lastName'  => 'Bar',
      'email'     => 'foolead1@bar.com'
    ],
    [
      'firstName' => 'Sally',
      'lastName'  => 'Bar',
      'email'     => 'foolead2@bar.com'
    ]
]);
```

### Getting a lead

```php
$lead = $client->leads()->show('fooemail@bar.com'); // outputs an object with all valid information on the lead

$lead->email; // outputs 'fooemail@bar.com'
```

### Triggering a campaign

To trigger a campaign, provide the campaign id, the email of the lead that will receive the campaign email, 
and an array of tokens (variables) for the template email belonging to the campaign

```php
$client-campaign()
    ->trigger(1234, 'foobar@email.com',
        [
            '{{my.name}}' => 'Foo'
        ]
    );
```