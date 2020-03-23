<?php declare(strict_types=1);

namespace App\Mapper;

class CategoryMapper
{
    private const MAIN_CATEGORIES = ['Baby, Kind', 'Backwaren', 'Brotaufstriche', 'Dessert, Nachtisch',
        'Eier', 'Elektrisch', 'Elektronische Artikel', 'Fertiggerichte',
        'Fleisch, Fisch', 'Früchte, Obst', 'Gemüse', 'Getränke, Alkohol',
        'Haushalt, Büro', 'Kochzutaten', 'Konditorei, Zuckerwaren',
        'Kosmetische Mittel', 'Milchprodukte', 'Präparate', 'Raucherwaren',
        'Sojaprodukte', 'Süsswaren, Snacks', 'Teigwaren, Getreideprodukte',
        'Tierbedarf', 'Waschen, Reinigen', 'Zusatzstoffe', 'Haus, Hof und Freizeit',];
    
    private const SUB_CATEGORIES = [
        ['Ausstattung','Babygetränke','Babynahrung','Gesundheit, Pflege','Kleider, Textilien','Spiele Lernen','Wickel'],
        ['Backmischungen','Backzutaten','Brotarten','Dauerbackwaren, Zwieback','Frischbackwaren','Gebäck, Panettone', 'Hefe','Kuchen, Cakes','Teig'],
        ['Honig','Konfitüren, Marmeladen','verschiedene'],
        ['Creme','Pudding','Speiseeis'],
        ['Eier'],
        ['Anschluss-und Verbrauchsmaterial','Batterien','Licht','Netzteile, Ladegeräte'],
        ['Computer','Fotografie','HIFI','Massenspeichermedien','PDA','TV, Fernsehen','Telefon','Uhren','Video','DVD','BD (Blu-ray)'],
        ['Andere','Asia Gerichte','Bouillon, Brühe','Fleischerzeugnisse','Gericht, Menü','Kartoffelprodukte','Pasta', 'Pizza','Salat','Sandwich','Saucen','Suppen','Tiefgekühltes, Tiefkühlkost'],
        ['Fisch','Fischkonserven','Fleischkonserven','Frischfleisch','Geflügel','Meeresfrüchte','Trockenfleisch, Salami', 'Wurstwaren'],
        ['Exotische Früchte','Früchte, Obst','Nüsse','Obstkonserven','Trockenfrüchte','kandierte Früchte'],
        ['Antipasti','Essigkonserven','Gemüse','Gemüsekonserven','Salat','Trockengemüse'],
        ['Alcopops','Bier','Energy Drinks','Frucht-und Gemüsesäfte','Instantgetränke','Kaffee','Kakao,Schokoladen', 'Limonaden','Mineralwasser','Sirup','Spirituosen','Tee','Wein/Sekt/Champagner'],
        ['Bücher allgemein','Fachbücher','Literatur','Bügeln, Textilpflege','Dekoration','Essen','Garten', 'Kleider, Textilien','Küche','Küchen-, Haushaltgeräte','Mercerie','Papeterie', 'Zeitungen, Zeitschriften allgemein','Fachzeitungen, -zeitschriften','Schreib- und Zeichengeräte'],
        ['Backpulver','Essig','Frische Gewürze','Gelatine','Gewürze','Mehl','Öl, Fette','Salz', 'Senf, Mayonnaise, Püree, Cremen','Stärkearten'],
        ['Kuchendekoration','Marzipan','Süßstoffe','Zucker'],
        ['Badezusätze','Gesichtspflege','Haarpflege','Körperpflege','Make-up Artikel','Monatshygiene','Nagel, Fusspflege', 'Parfüm','Pflaster, Watte','Rasierprodukte','Schwangerschaftstest','Sonnen-, Insektenschutz','Toilettenartikel', 'Verhütung','Zahnpflege'],
        ['Butter, Margarine','Joghurt','Käse','Milch','Milchgetränke','Quark','Rahm, Rahmprodukte'],
        ['Calcium','Magnesium','Medikamente','Sonstige','Vitamine','kombinierte Präparate'],
        ['Tabak','Zigaretten','Zigarren','Zubehör'],
        ['Sojamilch','Sojasaucen','Tofu','sonstiges'],
        ['Bisquits, Kekse, Konfekt','Bonbons','Chips','Energiespender','Fruchtgummi','Getreide, Schokoriegel, Waffeln','Kaugummi', 'Schokolade','salzige Snacks'],
        ['Frühstücksflocken','Getreide','Teigwaren'],
        ['Hunde','Katzen','Nager','Sonstige'],
        ['Abwaschen','Boden-und Teppichreiniger','Entkalker','Entsorgen','Fleckenreiniger','Glas-und Festerreiniger', 'Küchenreiniger','Lufterfrischer','Putzgeräte und Zubehör','Putzmittel','Schuhpflege','Spezialreiniger', 'WC- und Bad Reiniger','Waschmittel','Wohnzimmerreiniger'],
        ['Zusatzstoffe'],
        ['Baumaterialien','Farbe','Werkzeuge','Pflanzenmittel','Pflanzen','Modellbau','Sportgeräte','Sonstige','Spielzeug/Spiele']
    ];

    public function mapMainCategory(int $category): ?string
    {
        if (!$category) {
            return null;
        }

        return self::MAIN_CATEGORIES[$category - 1];
    }

    public function mapSubCategory(int $mainCategoryId, int $subCategoryId): ?string
    {
        if (!$mainCategoryId || !$subCategoryId) {
            return null;
        }

        return self::SUB_CATEGORIES[$mainCategoryId - 1][$subCategoryId - 1];
    }
}