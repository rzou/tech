<?php


namespace App\DataFixtures;



use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $faker;
    private const USERS = [
        [
            "username"=>"admin",
            "email"=>"admin@blog.com",
            "name"=>"Abdo Ham",
            "password"=>"Solo123"
        ],
        [
            "username"=>"john_doe",
            "email"=>"john@blog.com",
            "name"=>"John Doe",
            "password"=>"Solo123"
        ],
        [
            "username"=>"rob_smith",
            "email"=>"rob@blog.com",
            "name"=>"Rob Smith",
            "password"=>"Solo123"
        ],
        [
            "username"=>"jenny_rowling",
            "email"=>"jenny@admin.com",
            "name"=>"Jenny Rowling",
            "password"=>"Solo123"
        ]
    ];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadBlogPosts($manager);
        $this->loadComments($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        for ($i=0; $i<100; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitle($this->faker->realText(30));
            $blogPost->setPublished($this->faker->dateTime);
            $blogPost->setContent($this->faker->realText());
            $blogPost->setAuthor($this->getRandomUserReference());
            $blogPost->setSlug($this->faker->slug);

            $this->setReference("blogpost_$i", $blogPost);

            $manager->persist($blogPost);
        }
        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {

        for($i=0; $i < 100; $i++)
        {
            $post = $this->getReference("blogpost_$i");
            for ($j=0; $j <= rand(1,5); $j++)
            {
                $comment = new Comment();
                $comment->setContent($this->faker->realText());
                $comment->setPublished($this->faker->dateTimeThisYear);
                $authorReference = $this->getRandomUserReference();
                $comment->setPost($post);
                $comment->setAuthor($authorReference);

                $manager->persist($comment);
            }
        }
        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        foreach (self::USERS as $u){
            $user = new User();
            $user->setName($u['name']);
            $user->setUsername($u['username']);
            $user->setEmail($u['email']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $u['password']));

            $this->addReference("user_".$u['username'], $user);

            $manager->persist($user);
        }

        $manager->flush();
    }

    protected function getRandomUserReference(): User
    {
        return $this->getReference('user_' . self::USERS[rand(0,3)]['username']);
    }
}