<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015, Benoit Asselin contact(at)ab-d.fr
 * @license   MIT License
 */

namespace NewReCaptcha\Validator;

use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

class NewReCaptcha extends AbstractValidator
{
    /**
     * @const string
     */
    const URL_VERIFY = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Input name
     *
     * @const string
     */
    const NAME = 'g-recaptcha-response';

    /**#@+
     * Error codes
     *
     * @const const
     */
    const MISSING_VALUE = 'missingValue';
    const BAD_CAPTCHA   = 'badCaptcha';
    /**#@-*/

    /**
     * Error messages
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::MISSING_VALUE => 'Missing captcha fields',
        self::BAD_CAPTCHA   => 'reCaptcha value is wrong',
    );

    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * Check IP
     *
     * @return bool
     */
    public function withRemoteIp()
    {
        return $this->getOption('remote_ip') && !empty($this->getIpAddress());
    }

    /**
     * Private key
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->getOption('secret_key');
    }

    /**
     * @return \Zend\Http\Request
     */
    public function getRequest()
    {
        return $this->getOption('request');
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        if (null === $this->ipAddress) {
            $remote = new RemoteAddress();
            $this->ipAddress = $remote->getIpAddress();
        }
        return $this->ipAddress;
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  string $value
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($value)
    {
        $request = $this->getRequest();
        if (empty($request->getPost(static::NAME))) {
            $this->error(static::MISSING_VALUE);
            return false;
        }

        $value = $request->getPost(static::NAME);
        $siteVerify  = static::URL_VERIFY;
        $siteVerify .= '?secret=' . $this->getSecretKey();
        $siteVerify .= '&response=' . urlencode($value);
        if ($this->withRemoteIp()) {
            $siteVerify .= '&remoteip=' . urlencode($this->getIpAddress());
        }
        $result = json_decode(file_get_contents($siteVerify), true);
        if (isset($result['success']) && $result['success']) {
            return true;
        }
        $this->error(static::BAD_CAPTCHA);
        return false;
    }
}
