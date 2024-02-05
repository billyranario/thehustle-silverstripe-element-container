<?php 

namespace TheHustle\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\View\SSViewer; // Import SSViewer to get the current theme

class PublishTemplate extends BuildTask
{
    protected $title = 'Publish Template Task';
    protected $description = 'Copies ElementHolder.ss, layout.css, and postcss.config.js to the project directories.';

    public function run($request)
    {
        // Copy ElementHolder.ss
        $this->copyFile(
            '/vendor/thehustle/silverstripe-element-container/templates/DNADesign/Elemental/Layout/ElementHolder.ss',
            '/app/templates/DNADesign/Elemental/Layout/ElementHolder.ss'
        );

        // Identify the current theme and copy layout.css
        $currentTheme = SSViewer::get_theme_folder();
        if ($currentTheme) {
            $this->copyFile(
                '/vendor/thehustle/silverstripe-element-container/css/layout.css',
                "/themes/{$currentTheme}/css/layout.css"
            );
        } else {
            echo "No active theme found.\n";
        }
    }

    private function copyFile($sourcePath, $destinationPath)
    {
        $source = BASE_PATH . $sourcePath;
        $destination = BASE_PATH . $destinationPath;
        $destinationDir = dirname($destination);

        if (!file_exists($destination)) {
            if (!is_dir($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }
            if (copy($source, $destination)) {
                echo "File '$sourcePath' copied to '$destinationPath' successfully.\n";
            } else {
                echo "Failed to copy '$sourcePath'.\n";
            }
        } else {
            echo "'$destinationPath' already exists. No action taken.\n";
        }
    }
}
