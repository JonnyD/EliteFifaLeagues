<?php

namespace EliteFifa\CareerBundle\DataFixtures\ORM\Match;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CareerBundle\Entity\Career;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\DataFixtures\ORM\Competitor\CompetitorFixtures;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\RegionBundle\DataFixtures\ORM\Region\RegionFixtures;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\DataFixtures\ORM\User\UserFixtures;
use EliteFifa\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CareerFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
    private $manager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $worldRegion = $this->getRegion('World');

        $user1 = $this->getUser('user1');
        $user2 = $this->getUser('user2');
        $user3 = $this->getUser('user3');
        $user4 = $this->getUser('user4');
        $user5 = $this->getUser('user5');
        $user6 = $this->getUser('user6');
        $user7 = $this->getUser('user7');
        $user8 = $this->getUser('user8');
        $user9 = $this->getUser('user9');
        $user10 = $this->getUser('user10');
        $user11 = $this->getUser('user11');
        $user12 = $this->getUser('user12');
        $user13 = $this->getUser('user13');
        $user14 = $this->getUser('user14');
        $user15 = $this->getUser('user15');
        $user16 = $this->getUser('user16');
        $user17 = $this->getUser('user17');
        $user18 = $this->getUser('user18');
        $user19 = $this->getUser('user19');
        $user20 = $this->getUser('user20');
        $user21 = $this->getUser('user21');
        $user22 = $this->getUser('user22');
        $user23 = $this->getUser('user23');
        $user24 = $this->getUser('user24');
        $user25 = $this->getUser('user25');
        $user26 = $this->getUser('user26');
        $user27 = $this->getUser('user27');
        $user28 = $this->getUser('user28');
        $user29 = $this->getUser('user29');
        $user30 = $this->getUser('user30');
        $user31 = $this->getUser('user31');
        $user32 = $this->getUser('user32');
        $user33 = $this->getUser('user33');
        $user34 = $this->getUser('user34');
        $user35 = $this->getUser('user35');
        $user36 = $this->getUser('user36');
        $user37 = $this->getUser('user37');
        $user38 = $this->getUser('user38');
        $user39 = $this->getUser('user39');
        $user40 = $this->getUser('user40');

        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');
        $competitor6 = $this->getCompetitor('competitor6');
        $competitor7 = $this->getCompetitor('competitor7');
        $competitor8 = $this->getCompetitor('competitor8');
        $competitor9 = $this->getCompetitor('competitor9');
        $competitor10 = $this->getCompetitor('competitor10');
        $competitor11 = $this->getCompetitor('competitor11');
        $competitor12 = $this->getCompetitor('competitor12');
        $competitor13 = $this->getCompetitor('competitor13');
        $competitor14 = $this->getCompetitor('competitor14');
        $competitor15 = $this->getCompetitor('competitor15');
        $competitor16 = $this->getCompetitor('competitor16');
        $competitor17 = $this->getCompetitor('competitor17');
        $competitor18 = $this->getCompetitor('competitor18');
        $competitor19 = $this->getCompetitor('competitor19');
        $competitor20 = $this->getCompetitor('competitor20');
        $competitor21 = $this->getCompetitor('competitor21');
        $competitor22 = $this->getCompetitor('competitor22');
        $competitor23 = $this->getCompetitor('competitor23');
        $competitor24 = $this->getCompetitor('competitor24');
        $competitor25 = $this->getCompetitor('competitor25');
        $competitor26 = $this->getCompetitor('competitor26');
        $competitor27 = $this->getCompetitor('competitor27');
        $competitor28 = $this->getCompetitor('competitor28');
        $competitor29 = $this->getCompetitor('competitor29');
        $competitor30 = $this->getCompetitor('competitor30');
        $competitor31 = $this->getCompetitor('competitor31');
        $competitor32 = $this->getCompetitor('competitor32');
        $competitor33 = $this->getCompetitor('competitor33');
        $competitor34 = $this->getCompetitor('competitor34');
        $competitor35 = $this->getCompetitor('competitor35');
        $competitor36 = $this->getCompetitor('competitor36');
        $competitor37 = $this->getCompetitor('competitor37');
        $competitor38 = $this->getCompetitor('competitor38');
        $competitor39 = $this->getCompetitor('competitor39');
        $competitor40 = $this->getCompetitor('competitor40');

        $career1 = $this->createCareer($user1, $competitor1, $worldRegion);
        $career2 = $this->createCareer($user2, $competitor2, $worldRegion);
        $career3 = $this->createCareer($user3, $competitor3, $worldRegion);
        $career4 = $this->createCareer($user4, $competitor4, $worldRegion);
        $career5 = $this->createCareer($user5, $competitor5, $worldRegion);
        $career6 = $this->createCareer($user6, $competitor6, $worldRegion);
        $career7 = $this->createCareer($user7, $competitor7, $worldRegion);
        $career8 = $this->createCareer($user8, $competitor8, $worldRegion);
        $career9 = $this->createCareer($user9, $competitor9, $worldRegion);
        $career10 = $this->createCareer($user10, $competitor10, $worldRegion);
        $career11 = $this->createCareer($user11, $competitor11, $worldRegion);
        $career12 = $this->createCareer($user12, $competitor12, $worldRegion);
        $career13 = $this->createCareer($user13, $competitor13, $worldRegion);
        $career14 = $this->createCareer($user14, $competitor14, $worldRegion);
        $career15 = $this->createCareer($user15, $competitor15, $worldRegion);
        $career16 = $this->createCareer($user16, $competitor16, $worldRegion);
        $career17 = $this->createCareer($user17, $competitor17, $worldRegion);
        $career18 = $this->createCareer($user18, $competitor18, $worldRegion);
        $career19 = $this->createCareer($user19, $competitor19, $worldRegion);
        $career20 = $this->createCareer($user20, $competitor20, $worldRegion);
        $career21 = $this->createCareer($user21, $competitor21, $worldRegion);
        $career22 = $this->createCareer($user22, $competitor22, $worldRegion);
        $career23 = $this->createCareer($user23, $competitor23, $worldRegion);
        $career24 = $this->createCareer($user24, $competitor24, $worldRegion);
        $career25 = $this->createCareer($user25, $competitor25, $worldRegion);
        $career26 = $this->createCareer($user26, $competitor26, $worldRegion);
        $career27 = $this->createCareer($user27, $competitor27, $worldRegion);
        $career28 = $this->createCareer($user28, $competitor28, $worldRegion);
        $career29 = $this->createCareer($user29, $competitor29, $worldRegion);
        $career30 = $this->createCareer($user30, $competitor30, $worldRegion);
        $career31 = $this->createCareer($user31, $competitor31, $worldRegion);
        $career32 = $this->createCareer($user32, $competitor32, $worldRegion);
        $career33 = $this->createCareer($user33, $competitor33, $worldRegion);
        $career34 = $this->createCareer($user34, $competitor34, $worldRegion);
        $career35 = $this->createCareer($user35, $competitor35, $worldRegion);
        $career36 = $this->createCareer($user36, $competitor36, $worldRegion);
        $career37 = $this->createCareer($user37, $competitor37, $worldRegion);
        $career38 = $this->createCareer($user38, $competitor38, $worldRegion);
        $career39 = $this->createCareer($user39, $competitor39, $worldRegion);
        $career40 = $this->createCareer($user40, $competitor40, $worldRegion);

        $manager->persist($career1);
        $manager->persist($career2);
        $manager->persist($career3);
        $manager->persist($career4);
        $manager->persist($career5);
        $manager->persist($career6);
        $manager->persist($career7);
        $manager->persist($career8);
        $manager->persist($career9);
        $manager->persist($career10);
        $manager->persist($career11);
        $manager->persist($career12);
        $manager->persist($career13);
        $manager->persist($career14);
        $manager->persist($career15);
        $manager->persist($career16);
        $manager->persist($career17);
        $manager->persist($career18);
        $manager->persist($career19);
        $manager->persist($career20);
        $manager->persist($career21);
        $manager->persist($career22);
        $manager->persist($career23);
        $manager->persist($career24);
        $manager->persist($career25);
        $manager->persist($career26);
        $manager->persist($career27);
        $manager->persist($career28);
        $manager->persist($career29);
        $manager->persist($career30);
        $manager->persist($career31);
        $manager->persist($career32);
        $manager->persist($career33);
        $manager->persist($career34);
        $manager->persist($career35);
        $manager->persist($career36);
        $manager->persist($career37);
        $manager->persist($career38);
        $manager->persist($career39);
        $manager->persist($career40);
        $manager->flush();
    }

    private function createCareer(User $user, Competitor $competitor, Region $region)
    {
        $career = new Career();
        $career->setUser($user);
        $career->setCompetitor($competitor);
        $career->setRegion($region);
        return $career;
    }

    /**
     * @param string $key
     * @return Competitor
     */
    private function getCompetitor(string $key)
    {
        return $this->getReference('competitor.'.$key);
    }

    /**
     * @param string $key
     * @return Region
     */
    private function getRegion(string $key)
    {
        return $this->getReference('region.'.$key);
    }

    /**
     * @param string $key
     * @return User
     */
    private function getUser(string $key)
    {
        return $this->getReference('user.'.$key);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            CompetitorFixtures::class,
            RegionFixtures::class,
            UserFixtures::class
        ];
    }
}