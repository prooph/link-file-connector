<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 03.01.15 - 20:33
 */

namespace Prooph\Link\FileConnector\Service\FileTypeAdapter;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FileTypeAdapterManagerFactory
 *
 * @package FileConnector\Service
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class FileTypeAdapterManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \InvalidArgumentException
     * @return FileTypeAdapterManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        if (! array_key_exists('prooph.link.fileconnector', $config)) throw new \InvalidArgumentException('Missing prooph.link.fileconnector root config key');
        if (! is_array($config['prooph.link.fileconnector'])) throw new \InvalidArgumentException("Config for prooph.link.fileconnector must be an array");
        if (! array_key_exists('file_types', $config['prooph.link.fileconnector'])) throw new \InvalidArgumentException('Missing file_types in prooph.link.fileconnector config');

        $fileTypeAdapters = new FileTypeAdapterManager(new Config($config['prooph.link.fileconnector']['file_types']));

        $fileTypeAdapters->setServiceLocator($serviceLocator);

        return $fileTypeAdapters;
    }
}
 