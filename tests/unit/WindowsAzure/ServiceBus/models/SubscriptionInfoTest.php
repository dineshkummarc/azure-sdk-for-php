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
 * @package   Tests\Unit\WindowsAzure\Services\Queue\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */

namespace Tests\Unit\WindowsAzure\ServiceBus\Models;
use WindowsAzure\ServiceBus\Models\SubscriptionInfo;

/**
 * Unit tests for class WrapAccessTokenResult
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\Services\Queue\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */
class SubscriptionInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers WindowsAzure\ServiceBus\Models\SubscriptionInfo::__construct
     */
    public function testSubscriptionInfoConstructor()
    {
        // Setup
        $expected = 'testSubscriptionInfoName';
        
        // Test
        $SubscriptionInfo = new SubscriptionInfo($expected);
        $actual = $SubscriptionInfo->getTitle();
        
        // Assert
        $this->assertNotNull($SubscriptionInfo);
        $this->assertEquals(
            $expected,
            $actual
        );
         
    }

    /** 
     * @covers WindowsAzure\ServiceBus\Models\SubscriptionInfo::getSubscriptionDescription
     * @covers WindowsAzure\ServiceBus\Models\SubscriptionInfo::setSubscriptionDescription
     */
    public function testGetSetSubscriptionDescription() {
        // Setup
        $expected = 'testSubscriptionDescription';
        $SubscriptionInfo = new SubscriptionInfo();

        // Test
        $SubscriptionInfo->setSubscriptionDescription($expected);
        $actual = $SubscriptionInfo->getSubscriptionDescription();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );

    }

}

?>