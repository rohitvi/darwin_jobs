<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Compute;

class AuditLogConfig extends \Google\Collection
{
  protected $collection_key = 'exemptedMembers';
  public $exemptedMembers;
  public $ignoreChildExemptions;
  public $logType;

  public function setExemptedMembers($exemptedMembers)
  {
    $this->exemptedMembers = $exemptedMembers;
  }
  public function getExemptedMembers()
  {
    return $this->exemptedMembers;
  }
  public function setIgnoreChildExemptions($ignoreChildExemptions)
  {
    $this->ignoreChildExemptions = $ignoreChildExemptions;
  }
  public function getIgnoreChildExemptions()
  {
    return $this->ignoreChildExemptions;
  }
  public function setLogType($logType)
  {
    $this->logType = $logType;
  }
  public function getLogType()
  {
    return $this->logType;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AuditLogConfig::class, 'Google_Service_Compute_AuditLogConfig');
