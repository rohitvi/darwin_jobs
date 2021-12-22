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

namespace Google\Service\Dns;

class ResourceRecordSet extends \Google\Collection
{
  protected $collection_key = 'signatureRrdatas';
  public $kind;
  public $name;
  public $rrdatas;
  public $signatureRrdatas;
  public $ttl;
  public $type;

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
  public function setRrdatas($rrdatas)
  {
    $this->rrdatas = $rrdatas;
  }
  public function getRrdatas()
  {
    return $this->rrdatas;
  }
  public function setSignatureRrdatas($signatureRrdatas)
  {
    $this->signatureRrdatas = $signatureRrdatas;
  }
  public function getSignatureRrdatas()
  {
    return $this->signatureRrdatas;
  }
  public function setTtl($ttl)
  {
    $this->ttl = $ttl;
  }
  public function getTtl()
  {
    return $this->ttl;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ResourceRecordSet::class, 'Google_Service_Dns_ResourceRecordSet');
