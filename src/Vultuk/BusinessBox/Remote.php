<?php

namespace Vultuk\BusinessBox;

use Guzzle\Http\Client as GuzzleClient;
use Vultuk\BusinessBox\Contracts\Appointment as AppointmentContract;
use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Contracts\Encrypt as EncryptContract;
use Vultuk\BusinessBox\Contracts\Product as ProductContract;

/**
 * Class used to connect and interact with the remote server and send
 * required details to the API
 *
 * Class Remote
 * @package Vultuk\BusinessBox
 */
class Remote
{
    /**
     * Property to store the URL, defaults to the standard URL
     *
     * @var string
     */
    protected $url = "http://yourbusinessinabox.co.uk";

    /**
     * Property to store the URN
     *
     * @var string|null
     */
    protected $urn = null;

    /**
     * Storage for the Guzzle object
     *
     * @var GuzzleClient|null
     */
    protected $guzzleClient = null;

    /**
     * Property to store the result
     *
     * @var \Guzzle\Http\Message\Response/null
     */
    protected $result = null;

    /**
     * Property to hold the Encryption method
     *
     * @var EncryptContract/null
     */
    protected $encryptor = null;

    /**
     * Sends the client, product and appointment details to the API
     *
     * @param ClientContract $client
     * @param ProductContract|null $product
     * @param AppointmentContract|null $appointment
     * @return \Guzzle\Http\Message\Response
     */
    public function send(ClientContract $client, ProductContract $product = null, AppointmentContract $appointment = null)
    {
        $contentBody = [];

        if (empty($client))
        {
            throw new \UnexpectedValueException('Client Details must be specified');
        }

        $contentBody['client'] = $client->toArray();

        if (!empty($product))
        {
            $contentBody[$product->getKey()] = $product->toArray();
        }

        if (!empty($appointment))
        {
            $contentBody['appointment'] = $appointment->toArray();
        }

        $result = $this->guzzleClient->post(
            $this->url . "/" . $this->urn,
            null,
            empty($this->encryptor) ? $contentBody : $this->encryptor->encryptData(json_encode($contentBody))
        );

        return $result->send();
    }


    /**
     * Static method to send all details to the API in one call
     *
     * @param ClientContract $client
     * @param ProductContract|null $product
     * @param AppointmentContract|null $appointment
     * @param $urn
     * @param $url
     * @param EncryptContract|null $encryptor
     * @return \Guzzle\Http\Message\Response
     */
    public static function request(
        ClientContract $client,
        ProductContract $product = null,
        AppointmentContract $appointment = null,
        $urn,
        $url,
        EncryptContract $encryptor = null)
    {
        $remote = new self($urn, $url, $encryptor);

        return $remote->send($client, $product, $appointment);
    }

    /**
     * Constructor
     *
     * @param $urn
     * @param $url
     * @param EncryptContract|null $encryptor
     */
    public function __construct($urn, $url, EncryptContract $encryptor = null)
    {
        // Instantiate the Guzzle Library
        $this->guzzleClient = new GuzzleClient();

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

        // Store the Encryption object
        $this->encryptor = $encryptor;
    }

}
