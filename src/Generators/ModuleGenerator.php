<?php
namespace Dosarkz\LaravelAdmin\Generators;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ModuleGenerator
{
    /**
     * @var
     */
    private $name;
    /**
     * @var array
     */
    private $folders;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var
     */
    private $command;

    /**
     * ModuleGenerator constructor.
     * @param $name
     * @param Filesystem|null $filesystem
     * @param Command|null $command
     */
    public function __construct($name, Filesystem $filesystem = null, Command $command = null)
    {
        $this->name = $name;
        $this->filesystem = $filesystem;
        $this->command = $command;
        $this->folders = $this->getListFolders();
    }

    /**
     * Generate the module
     */
    public function generate()
    {
        $this->generateFolders();

    }

    /**
     * @return array
     */
    private function getListFolders(): array
    {
        return [
            new Folder('Modules', app_path('/'), [
                new Folder($this->name, '', [
                    new Folder('Config', ''),
                    new Folder('Console', ''),
                    new Folder('Database', '', [
                        new Folder('factories', ''),
                        new Folder('Migrations', ''),
                        new Folder('Seeders', ''),
                    ]),
                    new Folder('Http', '', [
                        new Folder('Controllers', ''),
                        new Folder('Middleware', ''),
                        new Folder('Requests', '')
                    ]),
                    new Folder('Models', ''),
                    new Folder('Providers', ''),
                    new Folder('Resources', '', [
                        new Folder('assets'),
                        new Folder('lang', '', [
                            new Folder('ru'),
                            new Folder('en')
                        ]),
                        new Folder('views', '', [
                            new Folder('frontend', ''),
                            new Folder('backend', '')
                        ])
                    ]),
                    new Folder('routes'),
                    new Folder('Tests')
                ])
            ])
        ];
    }

    /**
     * function generate folders from module
     */
    private function generateFolders()
    {
        foreach ($this->folders as $folder) {
            $this->makeDirectory($folder->path, $folder);

            if ($folder->subs) {
                $this->loopSubs($folder->subs, $folder->path . $folder->dir);
            }
        }
    }

    /**
     * function  a loop generate sub folders
     * @param $subs
     * @param $path
     */
    private function loopSubs($subs, $path)
    {
        foreach ($subs as $sub) {
            $this->makeDirectory($path, $sub);

            if ($sub->subs) {
                $this->loopSubs($sub->subs, $path . '/' . $sub->dir);
            }
        }
    }

    /**
     * @param $path
     * @param $folder
     */
    private function makeDirectory($path, $folder)
    {
        if (!$this->filesystem->exists($path . '/' . $folder->dir)) {
            $this->filesystem->makeDirectory($path . '/' . $folder->dir);
            $this->command->info('created folder ' . $path .'/' . $folder->dir);
        }
    }

    /**
     * Generate git keep to the specified path.
     *
     * @param string $path
     */
    private function generateGitKeep($path)
    {
        $this->filesystem->put($path . '/.gitkeep', '');
    }

}

