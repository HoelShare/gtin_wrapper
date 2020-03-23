<?php declare(strict_types=1);

namespace App\Controller;

use App\Mapper\CategoryMapper;
use App\Mapper\MaskMapper;
use App\Mapper\ResponseMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use function Couchbase\fastlzCompress;

class GtinController extends AbstractController
{
    private const FIELD_NAMES = ['ean', 'name', 'asin', 'fullname', 'descr', 'name_en', 'fullname_en', 'vendor', 'contflag1', 'packflag1', 'fcat1', 'fcat2'];

    /**
     * @var ResponseMapper
     */
    private $responseMapper;

    public function __construct(ResponseMapper $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    /**
     * @Route(name="getData", path="/{gtin}")
     */
    public function getData(string $gtin): Response
    {
        $content = file_get_contents(sprintf('http://opengtindb.org/index.php?cmd=ean1&ean=%s&sq=1', $gtin));
        $crawler = new Crawler($content);
        $nodes = $crawler->filter('form[action="https://opengtindb.org/index.php"] > input[type="HIDDEN"]');

        $data = [];

        foreach ($nodes as $node) {
            $nodeData = [];
            /** @var \DOMAttr $attribute */
            foreach ($node->attributes as $attribute) {
                $nodeData[$attribute->name] = $attribute->value;
            }

            if (!in_array($nodeData['name'], self::FIELD_NAMES, true)) {
                continue;
            }

            $data[] = $nodeData;
        }

        try {
            return new JsonResponse($this->responseMapper->map($data));
        } catch (NotFoundHttpException $exception) {
            return new JsonResponse(['error' => 'not found'], 404);
        }
    }
}