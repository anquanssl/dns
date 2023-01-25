<?php

namespace Unit\Records\Types\DnsSec;

use BlueLibraries\Dns\Records\Types\DnsSec\DNSKey;
use BlueLibraries\Dns\Test\Unit\Records\RecordTestClass;

/**
 * @property DNSKey $subject
 */
class DNSKeyTest extends RecordTestClass
{
    public function setUp(): void
    {
        $this->subject = new DNSKey([]);
        parent::setUp();
    }

    public function testGetFlags()
    {
        $this->assertNull($this->subject->getFlags());
    }

    public function testGetValueSetFlags()
    {
        $value = 257;
        $this->subject->setData(['flags' => $value]);
        $this->assertSame($value, $this->subject->getFlags());
    }

    public function testGetProtocol()
    {
        $this->assertNull($this->subject->getFlags());
    }

    public function testGetValueSetProtocol()
    {
        $value = 3;
        $this->subject->setData(['protocol' => $value]);
        $this->assertSame($value, $this->subject->getProtocol());
    }

    public function testGetAlgorithm()
    {
        $this->assertNull($this->subject->getAlgorithm());
    }

    public function testGetValueSetAlgorithm()
    {
        $value = 13;
        $this->subject->setData(['algorithm' => $value]);
        $this->assertSame($value, $this->subject->getAlgorithm());
    }

    public function testGetPublicKey()
    {
        $this->assertNull($this->subject->getPublicKey());
    }

    public function testGetValueSetPublicKey()
    {
        $value = 'LofZcndFN2aVd==';
        $this->subject->setData(['public-key' => $value]);
        $this->assertSame($value, $this->subject->getPublicKey());
    }

    public function testToStringDefault()
    {
        $this->assertSame('0 IN DNSKEY', $this->subject->toString());
    }

    public function testToStringComplete()
    {
        $this->subject->setData(
            [
                'host'       => 'test.com',
                'ttl'        => '3600',
                'value'      => 'value',
                'flags'      => 255,
                'protocol'   => 3,
                'algorithm'  => 12,
                'public-key' => 'public-key=='
            ]
        );
        $this->assertSame('test.com 3600 IN DNSKEY 255 3 12 public-key==', $this->subject->toString());
    }

}
