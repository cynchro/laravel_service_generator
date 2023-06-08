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
        $content = str_replace(
            ['{{ModelName}}', '{{ClassName}}', '{{modelName}}'],
            [$modelName, $className, lcfirst($modelName)],
            $stubContent
        );

        return $content;
    }
}
