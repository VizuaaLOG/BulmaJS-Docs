<?php /** @noinspection ALL */

namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchVersions extends Command
{
    /** @var string */
    protected static $defaultName = 'fetch:versions';

    private $gitRepo = 'https://github.com/VizuaaLOG/BulmaJS';

    protected function configure()
    {
        $this->setDescription('Fetches all branches for defined versions and places them in the bulmajs assets directory.')
            ->setHelp('
                Fetches all branches for defined versions and places them in the bulmajs assets directory.
                    --fresh - If provided any existing asset files will be deleted, otherwise they\'ll be ignored
                    --silent - Hide all output
            ')
            ->addOption('--fresh')
            ->addOption('--silent');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $isSilent = $input->getOption('silent');

        if(!$isSilent) {
            $output->writeln('<info>////////////////////////////////////////////</info>');
            $output->writeln('<info>/// FETCHING VERSIONS DEFINED IN versions.config.php ///</info>');
            $output->writeln('<info>////////////////////////////////////////////</info>');
        }

        $destination = __DIR__ . '/../source/assets/bulmajs/';

        $files = new \Illuminate\Filesystem\Filesystem;

        $config = include __DIR__ . '/../versions.config.php';

        if($input->getOption('fresh')) {
            $files->cleanDirectory($destination);
        }

        foreach($config['versions'] as $version) {
            if(!$isSilent) {
                $output->writeln('');
                $output->writeln('<info>Fetching version ' . $version . '</info>');
            }

            $outputDir = $destination . $version;

            if($files->isDirectory($outputDir)) {
                if(!$isSilent) {
                    $output->writeln('Skipping ' . $version . ' already cloned.');
                }
                continue;
            }

            $branch = $version === 'master' ? $version : $version . '.x';

            $command = "git clone --depth 1 --branch {$branch} {$this->gitRepo} {$outputDir}";

            exec($command);
        }

        if(!$isSilent) {
            $output->writeln('<info>Completed</info>');
        }

        return 0;
    }
}