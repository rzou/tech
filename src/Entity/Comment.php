<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ApiResource(
 *     itemOperations={
 *          "get",
 *          "put"={"access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object.getAuthor()==user"}
 *     },
 *     collectionOperations={
 *          "get",
 *          "post" = {"access_control"="is_granted('IS_AUTHENTICATED_FULLY')"}
 *     },
 *      denormalizationContext={
 *          "groups"="post"
 *      },
 *     subresourceOperations={
 *          "api_blog_posts_comments_get_subresource"={
 *                  "method"="GET",
 *                  "normalizationContext"={"groups"={"get"}}
 *          }
 *     }
 * )
 */
class Comment implements AuthoredEntityInterface, PublishedDateEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-comment-with-author"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"post", "get-comment-with-author"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get-comment-with-author"})
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-comment-with-author"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="comments")
     * @Groups({"post"})
     */
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    /**
     * @param UserInterface $author
     * @return AuthoredEntityInterface
     */
    public function setAuthor(UserInterface $author): AuthoredEntityInterface
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return BlogPost
     */
    public function getPost() : BlogPost
    {
        return $this->post;
    }

    /**
     * @param BlogPost $post
     * @return Comment
     */
    public function setPost($post): Comment
    {
        $this->post = $post;
        return $this;
    }


}
