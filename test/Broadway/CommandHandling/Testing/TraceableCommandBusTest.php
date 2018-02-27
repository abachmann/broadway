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

namespace Broadway\CommandHandling\Testing;

use PHPUnit\Framework\TestCase;

class TraceableCommandBusTest extends TestCase
{
    /**
     * @var TraceableCommandBus
     */
    private $commandBus;

    protected function setUp()
    {
        $this->commandBus = new TraceableCommandBus();
    }

    /**
     * @test
     */
    public function it_traces_commands_if_recording_is_enabled()
    {
        $this->commandBus->record();

        $command = new ExampleCommand();
        $this->commandBus->dispatch($command);

        $this->assertCount(1, $this->commandBus->getRecordedCommands());
        $this->assertSame($command, $this->commandBus->getRecordedCommands()[0]);
    }
}

class ExampleCommand
{

}
