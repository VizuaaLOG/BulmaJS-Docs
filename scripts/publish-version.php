<?php

/**
 * This script is run before deploying the updated docs and serves to speed up the process and minimise anything
 * being missed. This script will:
 * 1. Update the config.php and config.production.php to:
 *      a. include the new version in the versions array
 *      b. update the released version number
 *      c. update the docs version number (if relevant)
 * 2. If a major/minor version, then make a copy of the master folder into the new version folder
 * 3. Trigger a build for production
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Console\Input\InputOption;

(new Application('publish', '1.0.0'))
    ->register('publish')
        ->addArgument('version', InputArgument::REQUIRED, 'The version to publish')
        ->addOption('major', null, InputOption::VALUE_NONE, 'Is this a major release?')
        ->setCode(function(InputInterface $input, OutputInterface $output) {
            $isMajor = $input->getOption('major');
            $version = $input->getArgument('version');
            list($major, $minor) = explode('.', $version);
            $versionMajorMinor = $major . '.' . $minor;

            $output->write('<info>////////////////////////////////////////////</info>', true);
            $output->write('<info>/// BUILDING DOCS FOR VERSION ' . $version . '///</info>', true);
            $output->write('<info>////////////////////////////////////////////</info>', true);

            // 1. Update config files
            $output->write('Updating configuration...');

            $config = include __DIR__ . '/../versions.config.php';

            if(($isMajor && in_array($versionMajorMinor, $config['versions'])) || $config['released_version'] === $version) {
                $output->write('<error>' . $version . ' has already been released.', true);
                die;
            }

            if($isMajor) {
                $newArr = [];

                foreach($config['versions'] as $releasedVersion) {
                    if($releasedVersion !== 'master') {
                        $newArr[] = $releasedVersion;
                    }
                }

                $config['versions'] = array_merge([
                    'master',
                    $versionMajorMinor,
                ], $newArr);

                $config['documentation_version'] = $versionMajorMinor;
            }

            $config['released_version'] = $version;

            file_put_contents(__DIR__ . '/../versions.config.php',"<?php\nreturn ".(string) var_export($config, true).";\n");

            // 2. If major, make a copy of the master folder
            if($isMajor) {
                $output->write('Copying master directory to '.$versionMajorMinor.'...', true);

                $files = new Illuminate\Filesystem\Filesystem;
                $files->copyDirectory(__DIR__ . '/../source/docs/master', __DIR__ . '/../source/docs/' . $versionMajorMinor);
            }

            $output->write('Building for production...', true);
            exec('npm run production');

            $output->write('<info>Completed</info>', true);
        })
    ->getApplication()
    ->setDefaultCommand('publish', true) // Single command application
    ->run();