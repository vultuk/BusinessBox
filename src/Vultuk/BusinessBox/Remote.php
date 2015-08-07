<?php

namespace Vultuk\BusinessBox;

use Guzzle\Http\Client;
use Vultuk\BusinessBox\Contracts\Appointment as AppointmentContract;
use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Contracts\Encrypt as EncryptContract;
use Vultuk\BusinessBox\Contracts\Product as ProductContract;

class Remote
{
    protected $url = "http://yourbusinessinabox.co.uk";

    protected $urn = null;

    protected $guzzleClient = null;

    protected $result = null;

    protected $encryptor = null;

    public function send(ClientContract $client, ProductContract $product, AppointmentContract $appointment)
    {
        $contentBody = json_encode([
            'client' => $client->toArray(),
            $product->getKey() => $product->toArray(),
            'appointment' => $appointment->toArray(),
        ]);

        $result = $this->guzzleClient->post(
            $this->url . "/" . $this->urn,
            null,
            empty($this->encryptor) ? $contentBody : $this->encryptor->encryptData($contentBody)
        );

        return $result->send();
    }
    
    
    public static function request(
        ClientContract $client,
        ProductContract $product,
        AppointmentContract $appointment,
        $urn,
        $url,
        EncryptContract $encryptor = null)
    {
        $remote = new self($urn, $url, $encryptor);

        return $remote->send($client, $product, $appointment);
    }
    
    public function __construct($urn, $url, EncryptContract $encryptor = null)
    {
        // Instantiate the Guzzle Library
        $this->guzzleClient = new Client();

        // Make sure that we pass an URL
        if (empty($url))
        {
            throw new \BadMethodCallException("URL must be supplied to enable connection to API.");
        }

        // Store the URL
        $this->url = $url;

        // Make sure that we pass an URN
        if (empty($urn))
        {
            throw new \BadMethodCallException("URN must be supplied to enable connection to API.");
        }

        // Store the URN
        $this->urn = $urn;

        $this->encryptor = $encryptor;
    }

}
