<?php 

namespace TheHustle\Tasks;

use SilverStripe\Dev\BuildTask;

class PublishTemplate extends BuildTask
{
    protected $title = 'Publish Template Task';

    protected $description = 'Creates a copy for ElementHolder.ss to the project templates directory.';

    public function run($request)
    {
        $source = BASE_PATH . '/vendor/thehustle/silverstripe-element-container/templates/DNADesign/Elemental/Layout/ElementHolder.ss';
        $destination = BASE_PATH . '/app/templates/DNADesign/Elemental/Layout/ElementHolder.ss';

        if (!file_exists($destination)) {
            copy($source, $destination);
            echo "Template copied successfully.\n";
        } else {
            echo "Template already exists. No action taken.\n";
        }
    }
}
