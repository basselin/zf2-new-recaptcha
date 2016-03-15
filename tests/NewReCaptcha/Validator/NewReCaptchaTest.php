<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptchaTest\Validator;

use NewReCaptcha\Validator\NewReCaptcha;
use Zend\Stdlib\Parameters;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class NewReCaptchaTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(include 'config/application.config.php');
        parent::setUp();
    }

    public function testIsValid1()
    {
        $sl = $this->getApplicationServiceLocator();

        /* @var \NewReCaptcha\Form\Element\NewReCaptcha $element */
        $element = $sl->get('FormElementManager')->get('NewReCaptcha');

        /* @var \NewReCaptcha\Validator\NewReCaptcha $validator */
        $validator = $element->getValidator();

        $this->assertInstanceOf('NewReCaptcha\Validator\NewReCaptcha', $validator);
        $this->assertInternalType('string', $validator->getIpAddress());
        $this->assertFalse($validator->isValid(null));
        $this->assertArrayHasKey(NewReCaptcha::MISSING_VALUE, $validator->getOption('messages'));
    }

    public function testIsValid2()
    {
        $sl = $this->getApplicationServiceLocator();
        /* @var \Zend\Http\Request $request */
        $request = $sl->get('Request');
        $request->setMethod($request::METHOD_POST);
        $request->setPost(new Parameters([
            NewReCaptcha::NAME => time(),
        ]));

        /* @var \NewReCaptcha\Form\Element\NewReCaptcha $element */
        $element = $sl->get('FormElementManager')->get('NewReCaptcha');

        /* @var \NewReCaptcha\Validator\NewReCaptcha $validator */
        $validator = $element->getValidator();

        $this->assertInstanceOf('NewReCaptcha\Validator\NewReCaptcha', $validator);
        $this->assertInternalType('string', $validator->getIpAddress());
        $this->assertFalse($validator->isValid(null));
        $this->assertArrayHasKey(NewReCaptcha::BAD_CAPTCHA, $validator->getOption('messages'));
    }
}
