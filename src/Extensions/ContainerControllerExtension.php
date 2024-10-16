<?php

namespace TheHustle\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

class ContainerControllerExtension extends Extension
{
    public function onAfterInit()
    {
        Requirements::css('thehustle/silverstripe-blocks: client/dist/css/layout.css');
    }
}
