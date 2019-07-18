<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use App\Entity\Realisation;
use App\Entity\Resume;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('herve@mail.com');
        $user->setFirstname('Herve');
        $user->setLastname('Guigoz');
        $encoded = $this->encoder->encodePassword($user, "admin");
        $user->setPassword($encoded);
        $user->setAlias('herve-guigoz');
        $manager->persist($user);

        $resume = new Resume();
        $resume->setUser($user);
        $resume->setDescription("Les formations que j'ai suivies, mes différents stages, mon expérience professionnelle et tous les travaux et projets auxquels j'ai participé m'ont permis d'acquérir de nombreuses compétences dans le domaine du developpement web.");
        $resume->setSituation("En stage sur un poste de developpeur PHP");
        $resume->setAccroche("Impliqué et curieux, j'aime découvrir de nouvelles technologies et j'ai le goût du travail bien fait !");
        $resume->setTechno('PHP, Symfony, Javascript, Vue.js, Nuxt.js, Git, ORM Doctrine, Twig');
        $resume->setSoftSkills("Disponibilité et engagement, Résistance au stress, Initiative, Rigueur et Précision, Travail en équipe");
        $manager->persist($resume);

        $experience = new Experience();
        $experience->setTitre("DEVELOPPEUR PHP - SYMFONY");
        $experience->setDescription("Creation d’un journal vidéo sous Symfony 4. Les fonctionnalités développées sont : la gestion des comptes (créateur et internaute), la gestion des vidéos par le créateur, l’affichage du journal vidéo, la gestion des commentaires, la mise en place de statistiques (vues, likes), la gestion des abonnements et des notifications.");
        $experience->setYear(2019);
        $experience->setTechnos("PHP, Symfony, MySQL, Doctrine ORM, Twig, sass, Javascript");
        $experience->setResume($resume);
        $manager->persist($experience);

        $experience = new Experience();
        $experience->setTitre("DEVELOPPEUR PHP");
        $experience->setDescription("Creation un site de promotion et de gestion des reservations hôtelière (design pattern MVC) avec manipulation des ressources d’une base de données (MySQL).");
        $experience->setYear(2019);
        $experience->setTechnos('PHP, MySQL, Javascript');
        $experience->setResume($resume);
        $manager->persist($experience);

        $manager->flush();
    }
}
