<?php

namespace App\Tests\Controller;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PlayerControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/player/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Player::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Player index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'player[avatar]' => 'Testing',
            'player[firstname]' => 'Testing',
            'player[lastname]' => 'Testing',
            'player[age]' => 'Testing',
            'player[birthdate]' => 'Testing',
            'player[height]' => 'Testing',
            'player[position_favorite]' => 'Testing',
            'player[country]' => 'Testing',
            'player[number]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setAvatar('My Title');
        $fixture->setFirstname('My Title');
        $fixture->setLastname('My Title');
        $fixture->setAge('My Title');
        $fixture->setBirthdate('My Title');
        $fixture->setHeight('My Title');
        $fixture->setPosition_favorite('My Title');
        $fixture->setCountry('My Title');
        $fixture->setNumber('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Player');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setAvatar('Value');
        $fixture->setFirstname('Value');
        $fixture->setLastname('Value');
        $fixture->setAge('Value');
        $fixture->setBirthdate('Value');
        $fixture->setHeight('Value');
        $fixture->setPosition_favorite('Value');
        $fixture->setCountry('Value');
        $fixture->setNumber('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'player[avatar]' => 'Something New',
            'player[firstname]' => 'Something New',
            'player[lastname]' => 'Something New',
            'player[age]' => 'Something New',
            'player[birthdate]' => 'Something New',
            'player[height]' => 'Something New',
            'player[position_favorite]' => 'Something New',
            'player[country]' => 'Something New',
            'player[number]' => 'Something New',
        ]);

        self::assertResponseRedirects('/player/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAvatar());
        self::assertSame('Something New', $fixture[0]->getFirstname());
        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getBirthdate());
        self::assertSame('Something New', $fixture[0]->getHeight());
        self::assertSame('Something New', $fixture[0]->getPosition_favorite());
        self::assertSame('Something New', $fixture[0]->getCountry());
        self::assertSame('Something New', $fixture[0]->getNumber());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Player();
        $fixture->setAvatar('Value');
        $fixture->setFirstname('Value');
        $fixture->setLastname('Value');
        $fixture->setAge('Value');
        $fixture->setBirthdate('Value');
        $fixture->setHeight('Value');
        $fixture->setPosition_favorite('Value');
        $fixture->setCountry('Value');
        $fixture->setNumber('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/player/');
        self::assertSame(0, $this->repository->count([]));
    }
}
