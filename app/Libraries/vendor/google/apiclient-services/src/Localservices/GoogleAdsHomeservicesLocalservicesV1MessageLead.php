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

namespace Google\Service\Localservices;

class GoogleAdsHomeservicesLocalservicesV1MessageLead extends \Google\Model
{
  public $consumerPhoneNumber;
  public $customerName;
  public $jobType;
  public $postalCode;

  public function setConsumerPhoneNumber($consumerPhoneNumber)
  {
    $this->consumerPhoneNumber = $consumerPhoneNumber;
  }
  public function getConsumerPhoneNumber()
  {
    return $this->consumerPhoneNumber;
  }
  public function setCustomerName($customerName)
  {
    $this->customerName = $customerName;
  }
  public function getCustomerName()
  {
    return $this->customerName;
  }
  public function setJobType($jobType)
  {
    $this->jobType = $jobType;
  }
  public function getJobType()
  {
    return $this->jobType;
  }
  public function setPostalCode($postalCode)
  {
    $this->postalCode = $postalCode;
  }
  public function getPostalCode()
  {
    return $this->postalCode;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAdsHomeservicesLocalservicesV1MessageLead::class, 'Google_Service_Localservices_GoogleAdsHomeservicesLocalservicesV1MessageLead');
