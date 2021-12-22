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

namespace Google\Service\CloudSearch;

class Metadata extends \Google\Collection
{
  protected $collection_key = 'fields';
  public $createTime;
  protected $displayOptionsType = ResultDisplayMetadata::class;
  protected $displayOptionsDataType = '';
  protected $fieldsType = NamedProperty::class;
  protected $fieldsDataType = 'array';
  public $mimeType;
  public $objectType;
  protected $ownerType = Person::class;
  protected $ownerDataType = '';
  protected $sourceType = Source::class;
  protected $sourceDataType = '';
  public $updateTime;

  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param ResultDisplayMetadata
   */
  public function setDisplayOptions(ResultDisplayMetadata $displayOptions)
  {
    $this->displayOptions = $displayOptions;
  }
  /**
   * @return ResultDisplayMetadata
   */
  public function getDisplayOptions()
  {
    return $this->displayOptions;
  }
  /**
   * @param NamedProperty[]
   */
  public function setFields($fields)
  {
    $this->fields = $fields;
  }
  /**
   * @return NamedProperty[]
   */
  public function getFields()
  {
    return $this->fields;
  }
  public function setMimeType($mimeType)
  {
    $this->mimeType = $mimeType;
  }
  public function getMimeType()
  {
    return $this->mimeType;
  }
  public function setObjectType($objectType)
  {
    $this->objectType = $objectType;
  }
  public function getObjectType()
  {
    return $this->objectType;
  }
  /**
   * @param Person
   */
  public function setOwner(Person $owner)
  {
    $this->owner = $owner;
  }
  /**
   * @return Person
   */
  public function getOwner()
  {
    return $this->owner;
  }
  /**
   * @param Source
   */
  public function setSource(Source $source)
  {
    $this->source = $source;
  }
  /**
   * @return Source
   */
  public function getSource()
  {
    return $this->source;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Metadata::class, 'Google_Service_CloudSearch_Metadata');
