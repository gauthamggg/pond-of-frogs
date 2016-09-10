<?php

class MyRoutesTest extends TestCase {

    public function testRouteIndex()
    {
        $this->call('GET', route('index'));
        $this->assertResponseOk();
    }

    public function testRouteFrogIndex()
    {
        $this->call('GET', route('frog.index'));
        $this->assertResponseOk();
    }

    public function testRouteFrogCreate()
    {
        $this->call('GET', route('frog.create'));
        $this->assertResponseOk();
    }

    public function testRouteFrogMate()
    {
        $this->call('GET', route('frog.mate'));
        $this->assertResponseOk();
    }

    public function testRouteFrogNotFoundRedirect()
    {
        $r = $this->call('GET', '/frog/-9000');
        $this->assertRedirectedTo(route('frog.index'));
    }

}
