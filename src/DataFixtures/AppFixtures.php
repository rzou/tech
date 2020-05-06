<?php


namespace App\DataFixtures;



use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle("title of post");
        $blogPost->setPublished(new \DateTime("2020-05-05 23:20:45"));
        $blogPost->setContent("content of post");
        $blogPost->setAuthor("Abderrazak HAMROUNI");
        $blogPost->setSlug("this-is-a-fixture-post");

        $manager->persist($blogPost);

        $manager->flush();
    }
}