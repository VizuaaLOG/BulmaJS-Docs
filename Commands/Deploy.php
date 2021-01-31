<?php /** @noinspection ALL */

namespace App\Commands;

use Carbon\Carbon;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SSH2;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Deploy extends Command
{
    /** @var string */
    protected static $defaultName = 'deploy';

    protected function configure()
    {
        $this->setDescription('Deploy the built documentation via SSH to the given host/folder. Note: this will pull down the latest master version of the docs and then begin running commands')
            ->setHelp('
                Deploy the built documentation via SSH to the given host/folder. Note: this will pull down the latest master version of the docs and then begin running commands
            ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>////////////////////////////////////////////</info>');
        $output->writeln('<info>/// Deploying to server as defined in .env-deployment ///</info>');
        $output->writeln('<info>////////////////////////////////////////////</info>');

        $ssh = new SSH2('host');
        $key = PublicKeyLoader::load(file_get_contents('path_to_private_key'));
        $targetDirectory = 'target_directory';

        if(!$ssh->login('bulmajs', $key)) {
            $output->writeln('Error connecting!');
            return 1;
        }

        $now = Carbon::now()->unix();
//        $now = 'debug';
        $ssh->exec("rm -rf $targetDirectory/$now");

        // TODO: Change this to instead build everything locally, ZIP up the folder and upload / unzip that. This current approach is unreliable.

        // Create a new directory
        $output->writeln("<info>Creating new directory called $now</info>");
        $output->write($ssh->exec("mkdir $targetDirectory/$now"));

        $output->writeln('<info>Cloning the latest master branch...</info>');
        $output->write($ssh->exec("git clone --depth=1 https://github.com/VizuaaLOG/BulmaJS-Docs $targetDirectory/$now"));

        $output->writeln('<info>Running compoer install...</info>');
        $output->write($ssh->exec("cd $targetDirectory/$now && composer install"));

        $output->writeln('<info>Running NPM install...</info>');
        $output->write($ssh->exec("cd $targetDirectory/$now && npm install"));

        $output->writeln('<info>Fetching Bulma versions...</info>');
        $output->write($ssh->exec("cd $targetDirectory/$now && php bulmajs fetch:versions"));

        $output->writeln('<info>Building docs...</info>');
        $output->write($ssh->exec("cd $targetDirectory/$now && npm run production"));
        $output->write($ssh->exec("cd $targetDirectory/$now && ./vendor/bin/jigsaw build production"));

        return 0;
    }
}