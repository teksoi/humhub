<?php

namespace humhub\widgets;

use humhub\components\Widget;

/**
 * Description of JsWidget
 *
 * @author buddha
 * @since 1.2
 */
class JsWidget extends Widget
{

    /**
     * Defines the select input field id
     * 
     * @var string 
     */
    public $id;

    /**
     * Js Widget namespace
     * @var type 
     */
    public $jsWidget;

    /*
     * Used to overwrite select input field attributes. This array can be used for overwriting
     * texts, or other picker settings.
     * 
     * @var string
     */
    public $options = [];

    /**
     * Event action handler.
     * @var type 
     */
    public $events = [];

    /**
     * Auto init flag.
     * @var mixed 
     */
    public $init = false;

    /**
     * Used to hide/show the actual input element.
     * @var type 
     */
    public $visible = true;

    protected function getOptions()
    {
        $attributes = $this->getAttributes();
        $attributes['data'] = $this->getData();
        $attributes['id'] = $this->getId();

        $this->setDefaultOptions();

        $result = \yii\helpers\ArrayHelper::merge($attributes, $this->options);

        if (!$this->visible) {
            if (isset($result['style'])) {
                $result['style'] .= ';display:none;';
            } else {
                $result['style'] = 'display:none;';
            }
        }

        return $result;
    }

    public function setDefaultOptions()
    {
        // Set event data
        foreach ($this->events as $event => $handler) {
            $this->options['data']['widget-action-' . $event] = $handler;
        }

        $this->options['data']['ui-widget'] = $this->jsWidget;

        if (!empty($this->init)) {
            $this->options['data']['ui-init'] = $this->init;
        }
    }

    public function getId($autoGenerate = true)
    {
        if ($this->id) {
            return $this->id;
        }
        return parent::getId($autoGenerate);
    }

    protected function getData()
    {
        return [];
    }

    protected function getAttributes()
    {
        return [];
    }

}