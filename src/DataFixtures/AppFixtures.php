<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();
        // Parameters
        $now = new \DateTimeImmutable();

        // Category Fixture
        $c1 = new Category();
        $c1->setLabel('Grab');
        $manager->persist($c1);

        $c2 = new Category();
        $c2->setLabel('Backside');
        $manager->persist($c2);

        $c3 = new Category();
        $c3->setLabel('Backflip');
        $manager->persist($c3);

        $c4 = new Category();
        $c4->setLabel('Switch');
        $manager->persist($c4);

        // $product = new Product();
        // $manager->persist($product);
        $t1 = new Tricks();
        $t1->setDescription('Cette figure consiste à saisi l\'avant de la planche, avec la main avant, du côté de la carre frontside')
            ->setName('Japan Air')
            ->setSlug($slugger->slug('Japan Air'))
            ->setCategory($c1)
            ->setCreatedAt($now);

        $manager->persist($t1);

        $t2 = new Tricks();
        $t2->setDescription('Mais en fait, pourquoi le Backside air est-il aussi emblématique? C’est vrai quoi, il existe des tricks bien plus compliqués que ça dans le snowboard moderne, d’autres aussi avec des noms bien plus amusants… Mais rappelle-toi: le backside air est le seul trick que tu ne peux pas faire en ski – déjà ça pose. Ensuite, c’est sans doute le trick qui marque le plus ta personnalité, car il y a 10.000 manières de le faire. Enfin, pour un trick “simple”, il est tout de même assez technique. Il faut l’envoyer en avançant le buste au pop, et vraiment s’engager dans les airs pour pouvoir bien grabber comme il se doit. Voilà à notre avis trois raisons majeures à ce succès du backside air, toutes générations et tous pratiquants confondus.')
            ->setName('Backside Air')
            ->setSlug($slugger->slug("Backside Air"))
            ->setCategory($c2)
            ->setCreatedAt($now);
        $manager->persist($t2);

        $t3 = new Tricks();
        $t3->setDescription('Si l’univers du snowboard a jamais disposé d’un scientifique, alors c’était David Benedek. Personne mieux que lui n’a su comment monter un kicker pour qu’un trick marche bien. En musique, on qualifie cela d’expérimental. Ce n’est pas un hasard si c’est précisément lui qui a eu l’idée de faire un switch BS rode')
            ->setName('Switch Backside Rodeo 720')
            ->setSlug($slugger->slug('Switch Backside Rodeo 720'))
            ->setCategory($c2)
            ->setCreatedAt($now);

        $manager->persist($t3);

        $t4 = new Tricks();
        $t4->setDescription('Bode Merril est la preuve vivante que la réincarnation n’est pas un conte de fée. Dans sa vie antérieure de flamant rose, il avait déjà l’habitude d’affronter le quotidien sur une patte. Quelque 200 ans plus tard, il a eu la chance d’être un homme doté d’un snowboard, ce qui a fini par donner à son être l’élan nécessaire. Il aime bien s’avaler quelques one foot double backflips au p’tit déj.')
            ->setName('One Foot Tricks')
            ->setSlug($slugger->slug('One Foot Tricks'))
            ->setCategory($c3)
            ->setCreatedAt($now);
        $manager->persist($t4);

        $t5 = new Tricks();
        $t5->setDescription('Danny Davis est comme ces meilleurs potes qui peuvent faire tous les tricks avec juste un tout petit plus de classe que toi. Aussi difficiles ou aussi faciles soient-ils. Si un nombre incalculable de blessures ne l’avait pas cloué au lit, il aurait mis sens dessus dessous le monde de la compétition en pipe. Heureusement qu’il y a la vidéo. Et puis on peut quand même se faire une compétition de temps en temps. Et alors on peut y mettre un peu de switch method pour faire tomber les juges à la renverse.')
            ->setName('Switch Method')
            ->setSlug($slugger->slug('Switch Method'))
            ->setCategory($c4)
            ->setCreatedAt($now);

        $manager->persist($t5);

        $manager->flush();
    }
}
