<?php

namespace App\Tests\Controller;

use App\Entity\Overalls;
use App\Repository\OverallRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class OverallsControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/overalls/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Overalls::class);

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
        self::assertPageTitleContains('Overall index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'overall[total]' => 'Testing',
            'overall[speed]' => 'Testing',
            'overall[offense]' => 'Testing',
            'overall[shoot]' => 'Testing',
            'overall[dribble]' => 'Testing',
            'overall[pass]' => 'Testing',
            'overall[defend]' => 'Testing',
            'overall[playerId]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Overalls();
        $fixture->setTotal('My Title');
        $fixture->setSpeed('My Title');
        $fixture->setOffense('My Title');
        $fixture->setShoot('My Title');
        $fixture->setDribble('My Title');
        $fixture->setPass('My Title');
        $fixture->setDefend('My Title');
        $fixture->setPlayerId('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Overall');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Overalls();
        $fixture->setTotal('Value');
        $fixture->setSpeed('Value');
        $fixture->setOffense('Value');
        $fixture->setShoot('Value');
        $fixture->setDribble('Value');
        $fixture->setPass('Value');
        $fixture->setDefend('Value');
        $fixture->setPlayerId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'overall[total]' => 'Something New',
            'overall[speed]' => 'Something New',
            'overall[offense]' => 'Something New',
            'overall[shoot]' => 'Something New',
            'overall[dribble]' => 'Something New',
            'overall[pass]' => 'Something New',
            'overall[defend]' => 'Something New',
            'overall[playerId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/overalls/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTotal());
        self::assertSame('Something New', $fixture[0]->getSpeed());
        self::assertSame('Something New', $fixture[0]->getOffense());
        self::assertSame('Something New', $fixture[0]->getShoot());
        self::assertSame('Something New', $fixture[0]->getDribble());
        self::assertSame('Something New', $fixture[0]->getPass());
        self::assertSame('Something New', $fixture[0]->getDefend());
        self::assertSame('Something New', $fixture[0]->getPlayerId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Overalls();
        $fixture->setTotal('Value');
        $fixture->setSpeed('Value');
        $fixture->setOffense('Value');
        $fixture->setShoot('Value');
        $fixture->setDribble('Value');
        $fixture->setPass('Value');
        $fixture->setDefend('Value');
        $fixture->setPlayerId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/overalls/');
        self::assertSame(0, $this->repository->count([]));
    }
}
