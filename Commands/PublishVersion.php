<?php /** @noinspection ALL */

namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishVersion extends Command
{
    /** @var string */
    protected static $defaultName = 'publish:version';

    protected function configure()
    {
        $this->setDescription('Publishes a new version of the documentation.')
            ->setHelp('
                Publishes a new version of the documentation using the `version` parameter provided.
                    -- publish:version <version>
                    -- --major - an optional flag to state this is a major release and so requires the full works, new folder and config updates.w
            ')
            ->addArgument('version', InputArgument::REQUIRED, 'The version to publish')
            ->addOption('major', null, InputOption::VALUE_NONE, 'Is this a major release?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $isMajor = $input->getOption('major');
        $version = $input->getArgument('version');
        list($major, $minor) = explode('.', $version);
        $versionMajorMinor = $major . '.' . $minor;

        $output->writeln('<info>////////////////////////////////////////////</info>');
        $output->writeln('<info>/// BUILDING DOCS FOR VERSION ' . $version . '///</info>');
        $output->writeln('<info>////////////////////////////////////////////</info>');

        // 1. Update config files
        $output->writeln('Updating configuration...');

        $config = include __DIR__ . '/../versions.config.php';

        if(($isMajor && in_array($versionMajorMinor, $config['versions'])) || $config['released_version'] === $version) {
            $output->writeln('<error>' . $version . ' has already been released.');
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
            $output->writeln('Copying master directory to '.$versionMajorMinor.'...');

            $files = new \Illuminate\Filesystem\Filesystem;
            $files->copyDirectory(__DIR__ . '/../source/docs/master', __DIR__ . '/../source/docs/' . $versionMajorMinor);
        }

        $output->writeln('<info>Completed</info>');
    }
}