<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015, Benoit Asselin contact(at)ab-d.fr
 * @license   MIT Licence
 */

namespace NewReCaptcha\Form\View\Helper;

use NewReCaptcha\Form\Element\NewReCaptcha;
use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * Helper: $this->formNewReCaptcha();
 * @see Zend\Form\View\Helper\FormHidden
 */
class FormNewReCaptcha extends AbstractHelper
{
    /**
     * @const string
     */
    const URL_API_JS = 'https://www.google.com/recaptcha/api.js';

    /**
     * The color theme of the widget
     *
     * @var string
     */
    protected $theme;

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  NewReCaptcha|ElementInterface $element
     * @param  bool $withApiJs
     * @param  string $theme 'light' or 'dark'
     * @return string
     */
    public function __invoke(ElementInterface $element = null, $withApiJs = true, $theme = null)
    {
        if ($withApiJs) {
            $this->appendApiJs();
        }

        if (!$element || !$element instanceof NewReCaptcha) {
            return $this;
        }
        if ($theme) {
            $this->setTheme($theme);
        }
        return $this->render($element);
    }

    /**
     * @param  NewReCaptcha|ElementInterface $newReCaptcha
     * @return string
     */
    public function render(NewReCaptcha $newReCaptcha)
    {
        /* @var \Zend\Form\View\Helper\FormHidden $url */
        $formHidden = $this->view->plugin('formHidden');
        $html  = $formHidden($newReCaptcha);
        $html .= '<div class="g-recaptcha"';
        $html .= ' data-sitekey="' . $newReCaptcha->getSiteKey() . '"';
        if ($this->theme) {
            $html .= ' data-theme="' . $this->theme . '"';
        }
        $html .= '>';
        if (!$newReCaptcha->getSiteKey()) {
            $html .= '<code>data-sitekey</code> was empty.';
        }
        $html .= '</div>';
        return $html;
    }

    /**
     * @return FormNewReCaptcha
     */
    public function appendApiJs()
    {
        $this->view->plugin('headScript')->appendFile(static::URL_API_JS);
        return $this;
    }

    /**
     * The color theme of the widget
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * The color theme of the widget
     *
     * @param  string $theme
     * @return FormNewReCaptcha
     */
    public function setTheme($theme = null)
    {
        if (!in_array($theme, array('light', 'dark'))) {
            $theme = null;
        }
        $this->theme = $theme;
        return $this;
    }
}
