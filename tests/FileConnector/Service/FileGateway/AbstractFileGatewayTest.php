<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 05.01.15 - 00:12
 */

namespace ProophTest\Link\FileConnector\Service\FileGateway;

use ProophTest\Link\FileConnector\Bootstrap;
use ProophTest\Link\FileConnector\TestCase;

/**
 * Class AbstractFileGatewayTest
 *
 * @package FileConnectorTest\Service\FileGateway
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class AbstractFileGatewayTest extends TestCase
{
    /**
     * @test
     */
    public function it_provides_a_file_gateway_when_a_service_alias_matches_the_pattern()
    {
        $fileGateway = Bootstrap::getServiceManager()->get('filegateway:::csv-file-reader');

        $this->assertInstanceOf('Prooph\Link\FileConnector\Service\FileGateway', $fileGateway);
    }
}
 