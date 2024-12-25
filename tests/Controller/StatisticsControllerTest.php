<?php

namespace App\Tests\Controller;

use App\Entity\Statistics;
use App\Repository\StatisticsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class StatisticsControllerTest extends WebTestCase{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/statistics/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Statistics::class);

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
        self::assertPageTitleContains('Statistic index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'statistic[goalkeeper]' => 'Testing',
            'statistic[shotsOnTarget]' => 'Testing',
            'statistic[shotsOffTarget]' => 'Testing',
            'statistic[blockedShots]' => 'Testing',
            'statistic[touches]' => 'Testing',
            'statistic[passAttempts]' => 'Testing',
            'statistic[sussessfulPasses]' => 'Testing',
            'statistic[dribbleAttempts]' => 'Testing',
            'statistic[sussessfulDribbles]' => 'Testing',
            'statistic[crosseAttempts]' => 'Testing',
            'statistic[sussessfulCrosses]' => 'Testing',
            'statistic[tackleAttempts]' => 'Testing',
            'statistic[sussessfulTackles]' => 'Testing',
            'statistic[aerialDuels]' => 'Testing',
            'statistic[possessionLost]' => 'Testing',
            'statistic[clearences]' => 'Testing',
            'statistic[interceptions]' => 'Testing',
            'statistic[dribbledPast]' => 'Testing',
            'statistic[fouls]' => 'Testing',
            'statistic[yellowCards]' => 'Testing',
            'statistic[redCards]' => 'Testing',
            'statistic[punches]' => 'Testing',
            'statistic[saves]' => 'Testing',
            'statistic[savesFromInsideBox]' => 'Testing',
            'statistic[goalConceded]' => 'Testing',
            'statistic[matchId]' => 'Testing',
            'statistic[playerId]' => 'Testing',
            'statistic[teamId]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistics();
        $fixture->setGoalkeeper('My Title');
        $fixture->setShotsOnTarget('My Title');
        $fixture->setShotsOffTarget('My Title');
        $fixture->setBlockedShots('My Title');
        $fixture->setTouches('My Title');
        $fixture->setPassAttempts('My Title');
        $fixture->setSussessfulPasses('My Title');
        $fixture->setDribbleAttempts('My Title');
        $fixture->setSussessfulDribbles('My Title');
        $fixture->setCrosseAttempts('My Title');
        $fixture->setSussessfulCrosses('My Title');
        $fixture->setTackleAttempts('My Title');
        $fixture->setSussessfulTackles('My Title');
        $fixture->setAerialDuels('My Title');
        $fixture->setPossessionLost('My Title');
        $fixture->setClearences('My Title');
        $fixture->setInterceptions('My Title');
        $fixture->setDribbledPast('My Title');
        $fixture->setFouls('My Title');
        $fixture->setYellowCards('My Title');
        $fixture->setRedCards('My Title');
        $fixture->setPunches('My Title');
        $fixture->setSaves('My Title');
        $fixture->setSavesFromInsideBox('My Title');
        $fixture->setGoalConceded('My Title');
        $fixture->setMatchId('My Title');
        $fixture->setPlayerId('My Title');
        $fixture->setTeamId('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Statistic');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistics();
        $fixture->setGoalkeeper('Value');
        $fixture->setShotsOnTarget('Value');
        $fixture->setShotsOffTarget('Value');
        $fixture->setBlockedShots('Value');
        $fixture->setTouches('Value');
        $fixture->setPassAttempts('Value');
        $fixture->setSussessfulPasses('Value');
        $fixture->setDribbleAttempts('Value');
        $fixture->setSussessfulDribbles('Value');
        $fixture->setCrosseAttempts('Value');
        $fixture->setSussessfulCrosses('Value');
        $fixture->setTackleAttempts('Value');
        $fixture->setSussessfulTackles('Value');
        $fixture->setAerialDuels('Value');
        $fixture->setPossessionLost('Value');
        $fixture->setClearences('Value');
        $fixture->setInterceptions('Value');
        $fixture->setDribbledPast('Value');
        $fixture->setFouls('Value');
        $fixture->setYellowCards('Value');
        $fixture->setRedCards('Value');
        $fixture->setPunches('Value');
        $fixture->setSaves('Value');
        $fixture->setSavesFromInsideBox('Value');
        $fixture->setGoalConceded('Value');
        $fixture->setMatchId('Value');
        $fixture->setPlayerId('Value');
        $fixture->setTeamId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'statistic[goalkeeper]' => 'Something New',
            'statistic[shotsOnTarget]' => 'Something New',
            'statistic[shotsOffTarget]' => 'Something New',
            'statistic[blockedShots]' => 'Something New',
            'statistic[touches]' => 'Something New',
            'statistic[passAttempts]' => 'Something New',
            'statistic[sussessfulPasses]' => 'Something New',
            'statistic[dribbleAttempts]' => 'Something New',
            'statistic[sussessfulDribbles]' => 'Something New',
            'statistic[crosseAttempts]' => 'Something New',
            'statistic[sussessfulCrosses]' => 'Something New',
            'statistic[tackleAttempts]' => 'Something New',
            'statistic[sussessfulTackles]' => 'Something New',
            'statistic[aerialDuels]' => 'Something New',
            'statistic[possessionLost]' => 'Something New',
            'statistic[clearences]' => 'Something New',
            'statistic[interceptions]' => 'Something New',
            'statistic[dribbledPast]' => 'Something New',
            'statistic[fouls]' => 'Something New',
            'statistic[yellowCards]' => 'Something New',
            'statistic[redCards]' => 'Something New',
            'statistic[punches]' => 'Something New',
            'statistic[saves]' => 'Something New',
            'statistic[savesFromInsideBox]' => 'Something New',
            'statistic[goalConceded]' => 'Something New',
            'statistic[matchId]' => 'Something New',
            'statistic[playerId]' => 'Something New',
            'statistic[teamId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/statistics/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getGoalkeeper());
        self::assertSame('Something New', $fixture[0]->getShotsOnTarget());
        self::assertSame('Something New', $fixture[0]->getShotsOffTarget());
        self::assertSame('Something New', $fixture[0]->getBlockedShots());
        self::assertSame('Something New', $fixture[0]->getTouches());
        self::assertSame('Something New', $fixture[0]->getPassAttempts());
        self::assertSame('Something New', $fixture[0]->getSussessfulPasses());
        self::assertSame('Something New', $fixture[0]->getDribbleAttempts());
        self::assertSame('Something New', $fixture[0]->getSussessfulDribbles());
        self::assertSame('Something New', $fixture[0]->getCrosseAttempts());
        self::assertSame('Something New', $fixture[0]->getSussessfulCrosses());
        self::assertSame('Something New', $fixture[0]->getTackleAttempts());
        self::assertSame('Something New', $fixture[0]->getSussessfulTackles());
        self::assertSame('Something New', $fixture[0]->getAerialDuels());
        self::assertSame('Something New', $fixture[0]->getPossessionLost());
        self::assertSame('Something New', $fixture[0]->getClearences());
        self::assertSame('Something New', $fixture[0]->getInterceptions());
        self::assertSame('Something New', $fixture[0]->getDribbledPast());
        self::assertSame('Something New', $fixture[0]->getFouls());
        self::assertSame('Something New', $fixture[0]->getYellowCards());
        self::assertSame('Something New', $fixture[0]->getRedCards());
        self::assertSame('Something New', $fixture[0]->getPunches());
        self::assertSame('Something New', $fixture[0]->getSaves());
        self::assertSame('Something New', $fixture[0]->getSavesFromInsideBox());
        self::assertSame('Something New', $fixture[0]->getGoalConceded());
        self::assertSame('Something New', $fixture[0]->getMatchId());
        self::assertSame('Something New', $fixture[0]->getPlayerId());
        self::assertSame('Something New', $fixture[0]->getTeamId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistics();
        $fixture->setGoalkeeper('Value');
        $fixture->setShotsOnTarget('Value');
        $fixture->setShotsOffTarget('Value');
        $fixture->setBlockedShots('Value');
        $fixture->setTouches('Value');
        $fixture->setPassAttempts('Value');
        $fixture->setSussessfulPasses('Value');
        $fixture->setDribbleAttempts('Value');
        $fixture->setSussessfulDribbles('Value');
        $fixture->setCrosseAttempts('Value');
        $fixture->setSussessfulCrosses('Value');
        $fixture->setTackleAttempts('Value');
        $fixture->setSussessfulTackles('Value');
        $fixture->setAerialDuels('Value');
        $fixture->setPossessionLost('Value');
        $fixture->setClearences('Value');
        $fixture->setInterceptions('Value');
        $fixture->setDribbledPast('Value');
        $fixture->setFouls('Value');
        $fixture->setYellowCards('Value');
        $fixture->setRedCards('Value');
        $fixture->setPunches('Value');
        $fixture->setSaves('Value');
        $fixture->setSavesFromInsideBox('Value');
        $fixture->setGoalConceded('Value');
        $fixture->setMatchId('Value');
        $fixture->setPlayerId('Value');
        $fixture->setTeamId('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/statistics/');
        self::assertSame(0, $this->repository->count([]));
    }
}
