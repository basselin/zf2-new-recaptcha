<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptcha\Form\Element\Service;

use NewReCaptcha\Form\Element\NewReCaptcha;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewReCaptchaFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return NewReCaptcha
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var ServiceLocatorInterface $sl */
        $sl = $serviceLocator->getServiceLocator();
        $config = $sl->get('Config');

        $element = new NewReCaptcha();
        if (isset($config['new_recaptcha'])) {
            $configCaptcha = $config['new_recaptcha'];
            if (!empty($configCaptcha['site_key']) && !empty($configCaptcha['secret_key'])) {
                $element->setSiteKey($configCaptcha['site_key']);
                $element->setSecretKey($configCaptcha['secret_key']);
            }
            if (isset($configCaptcha['remote_ip'])) {
                $element->setRemoteIp($configCaptcha['remote_ip']);
            }
        }
        $element->setRequest($sl->get('Request'));
        return $element;
    }
}
