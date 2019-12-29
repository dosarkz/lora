<?php
namespace Dosarkz\Lora\Contracts;

interface RepositoryInterface
{
    /**
     * Get all modules.
     *
     * @return mixed
     */
    public function all();
    /**
     * Scan & get all available modules.
     *
     * @return array
     */
    public function scan();

    /**
     * Find a specific module.
     *
     * @param $name
     *
     * @return mixed
     */
    public function find($name);

    /**
     * Find a specific module. If there return that, otherwise throw exception.
     *
     * @param $name
     *
     * @return mixed
     */
    public function findOrFail($name);
}
