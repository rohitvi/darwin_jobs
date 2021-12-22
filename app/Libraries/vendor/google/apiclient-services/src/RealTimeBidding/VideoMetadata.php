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

namespace Google\Service\RealTimeBidding;

class VideoMetadata extends \Google\Collection
{
  protected $collection_key = 'mediaFiles';
  public $duration;
  public $isValidVast;
  public $isVpaid;
  protected $mediaFilesType = MediaFile::class;
  protected $mediaFilesDataType = 'array';
  public $skipOffset;
  public $vastVersion;

  public function setDuration($duration)
  {
    $this->duration = $duration;
  }
  public function getDuration()
  {
    return $this->duration;
  }
  public function setIsValidVast($isValidVast)
  {
    $this->isValidVast = $isValidVast;
  }
  public function getIsValidVast()
  {
    return $this->isValidVast;
  }
  public function setIsVpaid($isVpaid)
  {
    $this->isVpaid = $isVpaid;
  }
  public function getIsVpaid()
  {
    return $this->isVpaid;
  }
  /**
   * @param MediaFile[]
   */
  public function setMediaFiles($mediaFiles)
  {
    $this->mediaFiles = $mediaFiles;
  }
  /**
   * @return MediaFile[]
   */
  public function getMediaFiles()
  {
    return $this->mediaFiles;
  }
  public function setSkipOffset($skipOffset)
  {
    $this->skipOffset = $skipOffset;
  }
  public function getSkipOffset()
  {
    return $this->skipOffset;
  }
  public function setVastVersion($vastVersion)
  {
    $this->vastVersion = $vastVersion;
  }
  public function getVastVersion()
  {
    return $this->vastVersion;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(VideoMetadata::class, 'Google_Service_RealTimeBidding_VideoMetadata');
