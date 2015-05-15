<?php namespace Kumuwai\LocalStripe\Models;

use Kumuwai\LocalStripe\TestCase;


class StripeChargeTest extends TestCase
{

    public function setUp()
    {
        $this->test = new StripeCharge;
        $this->test->getConnection()->beginTransaction();
    }

    public function tearDown()
    {
        $this->test->getConnection()->rollBack();
    }

    public function testClassExists() {}
    
    public function testHasCard()
    {
        $test = $this->test->find('ch_1');
        $this->assertNotNull($test->card);
    }

    public function testHasBalance()
    {
        $test = $this->test->find('ch_1');
        $this->assertNotNull($test->balance);
    }

    public function testHasRefunds()
    {
        $test = $this->test->find('ch_1');
        $this->assertNotNull($test->refunds);
    }

    public function testHasCustomer()
    {
        $test = $this->test->find('ch_1');
        $this->assertNotNull($test->customer);
    }

    public function testHasMetadata()
    {
        $test = $this->test->find('ch_1');
        $this->assertNotNull($test->metadata);
        $this->assertTrue(count($test->metadata)>0);
    }

    public function testReturnObjectIfWantedDuplicateCreated()
    {
        $c1 = $this->getFakeChargeFromStripe(['id'=>'ch_1']);

        $test = $this->test->createFromStripe($c1);

        $this->assertNotNull($test);
        $this->assertEquals('ch_1', $test->id);
    }

    public function testCanCreateFromStripeObject()
    {
        $c1 = $this->getFakeChargeFromStripe([
            'id'=>'ch_14',
        ]);

        $test = $this->test->createFromStripe($c1);

        $this->assertNotNull($test);
        $this->assertEquals('ch_14', $test->id);
    }

    public function testCanCreateMetadata()
    {
        $c1 = $this->getFakeChargeFromStripe([
            'id'=>'ch_14',
            'metadata'=> $this->getFakeMetadataFromStripe(['foo'=>'bar']),
        ]);

        $test = $this->test->createFromStripe($c1);

        $this->assertNotNull($test->metadata);
        $this->assertEquals('bar', $test->metadata[0]->value);
    }


}

