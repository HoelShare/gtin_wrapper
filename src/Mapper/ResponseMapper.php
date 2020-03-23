<?php declare(strict_types=1);

namespace App\Mapper;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResponseMapper
{
    /**
     * @var MaskMapper
     */
    private $maskMapper;

    /**
     * @var CategoryMapper
     */
    private $categoryMapper;

    public function __construct(MaskMapper $maskMapper, CategoryMapper $categoryMapper)
    {
        $this->maskMapper = $maskMapper;
        $this->categoryMapper = $categoryMapper;
    }

    public function map(array $data): array
    {
        $result = [];

        foreach ($data as $info) {
            $result[$info['name']] = $info['value'];
        }

        if (!isset($result['name']) && !isset($result['fullname'])) {
            throw new NotFoundHttpException();
        }

        if (isset($result['contflag1'])) {
            $result['contents'] = $this->maskMapper->mapContent((int)$result['contflag1']);
        }
        if (isset($result['packflag1'])) {
            $result['packaging'] = $this->maskMapper->mapPack((int)$result['packflag1']);
        }

        if (isset($result['fcat1']) && isset($result['fcat2'])) {
            $mainCategory = (int)$result['fcat1'];

            $result['main_category'] = $this->categoryMapper->mapMainCategory($mainCategory);
            $result['sub_category'] = $this->categoryMapper->mapSubCategory($mainCategory, (int)$result['fcat2']);
        }

        return $result;
    }
}