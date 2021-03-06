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

class InstanceTemplate extends \Google\Model
{
  public $creationTimestamp;
  public $description;
  public $id;
  public $kind;
  public $name;
  protected $propertiesType = InstanceProperties::class;
  protected $propertiesDataType = '';
  public $selfLink;
  public $sourceInstance;
  protected $sourceInstanceParamsType = SourceInstanceParams::class;
  protected $sourceInstanceParamsDataType = '';

  public function setCreationTimestamp($creationTimestamp)
  {
    $this->creationTimestamp = $creationTimestamp;
  }
  public function getCreationTimestamp()
  {
    return $this->creationTimestamp;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param InstanceProperties
   */
  public function setProperties(InstanceProperties $properties)
  {
    $this->properties = $properties;
  }
  /**
   * @return InstanceProperties
   */
  public function getProperties()
  {
    return $this->properties;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
  public function setSourceInstance($sourceInstance)
  {
    $this->sourceInstance = $sourceInstance;
  }
  public function getSourceInstance()
  {
    return $this->sourceInstance;
  }
  /**
   * @param SourceInstanceParams
   */
  public function setSourceInstanceParams(SourceInstanceParams $sourceInstanceParams)
  {
    $this->sourceInstanceParams = $sourceInstanceParams;
  }
  /**
   * @return SourceInstanceParams
   */
  public function getSourceInstanceParams()
  {
    return $this->sourceInstanceParams;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(InstanceTemplate::class, 'Google_Service_Compute_InstanceTemplate');
