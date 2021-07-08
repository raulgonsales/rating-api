<?php declare(strict_types=1);

namespace App\Tests\Controller\Rating;

use App\Entity\Project;
use Doctrine\Persistence\AbstractManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingControllerTest extends WebTestCase
{
    public function testActionStoreGood()
    {
        $client = static::createClient();
        $client->disableReboot();
        
        $container = self::getContainer();
        
        $projectEntity = $this->createMock(Project::class);
        $projectEntity->expects($this->once())->method('getId')->willReturn(65);
        
        $objectRepository = $this->createMock(ObjectRepository::class);
        $objectRepository->expects($this->any())->method('find')->willReturn($projectEntity);
        
        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())->method('persist');
        $objectManager->expects($this->any())->method('flush');
        
        $managerRegistry = $this->createMock(AbstractManagerRegistry::class);
        $managerRegistry->expects($this->any())->method('getRepository')->willReturn($objectRepository);
        $managerRegistry->expects($this->any())->method('getManager')->willReturn($objectManager);
        $container->set('doctrine', $managerRegistry);
        
        $client->request(
            Request::METHOD_PUT,
            '/api/v1/rating/store',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode([
                'projectId' => 65,
                'feedbackOverallRating' => 5,
                'feedbackCommunicationRating' => 4,
                'feedbackQualityRating' => 2,
                'feedbackPricingRating' => 3,
                'feedbackImprovementText' => 'Very good'
            ])
        );
        
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSame(
            '{"message":"Success","data":{"projectId":65}}',
            $client->getResponse()->getContent()
        );
    }

    public function testActionStoreNotExistingProjectIdExceptionThrown()
    {
        $client = static::createClient();
        $client->disableReboot();

        $container = self::getContainer();

        $objectRepository = $this->createMock(ObjectRepository::class);
        $objectRepository->expects($this->any())->method('find')->willReturn(null);

        $managerRegistry = $this->createMock(AbstractManagerRegistry::class);
        $managerRegistry->expects($this->any())->method('getRepository')->willReturn($objectRepository);
        $container->set('doctrine', $managerRegistry);

        $client->request(
            Request::METHOD_PUT,
            '/api/v1/rating/store',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode([
                'projectId' => 65,
                'feedbackOverallRating' => 5,
                'feedbackCommunicationRating' => 4,
                'feedbackQualityRating' => 2,
                'feedbackPricingRating' => 3,
                'feedbackImprovementText' => 'Very good'
            ])
        );

        $this->assertEquals(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());
        $this->assertSame(
            '{"message":"Project with ID 65 not found.","data":{},"errors":["Project with ID 65 not found."]}',
            $client->getResponse()->getContent()
        );
    }

    public function testActionStoreBadRequestCode400Returned()
    {
        $client = static::createClient();
        $client->request(
            Request::METHOD_PUT,
            '/api/v1/rating/store',
            [],
            [],
            [],
            json_encode([
                'projectId' => 1,
                'feedbackOverallRating' => 5,
                'feedbackCommunicationRating' => 4
            ])
        );
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }

    public function testActionStoreMethodNotAllowedCode405Returned()
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/api/v1/rating/store');
        $this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $client->getResponse()->getStatusCode());
    }
}
