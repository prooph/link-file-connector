<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 05.01.15 - 13:15
 */

namespace Prooph\Link\FileConnector\Controller;

use Prooph\Link\Dashboard\Controller\AbstractWidgetController;
use Prooph\Link\Dashboard\View\DashboardWidget;

/**
 * Class DashboardWidgetController
 *
 * @package FileConnector\Controller
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class DashboardWidgetController extends AbstractWidgetController
{

    /**
     * @return DashboardWidget
     */
    public function widgetAction()
    {
        if (! $this->systemConfig->isConfigured()) return false;

        $connectors = [];

        foreach ($this->systemConfig->getConnectors() as $connectorId => $connector) {
            if (strpos($connectorId, 'filegateway:::') !== false) $connectors[$connectorId] = $connector;
        }

        return DashboardWidget::initialize(
            'prooph.link.file-connector/dashboard/widget',
            'File Connector',
            4,
            ['processingConfig' => $this->systemConfig, 'fileConnectors' => $connectors]
        );
    }
}
 