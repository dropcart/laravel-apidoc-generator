<?php

namespace Mpociot\ApiDoc\Commands;

use Illuminate\Console\Command;
use Mpociot\ApiDoc\Tools\DocumentationConfig;
use Mpociot\ApiDoc\Writing\Writer;

class RebuildDocumentation extends Command
{
    protected $signature = 'apidoc:rebuild';

    protected $description = 'Rebuild your API documentation from your markdown file.';

    public function handle()
    {
        $sourceOutputPath = 'resources/docs/source';
        if (! is_dir($sourceOutputPath)) {
            $this->error('There is no existing documentation available at '.$sourceOutputPath.'.');

            return false;
        }

        $this->info('Rebuilding API documentation from '.$sourceOutputPath.'/index.md');

        $config = new DocumentationConfig(config('apidoc'));

        if (
            $config->get('split_docs') === true
            &&
            count($config->get('api_groups')) > 0
        ) {
            // Rebuild docs per API group
            foreach ($config->get('api_groups') as $apiGroupConfig) {
                $config->set('subdirectory', $apiGroupConfig['subdirectory']);
                $config->set('routes', $apiGroupConfig['routes']);
                // Rebuild docs for group
                $this->writeDocs($config);
            }
        } else {
            // Rebuild docs the general way
            $this->writeDocs($config);
        }
    }

    private function writeDocs(DocumentationConfig $config)
    {
        $writer = new Writer($this, $config);
        $writer->writeHtmlDocs();
    }
}
