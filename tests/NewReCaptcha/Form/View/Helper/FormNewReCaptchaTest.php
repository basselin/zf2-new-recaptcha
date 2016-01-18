<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptchaTest\Form\View\Helper;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class FormNewReCaptchaTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(include 'config/application.config.php');
        parent::setUp();
    }

    public function testCreateService()
    {
        $sl = $this->getApplicationServiceLocator();

        /* @var \NewReCaptcha\Form\View\Helper\FormNewReCaptcha $helper */
        $helper = $sl->get('ViewHelperManager')->get('FormNewReCaptcha');
        $this->assertInstanceOf('NewReCaptcha\Form\View\Helper\FormNewReCaptcha', $helper);
    }

    public function testAppendApiJs()
    {
        $sl = $this->getApplicationServiceLocator();

        /* @var \NewReCaptcha\Form\View\Helper\FormNewReCaptcha $helper */
        $helper = $sl->get('ViewHelperManager')->get('FormNewReCaptcha');
        $helper->appendApiJs();
    }

    public function testGetSetTheme()
    {
        $sl = $this->getApplicationServiceLocator();

        /* @var \NewReCaptcha\Form\View\Helper\FormNewReCaptcha $helper */
        $helper = $sl->get('ViewHelperManager')->get('FormNewReCaptcha');
        $this->assertNull($helper->getTheme());

        $helper->setTheme('toto');
        $this->assertNull($helper->getTheme());

        $helper->setTheme('dark');
        $this->assertEquals('dark', $helper->getTheme());

        $helper->setTheme('light');
        $this->assertEquals('light', $helper->getTheme());
    }
}
