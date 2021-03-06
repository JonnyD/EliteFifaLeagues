<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * @param string $environment
     * @param bool $debug
     */
    public function __construct($environment, $debug)
    {
        date_default_timezone_set( 'Europe/Dublin' );
        parent::__construct($environment, $debug);
    }

    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new EliteFifa\BaseBundle\BaseBundle(),
            new EliteFifa\RegionBundle\RegionBundle(),
            new EliteFifa\AssociationBundle\AssociationBundle(),
            new EliteFifa\CompetitionBundle\CompetitionBundle(),
            new EliteFifa\ParticipantBundle\ParticipantBundle(),
            new EliteFifa\PlayerBundle\PlayerBundle(),
            new EliteFifa\SeasonBundle\SeasonBundle(),
            new EliteFifa\StadiumBundle\StadiumBundle(),
            new EliteFifa\TeamBundle\TeamBundle(),
            new EliteFifa\UserBundle\UserBundle(),
            new EliteFifa\CompetitorBundle\CompetitorBundle(),
            new EliteFifa\StandingBundle\StandingBundle(),
            new EliteFifa\OfficeBundle\OfficeBundle(),
            new EliteFifa\CareerBundle\CareerBundle(),
            new EliteFifa\JobBundle\JobBundle(),
            new EliteFifa\MatchBundle\MatchBundle()
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
