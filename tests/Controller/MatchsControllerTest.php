<?php

namespace App\Tests\Controller;

use App\Entity\Matchs;
use App\Repository\MatchsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class MatchsControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/matchs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Matchs::class);

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
        self::assertPageTitleContains('Match index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'match[teamHomeScore]' => 'Testing',
            'match[teamAwayScore]' => 'Testing',
            'match[arcs]' => 'Testing',
            'match[teamHomeId]' => 'Testing',
            'match[teamAwayId]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchs();
        $fixture->setTeamHomeScore('My Title');
        $fixture->setTeamAwayScore('My Title');
        $fixture->setArcs('My Title');
        $fixture->setTeamHomeId('My Title');
        $fixture->setTeamAwayId('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Match');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchs();
        $fixture->setTeamHomeScore('Value');
        $fixture->setTeamAwayScore('Value');
        $fixture->setArcs('Value');
        $fixture->setTeamHomeId('Value');
        $fixture->setTeamAwayId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'match[teamHomeScore]' => 'Something New',
            'match[teamAwayScore]' => 'Something New',
            'match[arcs]' => 'Something New',
            'match[teamHomeId]' => 'Something New',
            'match[teamAwayId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/matchs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTeamHomeScore());
        self::assertSame('Something New', $fixture[0]->getTeamAwayScore());
        self::assertSame('Something New', $fixture[0]->getArcs());
        self::assertSame('Something New', $fixture[0]->getTeamHomeId());
        self::assertSame('Something New', $fixture[0]->getTeamAwayId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchs();
        $fixture->setTeamHomeScore('Value');
        $fixture->setTeamAwayScore('Value');
        $fixture->setArcs('Value');
        $fixture->setTeamHomeId('Value');
        $fixture->setTeamAwayId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/matchs/');
        self::assertSame(0, $this->repository->count([]));
    }
}
