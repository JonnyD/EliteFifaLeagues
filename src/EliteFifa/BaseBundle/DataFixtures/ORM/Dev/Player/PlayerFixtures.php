<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Player;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\TeamBundle\DataFixtures\ORM\Team\TeamFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EliteFifa\PlayerBundle\Entity\Player;
use EliteFifa\TeamBundle\Entity\Team;

class PlayerFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @var ObjectManager $manager
     */
    private $manager;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $liverpool = $this->getTeamByName('Liverpool');
        $realMadrid = $this->getTeamByName("Real Madrid");
        $borussiaDortmund = $this->getTeamByName("Borussia Dortmund");
        $chelsea = $this->getTeamByName("Chelsea");
        $barcelona = $this->getTeamByName("Barcelona");
        $arsenal = $this->getTeamByName("Arsenal");
        $manchesterUnited = $this->getTeamByName("Manchester United");
        $bayernMunich = $this->getTeamByName("Bayern Munich");
        $milan = $this->getTeamByName("Milan");
        $athleticoMadrid = $this->getTeamByName("Athletico Madrid");
        $tottenhamHotspur = $this->getTeamByName("Tottenham Hotspur");
        $roma = $this->getTeamByName("Roma");
        $inter = $this->getTeamByName("Inter");
        $psg = $this->getTeamByName("Paris Saint-Germain");
        $juventus = $this->getTeamByName("Juventus");
        $manchesterCity = $this->getTeamByName("Manchester City");
        $everton = $this->getTeamByName("Everton");
        $southampton = $this->getTeamByName("Southampton");
        $schalke = $this->getTeamByName("FC Schalke");
        $valencia = $this->getTeamByName("Valencia");
        $napoli = $this->getTeamByName("Napoli");
        $lyon = $this->getTeamByName("Lyon");
        $monaco = $this->getTeamByName("AS Monaco");
        $sportLisbon = $this->getTeamByName("Sport Lisbon");
        $ajax = $this->getTeamByName("Ajax");
        $porto = $this->getTeamByName("FC Porto");
        $sunderland = $this->getTeamByName("Sunderland");
        $bayerLeverkusen = $this->getTeamByName("Bayer Leverkusen");
        $galatasary = $this->getTeamByName("Galatasaray");
        $sportingCp = $this->getTeamByName("Sporting CP");
        $lazio = $this->getTeamByName("Lazio");
        $astonVilla = $this->getTeamByName("Aston Villa");
        $newcastleUnited = $this->getTeamByName("Newcastle United");
        $hamburgerSV = $this->getTeamByName("Hamburger SV");
        $realSociedad = $this->getTeamByName("Real Sociedad");
        $sevilla = $this->getTeamByName("Sevilla");

        $this->createPlayer("Luis", "Suarez", $liverpool);
        $this->createPlayer("Daniel", "Sturridge", $liverpool);
        $this->createPlayer("Raheem", "Sterling", $liverpool);
        $this->createPlayer("Philipe", "Coutimho", $liverpool);

        $this->createPlayer("Karim", "Benzema", $realMadrid);
        $this->createPlayer("Gareth", "Bale", $realMadrid);
        $this->createPlayer("Angel", "Di Maria", $realMadrid);
        $this->createPlayer("Luka", "Modric", $realMadrid);

        $this->createPlayer("Robert", "Lewandowski", $borussiaDortmund);
        $this->createPlayer("Henrikh", "Mkhitaryan", $borussiaDortmund);
        $this->createPlayer("Jonas", "Hofmann", $borussiaDortmund);
        $this->createPlayer("Marco", "Reus", $borussiaDortmund);

        $this->createPlayer("Demba", "Ba", $chelsea);
        $this->createPlayer("Andre", "Schurrle", $chelsea);
        $this->createPlayer("Eden", "Hazard", $chelsea);
        $this->createPlayer("Fernando", "Torres", $chelsea);

        $this->createPlayer("", "Neymar", $barcelona);
        $this->createPlayer("Lioni", "Messi", $barcelona);
        $this->createPlayer("", "Pedro", $barcelona);
        $this->createPlayer("Andreis", "Iniesta", $barcelona);

        $this->createPlayer("Mario", "Mandzukic", $bayernMunich);
        $this->createPlayer("Mario", "Gotze", $bayernMunich);
        $this->createPlayer("Arjen", "Robben", $bayernMunich);
        $this->createPlayer("Franck", "Ribery", $bayernMunich);

        $this->createPlayer("Olivier", "Giroud", $arsenal);
        $this->createPlayer("Santi", "Cazorla", $arsenal);
        $this->createPlayer("Lukas", "Podolski", $arsenal);
        $this->createPlayer("Kim", "Kallstrom", $arsenal);

        $this->createPlayer("Javier", "Hernandez", $manchesterUnited);
        $this->createPlayer("Juan", "Mata", $manchesterUnited);
        $this->createPlayer("Shinji", "Kagawa", $manchesterUnited);
        $this->createPlayer("Wayne", "Rooney", $manchesterUnited);

        $this->createPlayer("Mario", "Balotelli", $milan);
        $this->createPlayer("", "Kaka", $milan);
        $this->createPlayer("Adel", "Taarabt", $milan);
        $this->createPlayer("Andrea", "Poli", $milan);

        $this->createPlayer("Diego", "Costa", $athleticoMadrid);
        $this->createPlayer("David", "Villa", $athleticoMadrid);
        $this->createPlayer("", "Diego", $athleticoMadrid);
        $this->createPlayer("", "Koke", $athleticoMadrid);

        $this->createPlayer("Harry", "Kane", $tottenhamHotspur);
        $this->createPlayer("Emamanuel", "Adebayor", $tottenhamHotspur);
        $this->createPlayer("Aaron", "Lennon", $tottenhamHotspur);
        $this->createPlayer("Christian", "Eriksen", $tottenhamHotspur);

        $this->createPlayer("Francesco", "Totti", $roma);
        $this->createPlayer("", "Gervinho", $roma);
        $this->createPlayer("Adem", "Ljajic", $roma);
        $this->createPlayer("", "Taddei", $roma);

        $this->createPlayer("Mauro", "Icardi", $inter);
        $this->createPlayer("Rodrigo", "Palacio", $inter);
        $this->createPlayer("Mateo", "Kovacic", $inter);
        $this->createPlayer("", "Hernanes", $inter);

        $this->createPlayer("A", "Lavezzi", $psg);
        $this->createPlayer("A", "Cavani", $psg);
        $this->createPlayer("A", "Lucas", $psg);
        $this->createPlayer("A", "Matuidi", $psg);

        $this->createPlayer("A", "Llorente", $juventus);
        $this->createPlayer("A", "Giovinco", $juventus);
        $this->createPlayer("A", "Pogba", $juventus);
        $this->createPlayer("A", "Marchisio", $juventus);

        $this->createPlayer("A", "Aguero", $manchesterCity);
        $this->createPlayer("A", "Negredo", $manchesterCity);
        $this->createPlayer("A", "Nasri", $manchesterCity);
        $this->createPlayer("A", "Fernandinho", $manchesterCity);

        $this->createPlayer("A", "Lukaku", $everton);
        $this->createPlayer("A", "Mirallas", $everton);
        $this->createPlayer("A", "McGeady", $everton);
        $this->createPlayer("A", "Deulofeu", $everton);

        $this->createPlayer("A", "Kane", $tottenhamHotspur);
        $this->createPlayer("A", "Adebayor", $tottenhamHotspur);
        $this->createPlayer("A", "Eriksen", $tottenhamHotspur);
        $this->createPlayer("A", "Lennon", $tottenhamHotspur);

        $this->createPlayer("A", "Totti", $roma);
        $this->createPlayer("A", "Ljajic", $roma);
        $this->createPlayer("A", "Gervinho", $roma);
        $this->createPlayer("A", "Taddei", $roma);

        $this->createPlayer("A", "Lallana", $southampton);
        $this->createPlayer("A", "Lambert", $southampton);
        $this->createPlayer("A", "Davis", $southampton);
        $this->createPlayer("A", "Ramirez", $southampton);

        $this->createPlayer("A", "Huntelaar", $schalke);
        $this->createPlayer("A", "Meyer", $schalke);
        $this->createPlayer("A", "Goretzke", $schalke);
        $this->createPlayer("A", "Obasi", $schalke);

        $this->createPlayer("A", "Alcacer", $valencia);
        $this->createPlayer("A", "Vargas", $valencia);
        $this->createPlayer("A", "Cartabia", $valencia);
        $this->createPlayer("A", "Feghouli", $valencia);

        $this->createPlayer("A", "Higuain", $napoli);
        $this->createPlayer("A", "Pandev", $napoli);
        $this->createPlayer("A", "Callejon", $napoli);
        $this->createPlayer("A", "Insigne", $napoli);

        $this->createPlayer("A", "Gomis", $lyon);
        $this->createPlayer("A", "Lacazette", $lyon);
        $this->createPlayer("A", "Malbranque", $lyon);
        $this->createPlayer("A", "Ferri", $lyon);

        $this->createPlayer("A", "Germain", $monaco);
        $this->createPlayer("A", "Berbatov", $monaco);
        $this->createPlayer("A", "Rodriguez", $monaco);
        $this->createPlayer("A", "Moutinho", $monaco);

        $this->createPlayer("A", "Bojan", $ajax);
        $this->createPlayer("A", "Schone", $ajax);
        $this->createPlayer("A", "Sigborsson", $ajax);
        $this->createPlayer("A", "Serero", $ajax);

        $this->createPlayer("A", "Varela", $porto);
        $this->createPlayer("A", "Martinez", $porto);
        $this->createPlayer("A", "Quaresma", $porto);
        $this->createPlayer("A", "Eduardo", $porto);

        $this->createPlayer("A", "Wickham", $sunderland);
        $this->createPlayer("A", "Borini", $sunderland);
        $this->createPlayer("A", "Larsson", $sunderland);
        $this->createPlayer("A", "Johnson", $sunderland);

        $this->createPlayer("A", "Kiebling", $bayerLeverkusen);
        $this->createPlayer("A", "Son", $bayerLeverkusen);
        $this->createPlayer("A", "Can", $bayerLeverkusen);
        $this->createPlayer("A", "Brandt", $bayerLeverkusen);

        $this->createPlayer("A", "Drogba", $galatasary);
        $this->createPlayer("A", "Yilmaz", $galatasary);
        $this->createPlayer("A", "Sneijder", $galatasary);
        $this->createPlayer("A", "Melo", $galatasary);

        $this->createPlayer("A", "Capel", $sportingCp);
        $this->createPlayer("A", "Slimani", $sportingCp);
        $this->createPlayer("A", "Mane", $sportingCp);
        $this->createPlayer("A", "Silva", $sportingCp);

        $this->createPlayer("A", "Mauri", $lazio);
        $this->createPlayer("A", "Anderson", $lazio);
        $this->createPlayer("A", "Candreva", $lazio);
        $this->createPlayer("A", "Onazi", $lazio);

        $this->createPlayer("A", "Holt", $astonVilla);
        $this->createPlayer("A", "Agbonlahor", $astonVilla);
        $this->createPlayer("A", "Delph", $astonVilla);
        $this->createPlayer("A", "Westwood", $astonVilla);

        $this->createPlayer("A", "Cisse", $newcastleUnited);
        $this->createPlayer("A", "Remy", $newcastleUnited);
        $this->createPlayer("A", "Gouffran", $newcastleUnited);
        $this->createPlayer("A", "Gosling", $newcastleUnited);

        $this->createPlayer("A", "Zoua", $hamburgerSV);
        $this->createPlayer("A", "Jiracek", $hamburgerSV);
        $this->createPlayer("A", "Calhanc", $hamburgerSV);
        $this->createPlayer("A", "Arslan", $hamburgerSV);

        $this->createPlayer("A", "Castro", $realSociedad);
        $this->createPlayer("A", "Vela", $realSociedad);
        $this->createPlayer("A", "Agirretxe", $realSociedad);
        $this->createPlayer("A", "Canale", $realSociedad);

        $this->createPlayer("A", "Gameiro", $sevilla);
        $this->createPlayer("A", "Rakitic", $sevilla);
        $this->createPlayer("A", "Vitolo", $sevilla);
        $this->createPlayer("A", "Bacca", $sevilla);

        $manager->flush();
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $team
     */
    private function createPlayer($firstName, $lastName, $team)
    {
        $player = new Player();
        $player->setFirstName($firstName);
        $player->setLastName($lastName);
        $player->setTeam($team);

        $this->manager->persist($player);

        $this->addReference('player.'.$player->getName(), $player);
    }

    /**
     * @param $name
     * @return Team
     */
    private function getTeamByName($name)
    {
        return $this->getReference('team.'.$name);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            TeamFixtures::class
        ];
    }
}