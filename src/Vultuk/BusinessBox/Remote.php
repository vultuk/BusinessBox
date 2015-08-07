<?php

namespace Vultuk\BusinessBox;

use Guzzle\Http\Client;
use Vultuk\BusinessBox\Contracts\Appointment as AppointmentContract;
use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Contracts\Product as ProductContract;

class Remote
{
    protected $url = "http://yourbusinessinabox.co.uk";

    protected $urn = null;

    protected $guzzleClient = null;

    protected $result = null;

    public function send(ClientContract $client, ProductContract $product, AppointmentContract $appointment)
    {
        $result = $this->guzzleClient->post($this->url . "/" . $this->urn, [
            'client' => $client->toArray(),
            'appointment' => $appointment->toArray(),
        ]);

        return $result;
    }
    
    
    public static function request(ClientContract $client, ProductContract $product, AppointmentContract $appointment, $urn, $url = null)
    {
        $remote = new self($urn, $url);

        $remote->send($client, $product, $appointment);

        return $remote;
    }
    
    public function __construct($urn, $url = null)
    {
        // Instantiate the Guzzle Library
        $this->guzzleClient = new Client();

        // Ensure we are requesting the correct URL
        $this->url = !empty($url) ? $url : $this->url;

        // Make sure that we pass an URN
        if (empty($urn))
        {
            throw new \BadMethodCallException("URN must be supplied to enable connection to API.");
        }

        // Store the URN
        $this->urn = $urn;
    }

}
