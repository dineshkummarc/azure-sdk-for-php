<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\ServiceRuntime\Internal
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
namespace Tests\Unit\WindowsAzure\ServiceRuntime\Internal;
use Tests\Framework\TestResources;
use WindowsAzure\Common\Internal\Utilities;
use WindowsAzure\ServiceRuntime\Internal\RoleEnvironmentTopologyChange;

/**
 * Unit tests for class RoleEnvironmentTopologyChange.
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\ServiceRuntime\Internal
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class RoleEnvironmentTopologyChangeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers WindowsAzure\ServiceRuntime\Internal\RoleEnvironmentTopologyChange::__construct
     * @covers WindowsAzure\ServiceRuntime\Internal\RoleEnvironmentTopologyChange::getRoleName
     */
    public function testGetRoleName()
    {
        $roleName = 'role';
        
        // Setup
        $roleEnvironmentTopologyChange = new RoleEnvironmentTopologyChange($roleName);
        
        // Test
        $this->assertEquals($roleName, $roleEnvironmentTopologyChange->getRoleName());
    }
}

?>