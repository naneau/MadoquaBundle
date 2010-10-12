<?php
/**
 * MadoquaExtension.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      DependencyInjection
 */

namespace Application\MadoquaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * MadoquaExtension
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      DependencyInjection
 */
class MadoquaExtension extends Extension
{
    /**
     * xml loader
     *
     * @var XmlFileLoader
     */
    private $loader;
    
    /**
     * Loads a specific configuration.
     *
     * @param string  $tag The tag name
     * @param array   $config An array of configuration values
     * @param ContainerBuilder $configuration   A ContainerBuilder instance
     *
     * @return ContainerBuilder A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load($tag, array $config, ContainerBuilder $configuration)
    {
        $file = $tag . '.xml';
        
        $this->getLoader($configuration)->load($file);
        
        return $configuration;
    }

    /**
     * Returns the namespace to be used for this extension (XML namespace).
     *
     * @return string The XML namespace
     */
    public function getNamespace()
    {
        
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'madoqua';
    }
    
    /**
     * get loader for XML files
     *
     * @return XmlFileLoader
     */
    private function getLoader($configuration)
    {
        if (!$this->loader) {
            $this->loader = new XmlFileLoader($configuration, __DIR__ . '/../Resources/config/');
        }
        
        return $this->loader;
    }    
}