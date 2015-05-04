<?php
/**
 * PHP version ~5.5
 *
 * @category Command
 * @package  Fluency\Acme\Command
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */

namespace Fluency\Acme\Command;


use Fluency\Silex\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HelloCommand
 *
 * @category Command
 * @package  Fluency\Acme\Command
 * @author   Rafael Ernesto Espinosa Santiesteban <ralphlnx@gmail.com>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     http://fluency.inc.com
 */
class HelloCommand extends Command
{
    /**
     * Configures command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('acme:hello')
            ->setDescription('Say hello.');
    }

    /**
     * Executes command
     *
     * @param InputInterface  $input  Command input
     * @param OutputInterface $output Console output
     *
     * @return void
     */
    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $output->writeln('Hello my friend...');
    }
}