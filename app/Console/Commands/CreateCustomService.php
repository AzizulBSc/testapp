<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateCustomService extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new custom service';

    public function handle()
    {
        $serviceName = $this->argument('name');

        $serviceClass = <<<EOT
<?php

namespace App\Services;

class {$serviceName}
{
    public function doSomething()
    {
        // service logic goes here
    }
}
EOT;

        file_put_contents(app_path("Services/{$serviceName}.php"), $serviceClass);

        $this->info('Custom service created successfully!');
    }
}
