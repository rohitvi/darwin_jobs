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

namespace Google\Service\Apigee\Resource;

use Google\Service\Apigee\GoogleCloudApigeeV1KeyValueMap;

/**
 * The "keyvaluemaps" collection of methods.
 * Typical usage is:
 *  <code>
 *   $apigeeService = new Google\Service\Apigee(...);
 *   $keyvaluemaps = $apigeeService->keyvaluemaps;
 *  </code>
 */
class OrganizationsApisKeyvaluemaps extends \Google\Service\Resource
{
  /**
   * Creates a key value map in an api proxy. (keyvaluemaps.create)
   *
   * @param string $parent Required. The name of the environment in which to
   * create the key value map. Must be of the form
   * `organizations/{organization}/apis/{api}`.
   * @param GoogleCloudApigeeV1KeyValueMap $postBody
   * @param array $optParams Optional parameters.
   * @return GoogleCloudApigeeV1KeyValueMap
   */
  public function create($parent, GoogleCloudApigeeV1KeyValueMap $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('create', [$params], GoogleCloudApigeeV1KeyValueMap::class);
  }
  /**
   * Delete a key value map in an api proxy. (keyvaluemaps.delete)
   *
   * @param string $name Required. The name of the key value map. Must be of the
   * form `organizations/{organization}/apis/{api}/keyvaluemaps/{keyvaluemap}`.
   * @param array $optParams Optional parameters.
   * @return GoogleCloudApigeeV1KeyValueMap
   */
  public function delete($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('delete', [$params], GoogleCloudApigeeV1KeyValueMap::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OrganizationsApisKeyvaluemaps::class, 'Google_Service_Apigee_Resource_OrganizationsApisKeyvaluemaps');
