<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Softonic\GraphQL\ClientBuilder;

trait ClientRequestTrait
{
    protected function getUserByToken($token)
    {
        $client = ClientBuilder::build(
            'https://api.info-bank.co/graphql',
            [
                'headers' => ['Authorization' => "$token"]

            ]
        );
        $query = <<<'QUERY'
                    query profile_client {
                        profile_client {
                          id
                          place {
                            id
                            name{
                              value
                            }
                          }
                          firstName
                          lastName
                          middleName
                          fullName
                          email
                          phone
                          knowledgeBankType
                          deleted
                        }
                     }
                    QUERY;

        $variables = [
            'headers' => ['Authorization' => "$token"]
        ];
        try {
            $response = $client->query($query, $variables);
            if ($response->hasErrors()) {
                $response = $response->getErrors();
            } else {
                $response = $response->getData();
            }
        } catch (ConnectException | Exception | RequestException $e) {
            $response = $e;
        }
        return $response;
    }
    protected function getUserIdByToken($token)
    {
        $client = ClientBuilder::build(
            'https://api.info-bank.co/graphql',
            [
                'headers' => ['Authorization' => "$token"]

            ]
        );
        $query = <<<'QUERY'
                    query profile_client {
                        profile_client {
                          id
                        }
                     }
                    QUERY;

        $variables = [
            'headers' => ['Authorization' => "$token"]
        ];
        try {
            $response = $client->query($query, $variables);
            if ($response->hasErrors()) {
                $response = $response->getErrors();
            } else {
                $response = $response->getData();
            }
        } catch (ConnectException | Exception | RequestException $e) {
            $response = $e;
        }
        return $response;
    }
    protected function getPlaceById($placeId)
    {
        $client = ClientBuilder::build(
            'https://api.info-bank.co/graphql',
        );
        $query = <<<'QUERY'
                    query get_place {
                        get_place {
                            id
                            name{
                              value
                            }
                        }
                      }
                    QUERY;

        $variables = [
            'id' => $placeId
        ];
        try {
            $response = $client->query($query, $variables);
            if ($response->hasErrors()) {
                $response = $response->getErrors();
            } else {
                $response = $response->getData();
            }
        } catch (ConnectException | Exception | RequestException $e) {
            $response = $e;
        }
        return $response;
    }

}
