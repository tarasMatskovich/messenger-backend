<?php

namespace App\Domains\Service\StorageService;

/**
 * Interface StorageServiceInterface
 * @package App\Domains\Service\StorageService
 */
interface StorageServiceInterface
{

    /**
     * @param string $fileEncoded
     * @param string $name
     * @return void
     */
    public function uploadFileFromBase64(string $fileEncoded, string $name);

    /**
     * @return string
     */
    public function makeUniqueFileName();

    /**
     * @param string $name
     * @return string
     */
    public function getBase64FromFile(string $name): string;

}