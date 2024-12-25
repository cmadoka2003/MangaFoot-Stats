<?php

namespace App\Tests\Controller;

use App\Entity\PlayersTeam;
use App\Repository\PlayersTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PlayersTeamControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/players/team/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(PlayersTeam::class);

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
        self::assertPageTitleContains('PlayersTeam index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'players_team[playerPosition]' => 'Testing',
            'players_team[actif]' => 'Testing',
            'players_team[teamId]' => 'Testing',
            'players_team[playerId]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlayersTeam();
        $fixture->setPlayerPosition('My Title');
        $fixture->setActif('My Title');
        $fixture->setTeamId('My Title');
        $fixture->setPlayerId('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PlayersTeam');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlayersTeam();
        $fixture->setPlayerPosition('Value');
        $fixture->setActif('Value');
        $fixture->setTeamId('Value');
        $fixture->setPlayerId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'players_team[playerPosition]' => 'Something New',
            'players_team[actif]' => 'Something New',
            'players_team[teamId]' => 'Something New',
            'players_team[playerId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/players/team/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPlayerPosition());
        self::assertSame('Something New', $fixture[0]->getActif());
        self::assertSame('Something New', $fixture[0]->getTeamId());
        self::assertSame('Something New', $fixture[0]->getPlayerId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new PlayersTeam();
        $fixture->setPlayerPosition('Value');
        $fixture->setActif('Value');
        $fixture->setTeamId('Value');
        $fixture->setPlayerId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/players/team/');
        self::assertSame(0, $this->repository->count([]));
    }
}
