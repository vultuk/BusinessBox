# businessinabox_api
Integration with Business in a Box API

## Implementation

```
$urn = '/test-api/echo';
$url = 'http://yourbusinessinabox.co.uk';
$publicKey = 'publickey';
$privateKey = 'privatekey';

$result = \Vultuk\BusinessBox\Remote::request(
        \Vultuk\BusinessBox\Client::create([
            'title' => 'Mr',
        ]),
        \Vultuk\BusinessBox\Products\Pension::create([
            'title' => 'Mr',
        ]),
        \Vultuk\BusinessBox\Appointment::create(
            new \Carbon\Carbon('2015-11-01 09:20'),
            'Knock Loudly'
        ),
        $urn,
        $url,
        new \Vultuk\BusinessBox\Encrypt(
            $publicKey,
            $privateKey
        )
    );
```