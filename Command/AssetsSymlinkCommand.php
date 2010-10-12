<?php
/**
 * AssetsSymlink.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Command
 */

namespace Application\MadoquaBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Command\Command;

use Symfony\Bundle\FrameworkBundle\Util\Filesystem;

/**
 * AssetsSymlink
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Command
 */
class AssetsSymlinkCommand extends Command
{
    /**
     * configure the command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDefinition(array(
                new InputArgument('target', InputArgument::REQUIRED, 'The target directory'),
            ))
            ->setName('assets:symlink');
    }
    
    /**
     * execute the command
     *
     * @param InputInterface $input 
     * @param OutputInterface $output 
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // var_dump($this->application);die();
        if (!is_dir($input->getArgument('target'))) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $input->getArgument('target')));
        }
        
        $filesystem = new Filesystem();
        
        $dirs = $this->application->getKernel()->getBundleDirs();
        
        foreach ($this->application->getKernel()->getBundles() as $bundle) {
            $tmp = dirname(str_replace('\\', '/', get_class($bundle)));
            $namespace = str_replace('/', '\\', dirname($tmp));
            $class = basename($tmp);
            
            if (isset($dirs[$namespace]) && is_dir($originDir = $dirs[$namespace].'/'.$class.'/Resources/public')) {
                $output->writeln(sprintf('Installing assets for <comment>%s\\%s</comment>', $namespace, $class));
                
                $targetDir = $input->getArgument('target').'/bundles/'.preg_replace('/bundle$/', '', strtolower($class));
            
                $filesystem->remove($targetDir);
                
                if (!file_exists(dirname($targetDir))) {
                    mkdir(dirname($targetDir), 0755, true);
                }
                
                $filesystem->symlink($originDir, $targetDir);
            }
        }
    }
}
