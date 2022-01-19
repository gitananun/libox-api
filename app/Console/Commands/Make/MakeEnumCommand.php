<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;

class MakeEnumCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enumeration';

    /**
     * The type of enum being generated.
     *
     * @var string
     */
    protected $type = 'enum';

    /**
     * Get the default namespace for the class.
     *
     * @param  string   $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Enums';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return resource_path('stubs/EnumStub.php');
    }
}