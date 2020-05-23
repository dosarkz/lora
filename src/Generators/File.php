<?php
namespace Dosarkz\Lora\Generators;

class File
{
    public $stub_name;
    public $replacement_file_name;
    public $replacement_params;

    public function __construct($stub_name, $replacement_file_name, $replacement_params)
    {
        $this->stub_name = $stub_name;
        $this->replacement_file_name = $replacement_file_name;
        $this->replacement_params = $replacement_params;
    }
}
