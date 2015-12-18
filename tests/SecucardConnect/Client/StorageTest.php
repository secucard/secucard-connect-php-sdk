<?php


namespace SecucardConnect\Client;


use GuzzleHttp\Psr7\Stream;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    // the test storage dir
    protected $dir = 'test';

    /**
     * @test
     */
    public function testFileStorage()
    {
        $file = $this->dir . DIRECTORY_SEPARATOR . 'file';
        $key = 'key';
        $cachefile = $this->dir . DIRECTORY_SEPARATOR . $key;

        $s = new FileStorage($this->dir);
        $this->assertTrue($s->set($key, 'value'));

        $s = new FileStorage($this->dir);
        $this->assertTrue($s->get($key) === 'value');
        $this->assertNull($s->get('954815492217'));

        // replace with file
        $f = fopen($file, 'w');
        fwrite($f, '12345');
        fclose($f);
        $this->assertTrue($s->set($key, new Stream(fopen($file, 'r'))));

        $s = new FileStorage($this->dir);
        $this->assertTrue(is_resource($s->get($key)));

        // replace again
        $this->assertTrue($s->set($key, '938443'));
        $this->assertTrue($s->get($key) === '938443');
        $this->assertTrue(count(glob($cachefile)) === 0);

        // delete
        $this->assertTrue($s->delete($key));
        $this->assertNull($s->get($key));
        $this->assertTrue($s->set($key, new Stream(fopen($file, 'r'))));
        $this->assertTrue($s->delete($key));
        $this->assertNull($s->get($key));
        $this->assertTrue(count(glob($cachefile)) === 0);

        $this->assertTrue($s->deleteAll());
    }

    protected function tearDown()
    {
        array_map('unlink', glob($this->dir . DIRECTORY_SEPARATOR . '*'));
        rmdir($this->dir);
    }


}