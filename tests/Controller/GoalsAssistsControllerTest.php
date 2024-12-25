<?php

namespace App\Tests\Controller;

use App\Entity\GoalsAssists;
use App\Repository\GoalsAssistsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GoalsAssistsControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/goals/assists/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(GoalsAssists::class);

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
        self::assertPageTitleContains('GoalsAssist index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'goals_assist[matchId]' => 'Testing',
            'goals_assist[teamId]' => 'Testing',
            'goals_assist[goalId]' => 'Testing',
            'goals_assist[assistId]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new GoalsAssists();
        $fixture->setMatchId('My Title');
        $fixture->setTeamId('My Title');
        $fixture->setGoalId('My Title');
        $fixture->setAssistId('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('GoalsAssist');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new GoalsAssists();
        $fixture->setMatchId('Value');
        $fixture->setTeamId('Value');
        $fixture->setGoalId('Value');
        $fixture->setAssistId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'goals_assist[matchId]' => 'Something New',
            'goals_assist[teamId]' => 'Something New',
            'goals_assist[goalId]' => 'Something New',
            'goals_assist[assistId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/goals/assists/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getMatchId());
        self::assertSame('Something New', $fixture[0]->getTeamId());
        self::assertSame('Something New', $fixture[0]->getGoalId());
        self::assertSame('Something New', $fixture[0]->getAssistId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new GoalsAssists();
        $fixture->setMatchId('Value');
        $fixture->setTeamId('Value');
        $fixture->setGoalId('Value');
        $fixture->setAssistId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/goals/assists/');
        self::assertSame(0, $this->repository->count([]));
    }
}
