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
 * @package   WindowsAzure\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */
 
namespace WindowsAzure\ServiceBus\Models;
use WindowsAzure\ServiceBus\Models\RuleInfo; 

/**
 * The results of a create rule request.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */

class CreateRuleResult
{
    /**
     * The information of the rule. 
     *
     * @var RuleInfo
     */
    private $_ruleInfo;

    /**
     * Populates the rule information from the response of a create rule
     * request. 
     * 
     * @param string $createRuleResponseBody The response of the create rule
     * request.
     * 
     * @return none
     */
    public function parseXml($createRuleResponseBody)
    {
        $this->_ruleInfo = new RuleInfo();
        $this->_ruleInfo->parseXml($createRuleResponseBody);
    }

    /**
     * Creates a create rule result instance with default parameters. 
     */
    public function __construct()
    {
    }

    /**
     * Gets rule information.
     * 
     * @return RuleInfo
     */
    public function getRuleInfo()
    {
        return $this->_ruleInfo;
    }

    /**
     * Sets the rule information. 
     * 
     * @param RuleInfo $ruleInfo The information of the rule. 
     *
     * @return none
     */
    public function setRuleInfo($ruleInfo)
    {
        $this->_ruleInfo = $ruleInfo;
    }
}
?>