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

namespace Google\Service\Dfareporting;

class OperatingSystemVersion extends \Google\Model
{
  public $id;
  public $kind;
  public $majorVersion;
  public $minorVersion;
  public $name;
  protected $operatingSystemType = OperatingSystem::class;
  protected $operatingSystemDataType = '';

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
  public function setMajorVersion($majorVersion)
  {
    $this->majorVersion = $majorVersion;
  }
  public function getMajorVersion()
  {
    return $this->majorVersion;
  }
  public function setMinorVersion($minorVersion)
  {
    $this->minorVersion = $minorVersion;
  }
  public function getMinorVersion()
  {
    return $this->minorVersion;
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
   * @param OperatingSystem
   */
  public function setOperatingSystem(OperatingSystem $operatingSystem)
  {
    $this->operatingSystem = $operatingSystem;
  }
  /**
   * @return OperatingSystem
   */
  public function getOperatingSystem()
  {
    return $this->operatingSystem;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OperatingSystemVersion::class, 'Google_Service_Dfareporting_OperatingSystemVersion');
