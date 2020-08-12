<?php

use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{

    function testMain1()
    {
        $cache = new Cache(2);

        $cache->set('key1', 1);
        $cache->set('key2', 2);
        $this->assertEquals(1, $cache->get('key1'));
        $cache->set('key3', 3);
        $this->assertEquals(null, $cache->get('key2'));
        $cache->set('key4', 4);
        $this->assertEquals(null, $cache->get('key2'));
        $this->assertEquals(null, $cache->get('key1'));
        $this->assertEquals(3, $cache->get('key3'));
        $this->assertEquals(4, $cache->get('key4'));
    }

    function testMain2()
    {
        $cache = new Cache(2);

        $cache->set('key1', 1);
        $cache->set('key2', 2);
        $cache->set('key2', 20);
        $this->assertEquals(1, $cache->get('key1'));
        $this->assertEquals(20, $cache->get('key2'));
        $this->assertEquals(null, $cache->get('key3'));
        $cache->set('key3', 3);
        $this->assertEquals(null, $cache->get('key1'));
        $this->assertEquals(20, $cache->get('key2'));
        $this->assertEquals(3, $cache->get('key3'));
    }

    function testMain3()
    {
        $cache = new Cache(3);

        $cache->set('key1', 1);
        $cache->set('key2', 2);
        $cache->set('key2', 20);
        $cache->set('key3', 3);
        $this->assertEquals(1, $cache->get('key1'));
        $this->assertEquals(20, $cache->get('key2'));
        $this->assertEquals(3, $cache->get('key3'));

    }

    function testMain4()
    {
        $cache = new Cache(5);

        $cache->set('key1', 1);
        $cache->set('key2', 2);
        $cache->set('key3', 3);
        $cache->set('key4', 4);
        $cache->set('key5', 5);
        $cache->set('key6', 6);
        $cache->set('key7', 7);
        $cache->set('key8', 8);
        $this->assertEquals(null, $cache->get('key1'));
        $this->assertEquals(null, $cache->get('key2'));
        $this->assertEquals(null, $cache->get('key3'));
        $this->assertEquals(4, $cache->get('key4'));
        $this->assertEquals(5, $cache->get('key5'));
        $this->assertEquals(6, $cache->get('key6'));
        $this->assertEquals(7, $cache->get('key7'));
        $this->assertEquals(8, $cache->get('key8'));
    }

    function testMain5()
    {
        $cache = new Cache(5);

        $cache->set('key1', 1);
        $cache->set('key2', 2);
        $cache->set('key3', 3);
        $cache->set('key4', 4);
        $cache->set('key5', 5);
        $this->assertEquals(5, $cache->get('key5'));
        $this->assertEquals(4, $cache->get('key4'));
        $this->assertEquals(3, $cache->get('key3'));
        $this->assertEquals(2, $cache->get('key2'));
        $this->assertEquals(1, $cache->get('key1'));
        $cache->set('key6', 6);
        $cache->set('key7', 7);
        $cache->set('key8', 8);
        $this->assertEquals(1, $cache->get('key1'));
        $this->assertEquals(2, $cache->get('key2'));
        $this->assertEquals(null, $cache->get('key3'));
        $this->assertEquals(null, $cache->get('key4'));
        $this->assertEquals(null, $cache->get('key5'));
        $this->assertEquals(6, $cache->get('key6'));
        $this->assertEquals(7, $cache->get('key7'));
        $this->assertEquals(8, $cache->get('key8'));
    }

}
