<?php

/*
 * This file is part of the broadway/broadway package.
 *
 * (c) Qandidate.com <opensource@qandidate.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Broadway\EventDispatcher\Testing;

use PHPUnit\Framework\TestCase;

class TraceableEventDispatcherTest extends TestCase
{
    /**
     * @var TraceableEventDispatcher
     */
    private $dispatcher;

    protected function setUp()
    {
        $this->dispatcher = new TraceableEventDispatcher();
    }

    /**
     * @test
     */
    public function it_makes_events_traceable()
    {
        $expectedResult = [
            'event' => 'event_name',
            'arguments' => [
                'key' => 'value'
            ]
        ];

        $this->dispatcher->dispatch($expectedResult['event'], $expectedResult['arguments']);

        $dispatchedEvents = $this->dispatcher->getDispatchedEvents();

        $this->assertCount(1, $dispatchedEvents);
        $this->assertEquals($expectedResult, $dispatchedEvents[0]);
    }
}
