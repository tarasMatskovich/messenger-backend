<?php


namespace App\Domains\Service\StorageService;

/**
 * Class StorageService
 * @package App\Domains\Service\StorageService
 */
class StorageService implements StorageServiceInterface
{

    /**
     * @var string
     */
    private $path;

    /**
     * StorageService constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $fileEncoded
     * @param string $name
     * @return void
     */
    public function uploadFileFromBase64(string $fileEncoded, string $name)
    {
        $ifp = fopen( $this->path . '/' . $name, "wb" );
        $data = explode( ',', $fileEncoded );
        fwrite( $ifp, base64_decode( $data[1]) );
        fclose( $ifp );
    }

    /**
     * @return string
     */
    public function makeUniqueFileName()
    {
        return uniqid() . '.jpg';
    }

    /**
     * @param string $name
     * @return string
     */
    public function getBase64FromFile(string $name): string
    {
        $imageSize = getimagesize($this->path . '/' . $name);
        $imageData = base64_encode(file_get_contents($this->path . '/' . $name));
        return "data:{$imageSize['mime']};base64,{$imageData}' {$imageSize[3]}";
    }
}