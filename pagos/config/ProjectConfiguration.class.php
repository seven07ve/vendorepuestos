<?php
//$_SERVER["REQUEST_URI"] = str_replace($_SERVER["SCRIPT_NAME"], "", $_SERVER["REQUEST_URI"]);
require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        $this->setWebDir($this->getRootDir());
        $this->enablePlugins('sfDoctrinePlugin');
        $this->enablePlugins('sfFormExtraPlugin');
    }
}
