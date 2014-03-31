<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modelitem');

class WebwinkelKeurModelConfig extends JModelItem {
    private $wwk_config = array(
        'invite_delay'     => 3,
        'sidebar_position' => 'left',
        'tooltip'          => true,
        'javascript'       => true,
    );

    public function getConfig() {
        $config = $this->wwk_config;
        $db = JFactory::getDBO();
        $db->setQuery("SELECT `value` FROM `#__webwinkelkeur_config` WHERE id = 1");
        $result = $db->loadResult();
        if($result)
            $config = array_merge($config, json_decode($result, true));
        return $config;
    }

    public function setConfig($config) {
        $json = json_encode($config);
        $db = JFactory::getDBO();
        $db->setQuery("REPLACE INTO `#__webwinkelkeur_config` SET `id` = 1, `value` = " . $db->quote($json));
        return !!$db->query();
    }
}
