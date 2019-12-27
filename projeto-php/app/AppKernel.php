<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),

            // Friends of Symfony
            new FOS\UserBundle\FOSUserBundle(),

            // KNP Labs
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),

            // Sonata Project
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\IntlBundle\SonataIntlBundle(),

            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Application\Sonata\AdminBundle\ApplicationSonataAdminBundle(),

            new JMS\SerializerBundle\JMSSerializerBundle(),

            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),

            new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
			new Liip\ImagineBundle\LiipImagineBundle(),
            new Slik\DompdfBundle\SlikDompdfBundle(),
            new Shtumi\UsefulBundle\ShtumiUsefulBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
//            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
//            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
//            new Sonata\FormatterBundle\SonataFormatterBundle(),
//			new RMS\PushNotificationsBundle\RMSPushNotificationsBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
