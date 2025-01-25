<?php

namespace App\Tests\Controller;

use App\Entity\HistoryRdv;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HistoryRdvControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/history/rdv/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(HistoryRdv::class);

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
        self::assertPageTitleContains('HistoryRdv index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'history_rdv[date]' => 'Testing',
            'history_rdv[horaires]' => 'Testing',
            'history_rdv[motif]' => 'Testing',
            'history_rdv[nomPatient]' => 'Testing',
            'history_rdv[conclusionDuMedecin]' => 'Testing',
            'history_rdv[id_history]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new HistoryRdv();
        $fixture->setDate('My Title');
        $fixture->setHoraires('My Title');
        $fixture->setMotif('My Title');
        $fixture->setNomPatient('My Title');
        $fixture->setConclusionDuMedecin('My Title');
        $fixture->setId_history('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('HistoryRdv');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new HistoryRdv();
        $fixture->setDate('Value');
        $fixture->setHoraires('Value');
        $fixture->setMotif('Value');
        $fixture->setNomPatient('Value');
        $fixture->setConclusionDuMedecin('Value');
        $fixture->setId_history('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'history_rdv[date]' => 'Something New',
            'history_rdv[horaires]' => 'Something New',
            'history_rdv[motif]' => 'Something New',
            'history_rdv[nomPatient]' => 'Something New',
            'history_rdv[conclusionDuMedecin]' => 'Something New',
            'history_rdv[id_history]' => 'Something New',
        ]);

        self::assertResponseRedirects('/history/rdv/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getHoraires());
        self::assertSame('Something New', $fixture[0]->getMotif());
        self::assertSame('Something New', $fixture[0]->getNomPatient());
        self::assertSame('Something New', $fixture[0]->getConclusionDuMedecin());
        self::assertSame('Something New', $fixture[0]->getId_history());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new HistoryRdv();
        $fixture->setDate('Value');
        $fixture->setHoraires('Value');
        $fixture->setMotif('Value');
        $fixture->setNomPatient('Value');
        $fixture->setConclusionDuMedecin('Value');
        $fixture->setId_history('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/history/rdv/');
        self::assertSame(0, $this->repository->count([]));
    }
}
