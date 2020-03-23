<?php declare(strict_types=1);

namespace App\Mapper;

class MaskMapper
{
    private const CONTENT_MASKS = [
        1 => 'laktosefrei',
        2 => 'koffeeinfrei',
        4 => 'diätetisches Lebensmittel',
        8 => 'glutenfrei',
        16 => 'fruktosefrei',
        32 => 'BIO-Lebensmittel nach EU-Ökoverordnung',
        64 => 'fair gehandeltes Produkt nach FAIRTRADE™-Standard',
        128 => 'vegetarisch',
        256 => 'vegan',
        512 => 'Warnung vor Mikroplastik',
        1024 => 'Warnung vor Mineralöl',
        2048 => 'Warnung vor Nikotin',
    ];

    private const PACK_MASKS = [
        1 => 'die Verpackung besteht überwiegend aus Plastik',
        2 => 'die Verpackung besteht überwiegend aus Verbundmaterial',
        4 => 'die Verpackung besteht überwiegend aus Papier/Pappe',
        8 => 'die Verpackung besteht überwiegend aus Glas/Keramik/Ton',
        16 => 'die Verpackung besteht überwiegend aus Metall',
        32 => 'ist unverpackt',
        64 => 'die Verpackung ist komplett frei von Plastik',
        128 => 'Artikel ist übertrieben stark verpackt',
        256 => 'Artikel ist angemessen sparsam verpackt',
        512 => 'Pfandsystem / Mehrwegverpackung',
    ];

    /**
     * @return string[]
     */
    public function mapPack(int $value): array
    {
        return $this->map($value, self::PACK_MASKS);
    }

    /**
     * @return string[]
     */
    public function mapContent(int $value): array
    {
        return $this->map($value, self::CONTENT_MASKS);
    }

    private function map(int $value, array $masks): array {
        $values = [];

        foreach ($masks as $mask => $info) {
            if (!($mask & $value)) {
                continue;
            }

            $values[] = $info;
        }

        return $values;
    }
}