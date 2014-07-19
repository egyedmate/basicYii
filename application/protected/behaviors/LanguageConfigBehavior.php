<?php
/**
 * @author: Máté Egyed <egyed.mate@effsystem.eu>
 * @version: 1.0
 *
 */

class LanguageConfigBehavior extends CBehavior
{
    /**
     * Declares events and the event handler methods
     * See yii documentation on behavior
     */
    public function events()
    {
        return array_merge(parent::events(), array(
            'onBeginRequest'=>'beginRequest',
        ));
    }
 
    /**
     * Load configuration that cannot be put in config/main
     */
    public function beginRequest()
    {
            $this->owner->language='hu';
    }
}