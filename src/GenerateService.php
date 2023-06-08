<?php

namespace Bacoder\Servicesgenerator;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateService extends Command
{
    protected $signature = 'generate:service {model}';
    protected $description = 'Generate a service class based on a model';

    public function handle()
    {
        $model = $this->argument('model');
        $modelName = $this->generateModelName($model);
        $className = $this->generateClassName($model);
        $content = $this->generateContent($modelName, $className);
        $filePath = app_path('Services/' . $className . 'Service.php');

        File::ensureDirectoryExists(app_path('Services'));
        File::put($filePath, $content);

        $this->info("The service class '{$className}Service' has been generated successfully.");
    }

    private function generateModelName($model)
    {
        return ucfirst($model);
    }

    private function generateClassName($model)
    {
        return ucfirst($model);
    }

    private function generateContent($modelName, $className)
    {
        $stubPath = base_path('vendor/bacoder/servicesgenerator/stubs/services/service.stub');
        $stubContent = File::get($stubPath);
        $replacements = [
            '{{ModelName}}' => $modelName,
            '{{ClassName}}' => $className,
            '{{modelName}}' => lcfirst($modelName),
        ];
        $content = str_replace(array_keys($replacements), array_values($replacements), $stubContent);

        return $content;
    }

    public static function registerCommand()
    {
        $kernelFile = base_path('app/Console/Kernel.php');
        $content = file_get_contents($kernelFile);

        $commandClass = 'GenerateService::class';
        $useStatement = 'use Bacoder\Servicesgenerator\GenerateService;';
        
        if (strpos($content, $commandClass) === false) {
            $content = str_replace(
                'protected $commands = [',
                "protected \$commands = [\n        {$commandClass},",
                $content
            );
        }

        if (strpos($content, $useStatement) === false) {
            $useStatement = "use Bacoder\Servicesgenerator\GenerateService;\n";
            $content = preg_replace(
                '/(use [^;]+;)/',
                "$1\n" . $useStatement,
                $content,
                1
            );
        }

        file_put_contents($kernelFile, $content);
    }
}

GenerateService::registerCommand();

