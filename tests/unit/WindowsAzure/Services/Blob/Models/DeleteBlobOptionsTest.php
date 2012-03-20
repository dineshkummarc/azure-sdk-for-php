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
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Services\Blob\Models\AccessCondition;
use PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions;

/**
 * Unit tests for class DeleteBlobOptions
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class DeleteBlobOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::setLeaseId
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::getLeaseId
     */
    public function testSetLeaseId()
    {
        // Setup
        $expected = '0x8CAFB82EFF70C46';
        $options = new DeleteBlobOptions();
        $options->setLeaseId($expected);
        
        // Test
        $options->setLeaseId($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getLeaseId());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::getAccessCondition
     */
    public function testGetAccessCondition()
    {
        // Setup
        $expected = AccessCondition::none();
        $result = new DeleteBlobOptions();
        $result->setAccessCondition($expected);
        
        // Test
        $actual = $result->getAccessCondition();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::setAccessCondition
     */
    public function testSetAccessCondition()
    {
        // Setup
        $expected = AccessCondition::none();
        $result = new DeleteBlobOptions();
        
        // Test
        $result->setAccessCondition($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getAccessCondition());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::setSnapshot
     */
    public function testSetSnapshot()
    {
        // Setup
        $blob = new DeleteBlobOptions();
        $expected = TestResources::QUEUE1_NAME;
        
        // Test
        $blob->setSnapshot($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getSnapshot());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::getSnapshot
     */
    public function testGetSnapshot()
    {
        // Setup
        $blob = new DeleteBlobOptions();
        $expected = TestResources::QUEUE_URI;
        $blob->setSnapshot($expected);
        
        // Test
        $actual = $blob->getSnapshot();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::setDeleteSnaphotsOnly
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\DeleteBlobOptions::getDeleteSnaphotsOnly
     */
    public function testSetDeleteSnaphotsOnly()
    {
        // Setup
        $expected = true;
        $options = new DeleteBlobOptions();
        $options->setDeleteSnaphotsOnly($expected);
        
        // Test
        $options->setDeleteSnaphotsOnly($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getDeleteSnaphotsOnly());
    }
}

?>