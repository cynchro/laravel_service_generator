<?php

namespace Bacoder\Servicesgenerator;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateService extends Command
{
    protected $signature = 'generate:service {model}';
    protected $description = 'Generate a service class and controller based on a model';

    public function handle()
    {
        $model = $this->argument('model');
        $modelName = $this->generateModelName($model);
        $className = $this->generateClassName($model);
        $serviceContent = $this->generateServiceContent($modelName, $className);
        $controllerContent = $this->generateControllerContent($modelName, $className);
        $serviceFilePath = app_path('Services/' . $className . 'Service.php');
        $controllerFilePath = app_path('Http/Controllers/' . $className . 'Controller.php');

        File::ensureDirectoryExists(app_path('Services'));
        File::put($serviceFilePath, $serviceContent);

        File::ensureDirectoryExists(app_path('Http/Controllers'));
        File::put($controllerFilePath, $controllerContent);

        $this->info("The service class '{$className}Service' and the controller class '{$className}Controller' have been generated successfully.");
    }

    private function generateModelName($model)
    {
        return ucfirst($model);
    }

    private function generateClassName($model)
    {
        return ucfirst($model);
    }

    private function generateServiceContent($modelName, $className)
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

    private function generateControllerContent($modelName, $className)
    {
        $stubPath = base_path('vendor/bacoder/servicesgenerator/stubs/controllers/controller.stub');
        $stubContent = File::get($stubPath);
        $replacements = [
            '{{ModelName}}' => $modelName,
            '{{ClassName}}' => $className,
            '{{modelName}}' => lcfirst($modelName),
        ];
        $content = str_replace(array_keys($replacements), array_values($replacements), $stubContent);

        return $content;
    }
}
