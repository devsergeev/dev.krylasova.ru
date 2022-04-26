<?php

namespace App\Seo\Test\Unit\Entity;

use App\Seo\Entity\Attributes;
use App\Seo\Entity\Tag\Type;
use App\Seo\Entity\Template\Required;
use App\Seo\Entity\Template\Template;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Slim\App;

class TagNotest extends TestCase
{
    private ?App $app = null;

    public function testSuccess()
    {
        $container = $this->app()->getContainer();
        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);

        $tag = new TagNotest('div', new Type(Type::PAIR));

        $em->persist($tag);
        $em->flush();

        $id = $tag->getId();

        $repo = $em->getRepository(TagNotest::class);

        /** @var TagNotest $tag */
        $tag = $repo->find($tag->getId());

        $this->assertEquals(
            $id,
            $tag->getId(),
        );

        $template = new Template(
            'Метатег Description',
            new TagNotest('meta', new Type(Type::SINGLE)),
            new Required(['content']),
            new Attributes(['name' => 'description']),
        );

        $em->persist($template);
        $em->flush();

        $id = $template->getId();

        $repo = $em->getRepository(Template::class);

        /** @var Template $template */
        $template = $repo->find($template->getId());

        $this->assertEquals(
            $id,
            $template->getId(),
        );

        $required = $template->getRequired();
        $this->assertEquals(
            false,
            $required->textIsRequired(),
        );

        $this->assertEquals(
            ['content'],
            $required->getAttributes(),
        );
    }

    protected function app(): App
    {
        if ($this->app === null) {
            $this->app = (require __DIR__ . '/../../../../../config/app.php')($this->container());
        }
        return $this->app;
    }

    private function container(): ContainerInterface
    {
        return require __DIR__ . '/../../../../../config/container.php';
    }
}
