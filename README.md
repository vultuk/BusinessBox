# businessinabox_api
Integration with Business in a Box API

## Implementation

```
$urn = '/test-api/echo';
$url = 'http://yourbusinessinabox.co.uk';
$publicKey = 'publickey';
$privateKey = 'privatekey';

$result = Remote::request(
        Client::create([
            'title' => 'Mr',
        ]),
        Pension::create([
            'title' => 'Mr',
        ]),
        Appointment::create(
            new \Carbon\Carbon('2015-11-01 09:20'),
            'Knock Loudly'
        ),
        $urn,
        $url,
        new Encrypt(
            $publicKey,
            $privateKey
        )
    );
```