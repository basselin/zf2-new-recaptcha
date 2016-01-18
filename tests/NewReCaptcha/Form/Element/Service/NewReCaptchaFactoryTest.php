<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptchaTest\Form\Element\Service;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class NewReCaptchaFactoryTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(include 'config/application.config.php');
        parent::setUp();
    }

    public function testCreateService()
    {
        $sl = $this->getApplicationServiceLocator();

        /* @var \NewReCaptcha\Form\Element\NewReCaptcha $element */
        $element = $sl->get('FormElementManager')->get('NewReCaptcha');
        $this->assertInstanceOf('NewReCaptcha\Form\Element\NewReCaptcha', $element);
        $this->assertInstanceOf('NewReCaptcha\Validator\NewReCaptcha', $element->getValidator());
        $this->assertInstanceOf('Zend\Http\Request', $element->getRequest());
    }
}
