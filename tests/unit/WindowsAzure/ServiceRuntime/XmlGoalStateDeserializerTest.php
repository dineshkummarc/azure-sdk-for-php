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
 * @package   PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;
use PEAR2\WindowsAzure\ServiceRuntime\GoalState;
use PEAR2\WindowsAzure\ServiceRuntime\XmlGoalStateDeserializer;

require_once 'vfsStream/vfsStream.php';

/**
 * Unit tests for class XmlGoalStateDeserializer
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class XmlGoalStateDeserializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\ServiceRuntime\XmlGoalStateDeserializer::deserialize
     */
    public function testDeserialize()
    {
        // Setup
        $roleEnvironmentPath = 'mypath';
        $currentStateEndpoint = 'endpoint';
        $incarnation = 1;
        $expectedState = 'started';
        
        $xmlGoalStateDeserializer = new XmlGoalStateDeserializer();
        $goalState = $xmlGoalStateDeserializer->deserialize(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<GoalState xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
            'xmlns:xsd="http://www.w3.org/2001/XMLSchema">' .
            '<Incarnation>' .
            $incarnation .   
            '</Incarnation>' .
            '<ExpectedState>' .
            $expectedState .
            '</ExpectedState>' .
            '<RoleEnvironmentPath>' . 
            $roleEnvironmentPath .
            '</RoleEnvironmentPath>' .
            '<CurrentStateEndpoint>' .
            $currentStateEndpoint .
            '</CurrentStateEndpoint>' .
            '<Deadline>9999-12-31T23:59:59.9999999</Deadline>' .
            '</GoalState>'        
        );
        
        // Test
        $this->assertNotEquals(null, $goalState);
        $this->assertEquals($roleEnvironmentPath, $goalState->getEnvironmentPath());
        $this->assertNotEquals(null, $goalState->getDeadline());
        $this->assertEquals($currentStateEndpoint, $goalState->getCurrentStateEndpoint());
        $this->assertEquals($incarnation, $goalState->getIncarnation());
        $this->assertEquals($expectedState, $goalState->getExpectedState());
    }
}

?>