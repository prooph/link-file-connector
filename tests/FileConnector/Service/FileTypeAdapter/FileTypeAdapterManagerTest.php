<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 04.01.15 - 17:02
 */

namespace ProophTest\Link\FileConnector\Service\FileHandler;

use Prooph\Link\FileConnector\Service\FileTypeAdapter\FileTypeAdapterManager;
use ProophTest\Link\FileConnector\Bootstrap;
use ProophTest\Link\FileConnector\TestCase;

/**
 * Class FileTypeAdapterManagerTest
 *
 * @package FileConnectorTest\Service\FileHandler
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class FileTypeAdapterManagerTest extends TestCase
{
    /**
     * @var FileTypeAdapterManager
     */
    private $fileTypeAdapters;

    protected function setUp()
    {
        $this->fileTypeAdapters = Bootstrap::getServiceManager()->get('prooph.link.fileconnector.file_type_adapter_manager');
    }

    /**
     * @test
     */
    public function it_provides_a_league_csv_type_adapter_when_specifying_csv_as_file_type()
    {
        $csvAdapter = $this->fileTypeAdapters->get('csv');

        $this->assertInstanceOf('Prooph\Link\FileConnector\Service\FileTypeAdapter\LeagueCsvTypeAdapter', $csvAdapter);
    }

    /**
     * @test
     */
    public function it_provides_a_json_type_adapter_when_specifying_json_as_file_type()
    {
        $jsonAdapter = $this->fileTypeAdapters->get('json');

        $this->assertInstanceOf('Prooph\Link\FileConnector\Service\FileTypeAdapter\JsonTypeAdapter', $jsonAdapter);
    }
}
 