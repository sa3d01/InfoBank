<?php

namespace Modules\Enrichment\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Enrichment\Entities\Enrichment;
use Modules\Enrichment\Entities\Faq;

class EnrichmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Enrichment::create([
           "title"=>"عنوان تجريبي" ,
           "description"=>"وصف نصي للمحتوي" ,
           "media_link"=>"<iframe width='950' height='534' src='https://www.youtube.com/embed/r8JuuG6wRxM' title='تلاوه خياليه من سوره الانفال تريح القلب للشيخ المنشاوي' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>" ,
        ]);
        Enrichment::create([
           "title"=>"  2عنوان تجريبي" ,
           "description"=>"وصف نصي للمحتويوصف نصي للمحتويوصف نصي للمحتويوصف نصي للمحتويوصف نصي للمحتوي" ,
            "media_link"=>"<iframe width='950' height='534' src='https://www.youtube.com/embed/e0oyMk2XENo' title='أحمد خالد توفيق |  مقالات مجمعة  (1) | بصوت إسلام عادل' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>" ,
        ]);
        Faq::create([
           "question"=>"ما هو ......",
           "answer"=>"Is there a GraphQL client package available for PHP, laravel to be specific?
From the Apollo website, I can only see clients for React, Vue.js, Angular, Android, iOS, Ember and Meteor.
I need to consume a GraphQL endpoint in the controller of my laravel project."
        ]);
        Faq::create([
           "question"=>"كيف ......",
           "answer"=>"Angular, Android, iOS, Ember and Meteor.
I need to consume a GraphQL endpoint in the controller of my laravel project."
        ]);
    }
}
