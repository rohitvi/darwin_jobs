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

namespace Google\Service\CloudRun;

class ServiceSpec extends \Google\Collection
{
  protected $collection_key = 'traffic';
  protected $templateType = RevisionTemplate::class;
  protected $templateDataType = '';
  protected $trafficType = TrafficTarget::class;
  protected $trafficDataType = 'array';

  /**
   * @param RevisionTemplate
   */
  public function setTemplate(RevisionTemplate $template)
  {
    $this->template = $template;
  }
  /**
   * @return RevisionTemplate
   */
  public function getTemplate()
  {
    return $this->template;
  }
  /**
   * @param TrafficTarget[]
   */
  public function setTraffic($traffic)
  {
    $this->traffic = $traffic;
  }
  /**
   * @return TrafficTarget[]
   */
  public function getTraffic()
  {
    return $this->traffic;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ServiceSpec::class, 'Google_Service_CloudRun_ServiceSpec');
