<?php

namespace Pantheon\TerminusAutopilot\Tests\Functional;

use Pantheon\Terminus\Tests\Functional\TerminusTestBase;
use Pantheon\TerminusAutopilot\Tests\Functional\Mocks\MockPayloadAwareTrait;

/**
 * Class DestinationCommandTest.
 *
 * @package \Pantheon\TerminusAutopilot\Tests\Functional
 */
final class DestinationCommandTest extends TerminusTestBase
{
    use MockPayloadAwareTrait;

    /**
     * @test
     *
     * @covers \Pantheon\TerminusAutopilot\Commands\DestinationCommand::destination()
     *
     * @see \Pantheon\TerminusAutopilot\AutopilotApi\Client::getDestination()
     * @see \Pantheon\TerminusAutopilot\Tests\Functional\Mocks\RequestMock::request()
     */
    public function testDestinationSetCommand()
    {
        $this->assertCommandExists('site:autopilot:destination');

        $this->setMockPayload([
            'data' => ['deploymentDestination' => 'dev'],
            'status_code' => 200,
        ]);

        // Get "destination" setting value.
        $output = $this->terminus(sprintf('site:autopilot:destination %s', $this->getSiteName()));
        $this->assertEquals('dev', $output);
    }
}
