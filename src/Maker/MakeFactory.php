<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\MakerBundle\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @author Tristan FLeury <viduc@mail.fr>
 */
final class MakeFactory extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:factory';
    }

    public static function getCommandDescription(): string
    {
        return 'Create a new class to manufacture a model';
    }

    /**
     * @param Command            $command
     * @param InputConfiguration $inputConf
     * @return void
     */
    public function configureCommand(Command $command, InputConfiguration $inputConf): void
    {
        $command
            ->addArgument(
                name: 'factory-class',
                mode: InputArgument::OPTIONAL,
                description: 'The class name of the factory to create (e.g. <fg=yellow>AppFactory</>)'
            )
            ->setHelp(help: $this->getHelpFileContents(helpFileName: 'MakeFactory.txt'))
        ;
    }

    /**
     * @throws \Exception
     */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $factoryClassNameDetails = $generator->createClassNameDetails(
            name: $input->getArgument(name: 'factory-class'),
            namespacePrefix: 'Factory\\'
        );

        $generator->generateClass(
            className: $factoryClassNameDetails->getFullName(),
            templateName: 'doctrine/Fixtures.tpl.php'
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text(['Next: Open your new factory class and start customizing it.']);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}
