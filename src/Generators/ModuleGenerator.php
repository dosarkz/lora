<?php
namespace Dosarkz\LaravelAdmin\Generators;

use Illuminate\Filesystem\Filesystem;

class ModuleGenerator
{
    private $name;

    private $basePath = 'app/Modules';

    private $configFolder;

    private $consoleFolder;

    private $folders;

    public function __construct($name)
    {
        $this->name = $name;
        $this->fileSystem =  new Filesystem();
        $this->folders = [
                'dir' => 'Modules',
                'includeFolders'  => [
                    [
                        'dir' => 'Config',
                        'includeFolders'  => [],
                        'files' => [$this->name.'.php']
                    ],

                    [
                        'dir' => 'Http',
                        'includeFolders'  => [
                            [
                                'dir' => 'Controllers',
                                'files' =>  ['BackendController.php', 'FrontendController.php'],
                                'includeFolders' => [],
                            ]
                        ],
                        'files' => []
                    ],

                ],
                'files' => []


        ];
    }

    public function generate()
    {
        $this->generateFolders();

    }

    private function generateFolders()
    {
        $folders = [$this->folders['dir']];

        if(count($this->folders['includeFolders']) > 0)
        {
            foreach ($this->folders['includeFolders'] as $includeFolder) {
                $folders[] = $includeFolder['dir'];
            }
        }

        foreach ($folders as $folder) {
            if(!$this->fileSystem->exists(app_path($folder)))
            {
                $this->makeFolder(app_path($folder));
            }
        }

    }

    private function makeFolder($path, $chmod = 775, $recursive = true)
    {
        $this->fileSystem->makeDirectory($path, $chmod, $recursive);
    }

}