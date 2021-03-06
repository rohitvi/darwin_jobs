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

namespace Google\Service\CloudTalentSolution;

class MatchingJob extends \Google\Model
{
  protected $commuteInfoType = CommuteInfo::class;
  protected $commuteInfoDataType = '';
  protected $jobType = Job::class;
  protected $jobDataType = '';
  public $jobSummary;
  public $jobTitleSnippet;
  public $searchTextSnippet;

  /**
   * @param CommuteInfo
   */
  public function setCommuteInfo(CommuteInfo $commuteInfo)
  {
    $this->commuteInfo = $commuteInfo;
  }
  /**
   * @return CommuteInfo
   */
  public function getCommuteInfo()
  {
    return $this->commuteInfo;
  }
  /**
   * @param Job
   */
  public function setJob(Job $job)
  {
    $this->job = $job;
  }
  /**
   * @return Job
   */
  public function getJob()
  {
    return $this->job;
  }
  public function setJobSummary($jobSummary)
  {
    $this->jobSummary = $jobSummary;
  }
  public function getJobSummary()
  {
    return $this->jobSummary;
  }
  public function setJobTitleSnippet($jobTitleSnippet)
  {
    $this->jobTitleSnippet = $jobTitleSnippet;
  }
  public function getJobTitleSnippet()
  {
    return $this->jobTitleSnippet;
  }
  public function setSearchTextSnippet($searchTextSnippet)
  {
    $this->searchTextSnippet = $searchTextSnippet;
  }
  public function getSearchTextSnippet()
  {
    return $this->searchTextSnippet;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(MatchingJob::class, 'Google_Service_CloudTalentSolution_MatchingJob');
