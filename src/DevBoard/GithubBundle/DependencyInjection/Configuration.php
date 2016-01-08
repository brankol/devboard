<?php
namespace DevBoard\GithubBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link * http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('dev_board_github', 'array');

        $rootNode
            ->children()
            ->arrayNode('hook')
            ->children()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->arrayNode('config')
            ->children()
            ->scalarNode('url')->cannotBeEmpty()->end()
            ->scalarNode('content_type')->end()
            ->booleanNode('insecure_ssl')->defaultFalse()->end()
            ->scalarNode('secret')->end()
            ->end()
            ->end()
            ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
