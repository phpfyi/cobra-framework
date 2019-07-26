<?php

namespace Cobra\Form\Validator;

use GuzzleHttp\Client;
use Cobra\Validator\Validator;

/**
 * Recaptcha Validator
 *
 * Validates a Google invisible recaptcha form field.
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RecaptchaValidator extends Validator
{
    /**
     * Recaptcha endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Client instance
     *
     * @var Client
     */
    protected $client;

    /**
     * Recaptcha secret key
     *
     * @var string
     */
    protected $secretKey;

    /**
     * Passed Recaptcha value
     *
     * @var string
     */
    protected $recaptcha;

    /**
     * Sets the client instance and secret key
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->secretKey = env('RECAPTCHA_SECRET_KEY');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'recaptcha';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        $this->recaptcha = trim($value);

        if ($this->recaptcha === '') {
            $this->message = 'Empty recaptcha value';
            return false;
        }
        if (!$this->isValidResponse()) {
            $this->message = 'Invalid recaptcha value';
            return false;
        }
        return true;
    }

    /**
     * Returns whether the recaptcha request was a success
     *
     * @return boolean
     */
    private function isValidResponse(): bool
    {
        $response = $this->client->post($this->getRequestEndpoint());
        $data = json_decode((string) $response->getBody());

        if (!is_object($data) || !property_exists($data, 'success') || $data->success !== true) {
            return false;
        }
        return true;
    }

    /**
     * Returns the full recaptcha request endpoint URL
     *
     * @return string
     */
    private function getRequestEndpoint(): string
    {
        $params = http_build_query(
            [
                'secret'   => $this->secretKey,
                'response' => $this->recaptcha
            ]
        );
        return $this->endpoint.'?'.$params;
    }
}
