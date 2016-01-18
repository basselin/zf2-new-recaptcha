<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptcha\Form\Element;

use NewReCaptcha\Validator\NewReCaptcha as NewReCaptchaValidator;
use Zend\Form\ElementPrepareAwareInterface;
use Zend\Form\Exception;
use Zend\Form\Element;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\ValidatorInterface;

class NewReCaptcha extends Element implements InputProviderInterface, ElementPrepareAwareInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'hidden',
    );

    /**
     * Public key
     *
     * @var string
     */
    protected $siteKey;

    /**
     * Private key
     *
     * @var string
     */
    protected $secretKey;

    /**
     * Check IP
     *
     * @var bool
     */
    protected $remoteIp = true;

    /**
     * @var \Zend\Http\Request
     */
    protected $request;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * reCAPTCHA options
     * - site_key: Public key (html)
     * - secret_key: Private key
     * - remote_ip: Check IP
     *
     * @param  array|\Traversable $options
     * @return NewReCaptcha
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions($options)
    {
        parent::setOptions($options);

        if (empty($options['site_key']) || empty($options['secret_key'])) {
            throw new Exception\InvalidArgumentException(
                'The options site_key and/or secret_key were not found'
            );
        }
        $this->setSiteKey($options['site_key']);
        $this->setSecretKey($options['secret_key']);
        if (isset($options['remote_ip'])) {
            $this->setRemoteIp($options['remote_ip']);
        }
        return $this;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidator()
    {
        if (null === $this->validator) {
            $this->validator = new NewReCaptchaValidator(array(
                'request'    => $this->getRequest(),
                'secret_key' => $this->getSecretKey(),
                'remote_ip'  => $this->getRemoteIp(),
            ));
        }
        return $this->validator;
    }

    /**
     * @param  ValidatorInterface $validator
     * @return NewReCaptcha
     */
    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * Public key (html)
     *
     * @return string
     */
    public function getSiteKey()
    {
        return $this->siteKey;
    }

    /**
     * Public key
     *
     * @param  string $siteKey
     * @return NewReCaptcha
     */
    public function setSiteKey($siteKey)
    {
        $this->siteKey = (string) $siteKey;
        $this->setAttribute('data-sitekey', $this->siteKey); // input type="hidden"
        return $this;
    }

    /**
     * Private key
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Private key
     *
     * @param  string $secretKey
     * @return NewReCaptcha
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = (string) $secretKey;
        return $this;
    }

    /**
     * Check IP
     *
     * @return bool
     */
    public function getRemoteIp()
    {
        return $this->remoteIp;
    }

    /**
     * Check IP
     *
     * @param  bool $remoteIp
     * @return NewReCaptcha
     */
    public function setRemoteIp($remoteIp)
    {
        $this->remoteIp = (bool) $remoteIp;
        return $this;
    }

    /**
     * @return \Zend\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param  \Zend\Http\Request $request
     * @return NewReCaptcha
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Provide default input rules for this element
     *
     * @return array
     */
    public function getInputSpecification()
    {
        return array(
            'name' => $this->getName(),
            'required' => true,
            'validators' => array(
                $this->getValidator(),
            ),
        );
    }

    /**
     * @param  FormInterface $form
     * @return mixed
     */
    public function prepareElement(FormInterface $form)
    {
        $this->setValue('1');
    }
}
