<?php

namespace Modules\Need\Database\Seeders;

use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Need\Entities\Content;
use Modules\Need\Entities\Place;
use Modules\Need\Entities\Slider;
use Modules\Need\Entities\Training;
use Softonic\GraphQL\ClientBuilder;

class NeedDatabaseSeeder extends Seeder
{
    public function places(){
        $client = ClientBuilder::build(
            'https://api.info-bank.co/graphql',
        );
        $query = <<<'QUERY'
                    query places {
                        places {
                          nodes {
                            id
                            name{
                              value
                            }
                          }
                        }
                      }
                    QUERY;

        $variables = [
            ""=>""
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
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try {
            $places=$this->places();
            foreach ($places['places']['nodes'] as $place){
                $data['id']=$place['id'];
                $data['name']=$place['name'][0]['value'];
                Place::firstOrCreate($data);
            }
        }catch (Exception ){

        }
        Training::create([
           'name'=>'تشيد و بناء',
            'type'=>'title'
        ]);
        Training::create([
           'name'=>'تدريب صيفي' ,
            'type'=>'category'
        ]);
        Slider::create([
            'topic'=>'أهلا بك ..',
            'title'=>'في الاحتياج التجريبي',
            'description'=>'test desc'
        ]);
        Content::create([
           'name'=>'about_need',
            'description'=>'sample of content description'
        ]);
        Content::create([
           'name'=>'need_form',
            'description'=>'sample of content description'
        ]);
        Content::create([
           'name'=>'offline_courses',
            'description'=>'sample of content description'
        ]);
        Content::create([
           'name'=>'online_courses',
            'description'=>'sample of content description'
        ]);

        // $this->call("OthersTableSeeder");
    }
}
