<?php



namespace SecucardConnect\Product\General;

use SecucardConnect\BaseClientTest;


/**
 * @covers secucard\models\General\Skeletons
 */
class SkeletonsTest extends BaseClientTest
{
    /**
     * @test
     */
    public function testGetList()
    {
        $list = $this->client->general->skeletons->getList(array());

        $this->assertFalse(empty($list));
    }

    /**
     * @test
     */
    public function testGetItem()
    {
        $list = $this->client->general->skeletons->getList(array('count'=>1));

        $this->assertFalse(empty($list));
        $sample_item_id = $list[0]->id;
        $this->assertFalse(empty($sample_item_id), 'Cannot get one item, because none is available');

        if ($sample_item_id) {
            $item = $this->client->general->skeletons->get($sample_item_id);

            $this->assertFalse(empty($item));
        }
    }
}