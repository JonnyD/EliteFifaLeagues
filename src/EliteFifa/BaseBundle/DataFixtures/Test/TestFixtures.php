<?php

namespace EliteFifa\Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\Bundle\Entity\Stadium;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Entity\Role;
use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Entity\Participant;
use Symfony\Component\Routing\Matcher\ApacheUrlMatcher;

class TestFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;
    private $objectManager;
    private $teamManager;
    private $userManager;
    private $stadiumManager;
    private $roleManager;
    private $playerManager;
    private $associationManager;
    private $competitionManager;
    private $seasonManager;
    private $participantManager;
    private $matchManager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->objectManager = $manager;
        $this->roleManager = $this->container->get("elite_fifa.role_manager");
        $this->teamManager = $this->container->get("elite_fifa.team_manager");
        $this->userManager = $this->container->get("elite_fifa.user_manager");
        $this->stadiumManager = $this->container->get("elite_fifa.stadium_manager");
        $this->playerManager = $this->container->get("elite_fifa.player_manager");
        $this->associationManager = $this->container->get("elite_fifa.association_manager");
        $this->competitionManager = $this->container->get("elite_fifa.competition_manager");
        $this->seasonManager = $this->container->get("elite_fifa.season_manager");
        $this->participantManager = $this->container->get("elite_fifa.participant_manager");
        $this->matchManager = $this->container->get("elite_fifa.match_manager");

        $this->createUsers();
        $this->createStadiums();
        $this->createTeams();
        $this->createAssociations();
        $this->createCompetitions();
        $this->createSeasons();
        $this->createMatches();
    }

    private function createUsers()
    {
        $userRole = $this->createRole("user", "ROLE_USER");

        for ($i = 1; $i <= 36; $i++) {
            $username = "user".$i;
            $email = $username."@email.com";
            $password = "pass".$i;

            $this->createUser($username, $email, $password, $userRole);
        }

        $this->objectManager->flush();
    }

    private function createStadiums()
    {
        $this->createStadium("Anfield");
        $this->createStadium("Santiago Bernabéu");
        $this->createStadium("Signal Iduna Park");
        $this->createStadium("Stamford Bridge");
        $this->createStadium("Camp Nou");
        $this->createStadium("Emirates");
        $this->createStadium("Old Trafford");
        $this->createStadium("Allianz Arena");
        $this->createStadium("San Siro");
        $this->createStadium("Estadio Vicente Calderon");
        $this->createStadium("White Hart Lane");
        $this->createStadium("Stadio Olimpico");
        $this->createStadium("Parc des Princes");
        $this->createStadium("Juventus Stadium");
        $this->createStadium("Etihad");
        $this->createStadium("Goodison Park");
        $this->createStadium("Molton Road");
        $this->createStadium("Veltins-Arena");
        $this->createStadium("Mestalla");
        $this->createStadium("Stadion Olympik");
        $this->createStadium("Stade Gerland");
        $this->createStadium("Euro Arena");
        $this->createStadium("Waldstadion");
        $this->createStadium("Amsterdam ArenA");
        $this->createStadium("Estadio de las Artes");
        $this->createStadium("Eastpoint Arena");
        $this->createStadium("Stade Municipal");
        $this->createStadium("Forest Park Stadium");
        $this->createStadium("St James' Park");
        $this->createStadium("Imtech Arena");
        $this->createStadium("O Dromo");
        $this->createStadium("El Libertador");

        $this->objectManager->flush();
    }

    private function createTeams()
    {
        $liverpool = $this->createTeam("Liverpool", "user1", "Anfield", 80);
        $this->createPlayer("Luis", "Suarez", $liverpool);
        $this->createPlayer("Daniel", "Sturridge", $liverpool);
        $this->createPlayer("Raheem", "Sterling", $liverpool);
        $this->createPlayer("Philipe", "Coutimho", $liverpool);

        $realMadrid= $this->createTeam("Real Madrid", "user2", "Santiago Bernabéu", 84);
        $this->createPlayer("Karim", "Benzema", $realMadrid);
        $this->createPlayer("Gareth", "Bale", $realMadrid);
        $this->createPlayer("Angel", "Di Maria", $realMadrid);
        $this->createPlayer("Luka", "Modric", $realMadrid);

        $borussiaDortmund= $this->createTeam("Borussia Dortmund", "user3", "Signal Iduna Park", 81);
        $this->createPlayer("Robert", "Lewandowski", $borussiaDortmund);
        $this->createPlayer("Henrikh", "Mkhitaryan", $borussiaDortmund);
        $this->createPlayer("Jonas", "Hofmann", $borussiaDortmund);
        $this->createPlayer("Marco", "Reus", $borussiaDortmund);

        $chelsea= $this->createTeam("Chelsea", "user4", "Stamford Bridge", 82);
        $this->createPlayer("Demba", "Ba", $chelsea);
        $this->createPlayer("Andre", "Schurrle", $chelsea);
        $this->createPlayer("Eden", "Hazard", $chelsea);
        $this->createPlayer("Fernando", "Torres", $chelsea);

        $barcelona= $this->createTeam("Barcelona", "user5", "Camp Nou", 84);
        $this->createPlayer("", "Neymar", $barcelona);
        $this->createPlayer("Lioni", "Messi", $barcelona);
        $this->createPlayer("", "Pedro", $barcelona);
        $this->createPlayer("Andreis", "Iniesta", $barcelona);

        $arsenal= $this->createTeam("Arsenal", "user6", "Emirates", 80);
        $this->createPlayer("Olivier", "Giroud", $arsenal);
        $this->createPlayer("Santi", "Cazorla", $arsenal);
        $this->createPlayer("Lukas", "Podolski", $arsenal);
        $this->createPlayer("Kim", "Kallstrom", $arsenal);

        $manchesterUnited= $this->createTeam("Manchester United", "user7", "Old Trafford", 82);
        $this->createPlayer("Javier", "Hernandez", $manchesterUnited);
        $this->createPlayer("Juan", "Mata", $manchesterUnited);
        $this->createPlayer("Shinji", "Kagawa", $manchesterUnited);
        $this->createPlayer("Wayne", "Rooney", $manchesterUnited);

        $bayernMunich= $this->createTeam("Bayern Munich", "user8", "Allianz Arena", 84);
        $this->createPlayer("Mario", "Mandzukic", $bayernMunich);
        $this->createPlayer("Mario", "Gotze", $bayernMunich);
        $this->createPlayer("Arjen", "Robben", $bayernMunich);
        $this->createPlayer("Franck", "Ribery", $bayernMunich);

        $milan= $this->createTeam("Milan", "user9", "San Siro", 78);
        $this->createPlayer("Mario", "Balotelli", $milan);
        $this->createPlayer("", "Kaka", $milan);
        $this->createPlayer("Adel", "Taarabt", $milan);
        $this->createPlayer("Andrea", "Poli", $milan);

        $athleticoMadrid= $this->createTeam("Athletico Madrid", "user10", "Estadio Vicente Calderon", 81);
        $this->createPlayer("Diego", "Costa", $athleticoMadrid);
        $this->createPlayer("David", "Villa", $athleticoMadrid);
        $this->createPlayer("", "Diego", $athleticoMadrid);
        $this->createPlayer("", "Koke", $athleticoMadrid);

        $tottenhamHotspur= $this->createTeam("Tottenham Hotspur", "user11", "White Hart Lane", 80);
        $this->createPlayer("Harry", "Kane", $tottenhamHotspur);
        $this->createPlayer("Emamanuel", "Adebayor", $tottenhamHotspur);
        $this->createPlayer("Aaron", "Lennon", $tottenhamHotspur);
        $this->createPlayer("Christian", "Eriksen", $tottenhamHotspur);

        $roma= $this->createTeam("Roma", "user12", "Stadio Olimpico", 79);
        $this->createPlayer("Francesco", "Totti", $roma);
        $this->createPlayer("", "Gervinho", $roma);
        $this->createPlayer("Adem", "Ljajic", $roma);
        $this->createPlayer("", "Taddei", $roma);

        $inter= $this->createTeam("Inter", "user13", "San Siro", 78);
        $this->createPlayer("Mauro", "Icardi", $inter);
        $this->createPlayer("Rodrigo", "Palacio", $inter);
        $this->createPlayer("Mateo", "Kovacic", $inter);
        $this->createPlayer("", "Hernanes", $inter);

        $psg= $this->createTeam("Paris Saint-Germain", "user14", "Parc des Princes", 82);
        $this->createPlayer("A", "Lavezzi", $psg);
        $this->createPlayer("A", "Cavani", $psg);
        $this->createPlayer("A", "Lucas", $psg);
        $this->createPlayer("A", "Matuidi", $psg);

        $juventus= $this->createTeam("Juventus", "user15", "Juventus Stadium", 81);
        $this->createPlayer("A", "Llorente", $juventus);
        $this->createPlayer("A", "Giovinco", $juventus);
        $this->createPlayer("A", "Pogba", $juventus);
        $this->createPlayer("A", "Marchisio", $juventus);

        $manchesterCity= $this->createTeam("Manchester City", "user16", "Etihad", 83);
        $this->createPlayer("A", "Aguero", $manchesterCity);
        $this->createPlayer("A", "Negredo", $manchesterCity);
        $this->createPlayer("A", "Nasri", $manchesterCity);
        $this->createPlayer("A", "Fernandinho", $manchesterCity);

        $everton= $this->createTeam("Everton", "user17", "Goodison Park", 78);
        $this->createPlayer("A", "Lukaku", $everton);
        $this->createPlayer("A", "Mirallas", $everton);
        $this->createPlayer("A", "McGeady", $everton);
        $this->createPlayer("A", "Deulofeu", $everton);

        $southampton= $this->createTeam("Southampton", "user18", "Molton Road", 75);
        $this->createPlayer("A", "Lallana", $southampton);
        $this->createPlayer("A", "Lambert", $southampton);
        $this->createPlayer("A", "Davis", $southampton);
        $this->createPlayer("A", "Ramirez", $southampton);

        $schalke= $this->createTeam("FC Schalke", "user19", "Veltins-Arena", 77);
        $this->createPlayer("A", "Huntelaar", $schalke);
        $this->createPlayer("A", "Meyer", $schalke);
        $this->createPlayer("A", "Goretzke", $schalke);
        $this->createPlayer("A", "Obasi", $schalke);

        $valencia= $this->createTeam("Valencia", "user20", "Mestalla", 77);
        $this->createPlayer("A", "Alcacer", $valencia);
        $this->createPlayer("A", "Vargas", $valencia);
        $this->createPlayer("A", "Cartabia", $valencia);
        $this->createPlayer("A", "Feghouli", $valencia);

        $napoli= $this->createTeam("Napoli", "user21", "Stadion Olympik", 78);
        $this->createPlayer("A", "Higuain", $napoli);
        $this->createPlayer("A", "Pandev", $napoli);
        $this->createPlayer("A", "Callejon", $napoli);
        $this->createPlayer("A", "Insigne", $napoli);

        $lyon= $this->createTeam("Lyon", "user22", "Stade Gerland", 75);
        $this->createPlayer("A", "Gomis", $lyon);
        $this->createPlayer("A", "Lacazette", $lyon);
        $this->createPlayer("A", "Malbranque", $lyon);
        $this->createPlayer("A", "Ferri", $lyon);

        $monaco= $this->createTeam("AS Monaco", "user23", "Euro Arena", 77);
        $this->createPlayer("A", "Germain", $monaco);
        $this->createPlayer("A", "Berbatov", $monaco);
        $this->createPlayer("A", "Rodriguez", $monaco);
        $this->createPlayer("A", "Moutinho", $monaco);

        $this->createTeam("Sport Lisbon", "user24", "Waldstadion", 77);

        $ajax= $this->createTeam("Ajax", "user25", "Amsterdam ArenA", 74);
        $this->createPlayer("A", "Bojan", $ajax);
        $this->createPlayer("A", "Schone", $ajax);
        $this->createPlayer("A", "Sigborsson", $ajax);
        $this->createPlayer("A", "Serero", $ajax);

        $porto= $this->createTeam("FC Porto", "user26", "Estadio de las Artes", 77);
        $this->createPlayer("A", "Varela", $porto);
        $this->createPlayer("A", "Martinez", $porto);
        $this->createPlayer("A", "Quaresma", $porto);
        $this->createPlayer("A", "Eduardo", $porto);

        $sunderland= $this->createTeam("Sunderland", "user27", "Eastpoint Arena", 74);
        $this->createPlayer("A", "Wickham", $sunderland);
        $this->createPlayer("A", "Borini", $sunderland);
        $this->createPlayer("A", "Larsson", $sunderland);
        $this->createPlayer("A", "Johnson", $sunderland);

        $bayerLeverkusen= $this->createTeam("Bayer Leverkusen", "user28", "Stade Municipal", 77);
        $this->createPlayer("A", "Kiebling", $bayerLeverkusen);
        $this->createPlayer("A", "Son", $bayerLeverkusen);
        $this->createPlayer("A", "Can", $bayerLeverkusen);
        $this->createPlayer("A", "Brandt", $bayerLeverkusen);

        $galatasary= $this->createTeam("Galatasaray", "user29", "Waldstadion", 78);
        $this->createPlayer("A", "Drogba", $galatasary);
        $this->createPlayer("A", "Yilmaz", $galatasary);
        $this->createPlayer("A", "Sneijder", $galatasary);
        $this->createPlayer("A", "Melo", $galatasary);

        $sportingCp= $this->createTeam("Sporting CP", "user30", "Waldstadion", 75);
        $this->createPlayer("A", "Capel", $sportingCp);
        $this->createPlayer("A", "Slimani", $sportingCp);
        $this->createPlayer("A", "Mane", $sportingCp);
        $this->createPlayer("A", "Silva", $sportingCp);

        $lazio= $this->createTeam("Lazio", "user31", "Stadio Olimpico", 78);
        $this->createPlayer("A", "Mauri", $lazio);
        $this->createPlayer("A", "Anderson", $lazio);
        $this->createPlayer("A", "Candreva", $lazio);
        $this->createPlayer("A", "Onazi", $lazio);

        $astonVilla= $this->createTeam("Aston Villa", "user32", "Forest Park Stadium", 74);
        $this->createPlayer("A", "Holt", $astonVilla);
        $this->createPlayer("A", "Agbonlahor", $astonVilla);
        $this->createPlayer("A", "Delph", $astonVilla);
        $this->createPlayer("A", "Westwood", $astonVilla);

        $newcastleUnited= $this->createTeam("Newcastle United", "user33", "St James' Park", 76);
        $this->createPlayer("A", "Cisse", $newcastleUnited);
        $this->createPlayer("A", "Remy", $newcastleUnited);
        $this->createPlayer("A", "Gouffran", $newcastleUnited);
        $this->createPlayer("A", "Gosling", $newcastleUnited);

        $hamburgerSV= $this->createTeam("Hamburger SV", "user34", "Imtech Arena", 75);
        $this->createPlayer("A", "Zoua", $hamburgerSV);
        $this->createPlayer("A", "Jiracek", $hamburgerSV);
        $this->createPlayer("A", "Calhanc", $hamburgerSV);
        $this->createPlayer("A", "Arslan", $hamburgerSV);

        $realSociedad= $this->createTeam("Real Sociedad", "user35", "O Dromo", 77);
        $this->createPlayer("A", "Castro", $realSociedad);
        $this->createPlayer("A", "Vela", $realSociedad);
        $this->createPlayer("A", "Agirretxe", $realSociedad);
        $this->createPlayer("A", "Canale", $realSociedad);

        $sevilla= $this->createTeam("Sevilla", "user36", "El Libertador", 76);
        $this->createPlayer("A", "Gameiro", $sevilla);
        $this->createPlayer("A", "Rakitic", $sevilla);
        $this->createPlayer("A", "Vitolo", $sevilla);
        $this->createPlayer("A", "Bacca", $sevilla);

        $this->objectManager->flush();
    }

    private function createAssociations()
    {
        $this->associationManager->createAssociation("World");
    }

    private function createCompetitions()
    {
        $world = $this->associationManager->getAssociationByName("World");
        $league1 = new Competition();
        $league1->setName("League 1");
        $league1->setCode("WL1");
        $league1->setDivision(1);
        $league1->setRelegationSpots(2);
        $league1->setAssociation($world);
        $this->objectManager->persist($league1);

        $league2 = new Competition();
        $league2->setName("League 2");
        $league2->setCode("WL2");
        $league2->setDivision(2);
        $league2->setPromotionSpots(2);
        $league2->setAssociation($world);
        $this->objectManager->persist($league2);

        $ladder = new Competition();
        $ladder->setName("Ladder");
        $ladder->setCode("LDR");
        $this->objectManager->persist($ladder);

        $fifaKing = new Competition();
        $fifaKing->setName("Fifa King");
        $fifaKing->setCode("FKG");
        $this->objectManager->persist($fifaKing);

        $this->objectManager->flush();
    }

    private function createSeasons()
    {
        $worldLeague1 = $this->competitionManager->getCompetitionByName("League 1");
        $worldLeague2 = $this->competitionManager->getCompetitionByName("League 2");

        $worldSeason1 = $this->seasonManager->createSeason(new \DateTime("2014-01-01"), new \DateTime("2014-02-20"));
        $worldSeason1->setNumber(1);
        $worldSeason1->addCompetition($worldLeague1);
        $worldSeason1->addCompetition($worldLeague2);
        $this->objectManager->persist($worldSeason1);
        $this->objectManager->flush();

        $worldSeason2 = $this->seasonManager->createSeason(new \DateTime("2014-03-01"), new \DateTime("2014-04-20"));
        $worldSeason2->setNumber(2);
        $worldSeason2->addCompetition($worldLeague1);
        $worldSeason2->addCompetition($worldLeague2);
        $this->objectManager->persist($worldSeason2);
        $this->objectManager->flush();
    }

    private function createMatches()
    {
        $worldLeague1 = $this->competitionManager->getCompetitionByName("League 1");
        $worldLeague2 = $this->competitionManager->getCompetitionByName("League 2");
        $worldLeague3 = $this->competitionManager->getCompetitionByName("League 3");
        $worldSeason1 = $this->seasonManager->getSeasonByCompetitionAndNumber($worldLeague1, 1);
        $worldSeason2 = $this->seasonManager->getSeasonByCompetitionAndNumber($worldLeague1, 2);

        $this->createParticipant("Liverpool", $worldLeague1, $worldSeason1);
        $this->createParticipant("Real Madrid", $worldLeague1, $worldSeason1);
        $this->createParticipant("Borussia Dortmund", $worldLeague1, $worldSeason1);
        $this->createParticipant("Chelsea", $worldLeague1, $worldSeason1);
        $this->createParticipant("Barcelona", $worldLeague1, $worldSeason1);
        $this->createParticipant("Arsenal", $worldLeague1, $worldSeason1);
        $this->createParticipant("Manchester United", $worldLeague1, $worldSeason1);
        $this->createParticipant("Bayern Munich", $worldLeague1, $worldSeason1);
        $this->createParticipant("Milan", $worldLeague1, $worldSeason1);
        $this->createParticipant("Athletico Madrid", $worldLeague1, $worldSeason1);
        $this->createParticipant("Tottenham Hotspur", $worldLeague1, $worldSeason1);
        $this->createParticipant("Roma", $worldLeague1, $worldSeason1);
        $this->objectManager->flush();

        $worldLeague1Participants = $this->participantManager->getParticipantsByCompetitionAndSeason($worldLeague1, $worldSeason1);
        $this->matchManager->createFixtures($worldLeague1Participants, $worldLeague1, $worldSeason1);

        $matches = $this->matchManager->getMatchesByCompetitionAndSeason($worldLeague1, $worldSeason1);
        foreach ($matches as $match) {
            $match->setHomeScore(rand(0,2));
            $match->setAwayScore(rand(0,2));
            $match->setReported(new \DateTime());
            $match->setConfirmed(new \DateTime());
            $this->objectManager->persist($match);
        }
        $this->objectManager->flush();
        
        $this->createParticipant("Inter", $worldLeague2, $worldSeason1);
        $this->createParticipant("Paris Saint-Germain", $worldLeague2, $worldSeason1);
        $this->createParticipant("Juventus", $worldLeague2, $worldSeason1);
        $this->createParticipant("Manchester City", $worldLeague2, $worldSeason1);
        $this->createParticipant("Everton", $worldLeague2, $worldSeason1);
        $this->createParticipant("Southampton", $worldLeague2, $worldSeason1);
        $this->createParticipant("FC Schalke", $worldLeague2, $worldSeason1);
        $this->createParticipant("Valencia", $worldLeague2, $worldSeason1);
        $this->createParticipant("Napoli", $worldLeague2, $worldSeason1);
        $this->createParticipant("Lyon", $worldLeague2, $worldSeason1);
        $this->createParticipant("AS Monaco", $worldLeague2, $worldSeason1);
        $this->createParticipant("Sport Lisbon", $worldLeague2, $worldSeason1);
        $this->objectManager->flush();

        $worldLeague2Participants = $this->participantManager->getParticipantsByCompetitionAndSeason($worldLeague2, $worldSeason1);
        $this->matchManager->createFixtures($worldLeague2Participants, $worldLeague2, $worldSeason1);

        $matches = $this->matchManager->getMatchesByCompetitionAndSeason($worldLeague2, $worldSeason1);
        foreach ($matches as $match) {
            $match->setHomeScore(rand(0,2));
            $match->setAwayScore(rand(0,2));
            $match->setReported(new \DateTime());
            $match->setConfirmed(new \DateTime());
            $this->objectManager->persist($match);
        }
        $this->objectManager->flush();

        $relegatedTeams = $this->competitionManager->getRelegatedTeamsByCompetitionAndSeason($worldLeague1, $worldSeason1);
        foreach ($worldLeague1Participants as $participant) {
            $participantTeamName = $participant->getTeam()->getName();

            $found = false;
            foreach ($relegatedTeams as $relegatedTeam) {
                $relegatedTeamName = $relegatedTeam->getName();
                if ($relegatedTeamName === $participantTeamName) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $this->createParticipant($participantTeamName, $worldLeague1, $worldSeason2);
            }
        }
        $promotedTeams = $this->competitionManager->getPromotedTeamsByCompetitionAndSeason($worldLeague2, $worldSeason1);
        foreach ($promotedTeams as $promotedTeam) {
            $this->createParticipant($promotedTeam->getName(), $worldLeague1, $worldSeason2);
        }

        foreach ($worldLeague2Participants as $participant) {
            $participantTeamName = $participant->getTeam()->getName();

            $found = false;
            foreach ($promotedTeams as $promotedTeam) {
                $promotedTeamName = $promotedTeam->getName();
                if ($promotedTeamName === $participantTeamName) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $this->createParticipant($participantTeamName, $worldLeague2, $worldSeason2);
            }
        }

        foreach ($relegatedTeams as $relegatedTeam) {
            $this->createParticipant($relegatedTeam->getName(), $worldLeague2, $worldSeason2);
        }

        $this->objectManager->flush();

        $worldLeague1Participants = $this->participantManager->getParticipantsByCompetitionAndSeason($worldLeague1, $worldSeason2);
        $this->matchManager->createFixtures($worldLeague1Participants, $worldLeague1, $worldSeason2);

        $matches = $this->matchManager->getMatchesByCompetitionAndSeason($worldLeague1, $worldSeason2);
        foreach ($matches as $match) {
            $match->setHomeScore(rand(0,2));
            $match->setAwayScore(rand(0,2));
            $match->setReported(new \DateTime());
            $match->setConfirmed(new \DateTime());
            $this->objectManager->persist($match);
        }
        $this->objectManager->flush();

        $worldLeague2Participants = $this->participantManager->getParticipantsByCompetitionAndSeason($worldLeague2, $worldSeason2);
        $this->matchManager->createFixtures($worldLeague2Participants, $worldLeague2, $worldSeason2);

        $matches = $this->matchManager->getMatchesByCompetitionAndSeason($worldLeague2, $worldSeason2);
        foreach ($matches as $match) {
            $match->setHomeScore(rand(0,2));
            $match->setAwayScore(rand(0,2));
            $match->setReported(new \DateTime());
            $match->setConfirmed(new \DateTime());
            $this->objectManager->persist($match);
        }
        $this->objectManager->flush();
    }

    private function createRole($name, $role)
    {
        $userRole = new Role();
        $userRole->setName($name);
        $userRole->setRole($role);
        $this->objectManager->persist($userRole);
        return $userRole;
    }

    private function createUser($username, $email, $password, $role)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->addRole($role);
        $this->objectManager->persist($user);
    }

    private function createStadium($name)
    {
        $stadium = new Stadium();
        $stadium->setName($name);
        $this->objectManager->persist($stadium);
    }

    private function createTeam($name, $username, $stadiumName, $rating)
    {
        //$stadium = $this->stadiumManager->getStadiumByName($stadiumName);
        $user = $this->userManager->getUserByUsername($username);
        $team = new Team();
        $team->setName($name);
        $team->setRating($rating);
        $team->setUser($user);
        $this->objectManager->persist($team);
        return $team;
    }

    private function createPlayer($firstName, $lastName, $team)
    {
        $player = new Player();
        $player->setFirstName($firstName);
        $player->setLastName($lastName);
        $player->setTeam($team);
        $this->objectManager->persist($player);
        return $player;
    }

    private function createParticipant($name, Competition $competition, Season $season)
    {
        $team = $this->teamManager->getTeamByName($name);
        $participant = new Participant();
        $participant->setCompetition($competition);
        $participant->setTeam($team);
        $participant->setSeason($season);
        $this->objectManager->persist($participant);
        return $participant;
    }

    public function getOrder()
    {
        return 1;
    }
}