<?php

namespace App\Bundles\ApiDtoGeneratorBundle\Command;


use App\Bundles\ApiDtoGeneratorBundle\Command\Helper\QuestionHelper;
use App\Bundles\ApiDtoGeneratorBundle\Generator\Generator;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Base class for generator commands.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class GeneratorCommand extends ContainerAwareCommand
{
    /**
     * @var Generator
     */
    private $generator;

    // only useful for unit tests
    public function setGenerator(Generator $generator)
    {
        $this->generator = $generator;
    }

    abstract protected function createGenerator();

    protected function getGenerator(BundleInterface $bundle = null)
    {
        if (null === $this->generator) {
            $this->generator = $this->createGenerator();
            $this->generator->setSkeletonDirs($this->getSkeletonDirs($bundle));
        }

        return $this->generator;
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get('kernel')->getRootdir().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }

    protected function getQuestionHelper()
    {
        $question = $this->getHelperSet()->get('question');
        if (!$question || get_class($question) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\QuestionHelper') {
            $this->getHelperSet()->set($question = new QuestionHelper());
        }

        return $question;
    }

    /**
     * Tries to make a path relative to the project, which prints nicer.
     *
     * @param string $absolutePath
     *
     * @return string
     */
    protected function makePathRelative($absolutePath)
    {
        $projectRootDir = dirname($this->getContainer()->getParameter('kernel.root_dir'));

        return str_replace($projectRootDir.'/', '', realpath($absolutePath) ?: $absolutePath);
    }
}
