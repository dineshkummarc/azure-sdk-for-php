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
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Table
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace PEAR2\Tests\Unit\WindowsAzure\Services\Table;
use PEAR2\Tests\Framework\TableRestProxyTestBase;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;
use PEAR2\WindowsAzure\Core\ServiceException;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Resources;
use PEAR2\WindowsAzure\Services\Core\Models\ServiceProperties;
use PEAR2\WindowsAzure\Services\Table\Models\QueryTablesOptions;
use PEAR2\WindowsAzure\Services\Table\Models\Query;
use PEAR2\WindowsAzure\Services\Table\Models\Filters\Filter;
use PEAR2\WindowsAzure\Services\Table\Models\Entity;
use PEAR2\WindowsAzure\Services\Table\Models\EdmType;

/**
 * Unit tests for class TableRestProxy
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Table
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class TableRestProxyTest extends TableRestProxyTestBase
{
    /**
    * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::getServiceProperties
    */
    public function testGetServiceProperties()
    {
        if (WindowsAzureUtilities::isEmulated()) {
            $this->markTestSkipped(self::NOT_SUPPORTED);
        }
        
        // Test
        $result = $this->wrapper->getServiceProperties();
        
        // Assert
        $this->assertEquals($this->defaultProperties->toArray(), $result->getValue()->toArray());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::setServiceProperties
    */
    public function testSetServiceProperties()
    {
        if (WindowsAzureUtilities::isEmulated()) {
            $this->markTestSkipped(self::NOT_SUPPORTED);
        }
        
        // Setup
        $expected = ServiceProperties::create(TestResources::setServicePropertiesSample());
        
        // Test
        $this->setServiceProperties($expected);
        $actual = $this->wrapper->getServiceProperties();
        
        // Assert
        $this->assertEquals($expected->toXml(), $actual->getValue()->toXml());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::createTable
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_fillTemplate
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::getTable
     */
    public function testCreateTable()
    {
        // Setup
        $name = 'createtable';
        
        // Test
        $this->createTable($name);
        
        // Assert
        $result = $this->wrapper->queryTables();
        $this->assertCount(1, $result->getTables());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::deleteTable
     */
    public function testDeleteTable()
    {
        // Setup
        $name = 'deletetable';
        $this->wrapper->createTable($name);
        
        // Test
        $this->wrapper->deleteTable($name);
        
        // Assert
        $result = $this->wrapper->queryTables();
        $this->assertCount(0, $result->getTables());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryTables
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpression
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpressionRec
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_addOptionalQuery
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValues
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValue
     * @covers PEAR2\WindowsAzure\Services\Table\Models\QueryTablesResult::create
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseTableEntries
     */
    public function testQueryTablesSimple()
    {
        // Setup
        $name1 = 'querytablessimple1';
        $name2 = 'querytablessimple2';
        $this->createTable($name1);
        $this->createTable($name2);
        
        // Test
        $result = $this->wrapper->queryTables();
        
        // Assert
        $tables = $result->getTables();
        $this->assertCount(2, $tables);
        $this->assertEquals($name1, $tables[0]);
        $this->assertEquals($name2, $tables[1]);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryTables
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpression
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpressionRec
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_addOptionalQuery
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValues
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValue
     * @covers PEAR2\WindowsAzure\Services\Table\Models\QueryTablesResult::create
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseTableEntries
     */
    public function testQueryTablesOneTable()
    {
        // Setup
        $name1 = 'querytablesonetable';
        $this->createTable($name1);
        
        // Test
        $result = $this->wrapper->queryTables();
        
        // Assert
        $tables = $result->getTables();
        $this->assertCount(1, $tables);
        $this->assertEquals($name1, $tables[0]);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryTables
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpression
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpressionRec
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_addOptionalQuery
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValues
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValue
     * @covers PEAR2\WindowsAzure\Services\Table\Models\QueryTablesResult::create
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseTableEntries
     */
    public function testQueryTablesEmpty()
    {
        // Test
        $result = $this->wrapper->queryTables();
        
        // Assert
        $tables = $result->getTables();
        $this->assertCount(0, $tables);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryTables
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpression
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_buildFilterExpressionRec
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_addOptionalQuery
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValues
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::_encodeODataUriValue
     * @covers PEAR2\WindowsAzure\Services\Table\Models\QueryTablesResult::create
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseTableEntries
     */
    public function testQueryTablesWithPrefix()
    {
        // Setup
        $name1 = 'wquerytableswithprefix1';
        $name2 = 'querytableswithprefix2';
        $name3 = 'querytableswithprefix3';
        $options = new QueryTablesOptions();
        $options->setPrefix('q');
        $this->createTable($name1);
        $this->createTable($name2);
        $this->createTable($name3);
        
        // Test
        $result = $this->wrapper->queryTables($options);
        
        // Assert
        $tables = $result->getTables();
        $this->assertCount(2, $tables);
        $this->assertEquals($name2, $tables[0]);
        $this->assertEquals($name3, $tables[1]);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::insertEntity
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::getEntity
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_generatePropertiesXml
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseEntity
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseOneEntity
     */
    public function testInsertEntity()
    {
        // Setup
        $name = 'insertentity';
        $this->createTable($name);
        $entity = TestResources::getTestEntity('123', '456');
        
        // Test
        $result = $this->wrapper->insertEntity($name, $entity);
        
        // Assert
        $entity = $result->getEntity();
        $this->assertEquals($entity->getPartitionKey(), $entity->getPartitionKey());
        $this->assertEquals($entity->getRowKey(), $entity->getRowKey());
        $this->assertCount(count($entity->getProperties()), $entity->getProperties());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseOneEntity
     */
    public function testQueryEntitiesWithEmpty()
    {
        // Setup
        $name = 'queryentitieswithempty';
        $this->createTable($name);
        
        // Test
        $result = $this->wrapper->queryEntities($name);
        
        // Assert
        $entities = $result->getEntities();
        $this->assertCount(0, $entities);
        
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseOneEntity
     */
    public function testQueryEntitiesWithOneEntity()
    {
        // Setup
        $name = 'queryentitieswithoneentity';
        $pk1 = '123';
        $e1 = TestResources::getTestEntity($pk1, '1');
        $this->createTable($name);
        $this->wrapper->insertEntity($name, $e1);
        
        // Test
        $result = $this->wrapper->queryEntities($name);
        
        // Assert
        $entities = $result->getEntities();
        $this->assertCount(1, $entities);
        $this->assertEquals($pk1, $entities[0]->getPartitionKey());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\TableRestProxy::queryEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseBody
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::parseEntities
     * @covers PEAR2\WindowsAzure\Services\Table\Utilities\AtomReaderWriter::_parseOneEntity
     */
    public function testQueryEntitiesWithMultipleEntities()
    {
        // Setup
        $name = 'queryentitieswithmultipleentities';
        $pk1 = '123';
        $pk2 = '124';
        $pk3 = '125';
        $e1 = TestResources::getTestEntity($pk1, '1');
        $e2 = TestResources::getTestEntity($pk2, '2');
        $e3 = TestResources::getTestEntity($pk3, '3');
        $this->createTable($name);
        $this->wrapper->insertEntity($name, $e1);
        $this->wrapper->insertEntity($name, $e2);
        $this->wrapper->insertEntity($name, $e3);
        
        // Test
        $result = $this->wrapper->queryEntities($name);
        
        // Assert
        $entities = $result->getEntities();
        $this->assertCount(3, $entities);
        $this->assertEquals($pk1, $entities[0]->getPartitionKey());
        $this->assertEquals($pk2, $entities[1]->getPartitionKey());
        $this->assertEquals($pk3, $entities[2]->getPartitionKey());
    }
}

?>