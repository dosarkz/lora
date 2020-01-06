<?php
namespace Dosarkz\Lora\Generators;

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
                    new Folder('Config', 'Config',[],[
                        new File('module.stub', lcfirst($this->name).'.php',
                            ['module_name' => $this->name])
                    ]),
                    new Folder('Console', ''),
                    new Folder('Database', '', [
                        new Folder('factories', ''),
                        new Folder('Migrations', ''),
                        new Folder('Seeders', 'Database/Seeders', [], [
                            new File('ModuleSeeder.stub','ModuleSeeder.php', [
                                'module_name'   =>  $this->name,
                                'module_url'    => lcfirst($this->name)
                            ])
                        ]),
                    ]),
                    new Folder('Http', '', [
                        new Folder('Controllers', 'Http/Controllers', [], [
                            new File('RoleController.stub', 'RoleController.phpphp',
                                [
                                    'module_name'       => ucfirst($this->name),
                                    'lc_module_name'    =>  lcfirst($this->name)
                                ]),
                            new File('FrontendController.stub', 'FrontendController.php',
                                [
                                    'module_name'       => ucfirst($this->name),
                                    'lc_module_name'    =>  lcfirst($this->name)
                                ])
                        ]),
                        new Folder('Middleware', ''),
                        new Folder('Requests', '')
                    ]),
                    new Folder('Models', ''),
                    new Folder('Providers', 'Providers', [] ,[
                        new File('ServiceProvider.stub',ucfirst($this->name).'ServiceProvider.php',
                            [
                                'module_name'       => ucfirst($this->name),
                                'lc_module_name'    =>  lcfirst($this->name)
                            ])
                    ]),
                    new Folder('Resources', '', [
                        new Folder('assets'),
                        new Folder('lang', '', [
                            new Folder('ru'),
                            new Folder('en')
                        ]),
                        new Folder('views', '', [
                            new Folder('frontend', 'Resources/views/frontend', [], [
                                new File('index.blade.stub', 'index.blade.php', [
                                    'module_name'       => ucfirst($this->name),
                                ]),
                            ]),
                            new Folder('backend', 'Resources/views/backend', [], [
                                new File('create.blade.stub', 'create.blade.php', [
                                    'module_name'       => ucfirst($this->name),
                                ]),
                                new File('edit.blade.stub', 'edit.blade.php',[]),
                                new File('form.blade.stub', 'form.blade.php',[]),
                                new File('index.blade.stub', 'index.blade.php', [
                                    'module_name'       => ucfirst($this->name),
                                ]),

                            ])
                        ])
                    ]),
                    new Folder('routes', 'routes',[],[
                        new File('web.stub', 'web.php', [
                            'module_name'       => ucfirst($this->name),
                            'lc_module_name'    =>  lcfirst($this->name)
                        ])
                    ]),
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

            if($folder->files)
            {
                $this->generateFiles($folder->path, $folder);
            }

            if ($folder->subs) {
                $this->loopSubs($folder->subs, $folder->path . $folder->dir);
            }
        }
    }

    /**
     * @param $path
     * @param $folder
     */
    public function generateFiles($path, $folder)
    {
        foreach ($folder->files as $file) {
            $this->filesystem->put($path."/".$file->replacement_file_name,
                $this->generateReplacementContent($folder, $file));
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
            $this->generateGitKeep($path . '/' . $sub->dir);

            if($sub->files)
            {
                $this->generateFiles($path .'/'. $sub->dir, $sub);
            }

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

    /**
     * @param $folder
     * @param $file
     * @return string
     */
    private function generateReplacementContent($folder, $file)
    {
        $this->command->info('generate file '. $file->stub_name);
        return (new Stub(
            $folder->path .'/'. $file->stub_name,
            $file->replacement_params
        )
        )->render();
    }

}

