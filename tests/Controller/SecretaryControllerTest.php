<?php

namespace App\Tests\Controller;

use App\Entity\Secretary;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SecretaryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/secretary/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Secretary::class);

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
        self::assertPageTitleContains('Secretary index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'secretary[genre]' => 'Testing',
            'secretary[name]' => 'Testing',
            'secretary[firstname]' => 'Testing',
            'secretary[adresse]' => 'Testing',
            'secretary[phone]' => 'Testing',
            'secretary[email]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Secretary();
        $fixture->setGenre('My Title');
        $fixture->setName('My Title');
        $fixture->setFirstname('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Secretary');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Secretary();
        $fixture->setGenre('Value');
        $fixture->setName('Value');
        $fixture->setFirstname('Value');
        $fixture->setAdresse('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'secretary[genre]' => 'Something New',
            'secretary[name]' => 'Something New',
            'secretary[firstname]' => 'Something New',
            'secretary[adresse]' => 'Something New',
            'secretary[phone]' => 'Something New',
            'secretary[email]' => 'Something New',
        ]);

        self::assertResponseRedirects('/secretary/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getGenre());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getFirstname());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getEmail());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Secretary();
        $fixture->setGenre('Value');
        $fixture->setName('Value');
        $fixture->setFirstname('Value');
        $fixture->setAdresse('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/secretary/');
        self::assertSame(0, $this->repository->count([]));
    }
}
