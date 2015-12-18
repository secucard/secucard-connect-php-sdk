<?php


namespace SecucardConnect\Product\Common;


use GuzzleHttp\Client;
use SecucardConnect\Client\FileStorage;
use SecucardConnect\Client\StorageTest;
use SecucardConnect\Product\Common\Model\MediaResource;

class MediaResourceTest extends StorageTest
{
    /**
     * @test
     */
    public function testDownload()
    {
        $mr = new MediaResource();
        $mr->setHttpClient(new Client());
        $mr->setStore(new FileStorage($this->dir));
        $mr->setUrl('https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Region_M%C3%BCnchen_-_Satellitenbild.jpg/170px-Region_M%C3%BCnchen_-_Satellitenbild.jpg');
        $this->assertTrue(is_resource($mr->getContents()));
        $this->assertTrue(count(glob($this->dir . DIRECTORY_SEPARATOR . '*')) === 1);
        $mr->clear();
        $this->assertTrue(count(glob($this->dir . DIRECTORY_SEPARATOR . '*')) === 0);
    }

}