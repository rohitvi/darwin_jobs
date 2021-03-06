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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowCxV3EntityType extends \Google\Collection
{
  protected $collection_key = 'excludedPhrases';
  public $autoExpansionMode;
  public $displayName;
  public $enableFuzzyExtraction;
  protected $entitiesType = GoogleCloudDialogflowCxV3EntityTypeEntity::class;
  protected $entitiesDataType = 'array';
  protected $excludedPhrasesType = GoogleCloudDialogflowCxV3EntityTypeExcludedPhrase::class;
  protected $excludedPhrasesDataType = 'array';
  public $kind;
  public $name;
  public $redact;

  public function setAutoExpansionMode($autoExpansionMode)
  {
    $this->autoExpansionMode = $autoExpansionMode;
  }
  public function getAutoExpansionMode()
  {
    return $this->autoExpansionMode;
  }
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setEnableFuzzyExtraction($enableFuzzyExtraction)
  {
    $this->enableFuzzyExtraction = $enableFuzzyExtraction;
  }
  public function getEnableFuzzyExtraction()
  {
    return $this->enableFuzzyExtraction;
  }
  /**
   * @param GoogleCloudDialogflowCxV3EntityTypeEntity[]
   */
  public function setEntities($entities)
  {
    $this->entities = $entities;
  }
  /**
   * @return GoogleCloudDialogflowCxV3EntityTypeEntity[]
   */
  public function getEntities()
  {
    return $this->entities;
  }
  /**
   * @param GoogleCloudDialogflowCxV3EntityTypeExcludedPhrase[]
   */
  public function setExcludedPhrases($excludedPhrases)
  {
    $this->excludedPhrases = $excludedPhrases;
  }
  /**
   * @return GoogleCloudDialogflowCxV3EntityTypeExcludedPhrase[]
   */
  public function getExcludedPhrases()
  {
    return $this->excludedPhrases;
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
  public function setRedact($redact)
  {
    $this->redact = $redact;
  }
  public function getRedact()
  {
    return $this->redact;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3EntityType::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3EntityType');
