<?php

namespace TheHustle\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

class ContainerControllerExtension extends Extension
{
    public function onAfterInit()
    {
        Requirements::css('thehustle/silverstripe-element-container: client/dist/css/layout.css');
    }
}
