<?php /** @noinspection ALL */

namespace App\Commands;

use Madnest\Madzipper\Madzipper;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use ZipArchive;
use Carbon\Carbon;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SSH2;
use phpseclib3\Net\SFTP;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Deploy extends Command
{
    /** @var string */
    protected static $defaultName = 'deploy';

    private $files = [
        'assets',
        'blog',
        'docs',
        'supporters',
        'index.html',
        'sitemap.xml',
    ];

    protected function configure()
    {
        $this->setDescription('Deploy the built documentation via SSH to the given host/folder. Note: this will pull down the latest master version of the docs and then begin running commands')
            ->setHelp('
                Deploy the built documentation via SSH to the given host/folder. Note: this will pull down the latest master version of the docs and then begin running commands
            ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $titleSection = $output->section();
        $progressSection = $output->section();

        $titleSection->writeln('<info>///////// Deploying to server as defined in .env-deployment //////////</info>');
        if(!is_dir(__DIR__ . '/../build_production')) {
            $progressSection->writeln('<error>Please run \'php bulmajs fetch:versions\' and \'npm run production\' first.');
            return Command::FAILURE;
        }

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env-deployment');
        $dotenv->load();

        $ssh = new SSH2($_ENV['HOST']);
        $sftp = new SFTP($_ENV['HOST']);
        $key = PublicKeyLoader::load(file_get_contents($_ENV['KEY_PATH']));
        $targetDirectory = $_ENV['TARGET_DIR'];

        if(!$ssh->login($_ENV['USER'], $key) || !$sftp->login($_ENV['USER'], $key)) {
            $progressSection->writeln('<error>Error connecting!</error>');
            return Command::FAILURE;
        }

        $fetchCommand = $this->getApplication()->find('fetch:versions');

        $progressSection->overwrite('<info>Creating zip...</info>');
        $this->buildZip();

        $progressSection->overwrite('<info>Uploading zip...</info>');
        $sftp->delete($targetDirectory . 'build.zip');
        $sftp->put($targetDirectory . 'build.zip', __DIR__ . '/../build.zip', SFTP::SOURCE_LOCAL_FILE);

        $progressSection->overwrite('<info>Removing current version...</info>');
        foreach($this->files as $file) {
            $sftp->delete($targetDirectory . $file);
        }

        $progressSection->overwrite('<info>Unzipping...</info>');
        $ssh->exec("cd $targetDirectory && unzip build.zip");
        $sftp->delete($targetDirectory . 'build.zip');

        $progressSection->overwrite('<info>Cleaning up...</info>');
        @unlink(__DIR__ . '/../build.zip');

        $progressSection->overwrite('<info>Deployment complete</info>');

        return 0;
    }

    private function buildZip()
    {
        $zipper = new Madzipper;

        $zipper->make(__DIR__ . '/../build.zip')
            ->add(__DIR__ . '/../build_production')
            ->close();
    }
}