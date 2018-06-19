<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 19.06.2018
 * Time: 22:19
 */

namespace MegaDataClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for MegaDataClientBundle
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $tree = new TreeBuilder();
        $rootNode = $tree->root('mega_data_client');
        $rootNode
            ->children()
                ->scalarNode('url')
                ->end()
            ->end()
        ;
    }
}