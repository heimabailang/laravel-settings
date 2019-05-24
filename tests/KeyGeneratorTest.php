<?php

use Mockery as m;

class KeyGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGenerateCallsSerializer()
    {
        $context = new \Hongyukeji\LaravelSettings\Context();

        $serializer = $this->getContextSerializerMock();
        $serializer->shouldReceive('serialize')->with($context)->andReturn('serialized');

        $generator = new \Hongyukeji\LaravelSettings\KeyGenerators\KeyGenerator($serializer);

        $this->assertEquals(md5('keyserialized'), $generator->generate('key', $context));
    }

    protected function getContextSerializerMock()
    {
        return m::mock('Hongyukeji\LaravelSettings\Contracts\ContextSerializer');
    }
}
