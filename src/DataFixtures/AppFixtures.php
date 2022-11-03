<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tricks;
use App\Entity\Video;
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

        // Image Fixture

        // Video Fixture
        $v1 = new Video();
        $v1->setUrl('https://youtu.be/LZqKaZyby2g');
        $manager->persist($v1);

        $v2 = new Video();
        $v2->setUrl('https://youtu.be/jH76540wSqU');
        $manager->persist($v2);

        $v3 = new Video();
        $v3->setUrl('https://youtu.be/_CN_yyEn78M');
        $manager->persist($v3);

        $v4 = new Video();
        $v4->setUrl('https://youtu.be/BJYwC5wOt4o');
        $manager->persist($v4);

        $v5 = new Video();
        $v5->setUrl('https://youtu.be/LWUfrwCofuA');
        $manager->persist($v5);

        $v6 = new Video();
        $v6->setUrl('https://youtu.be/LWUfrwCofuA');
        $manager->persist($v6);

        $v7 = new Video();
        $v7->setUrl('https://youtu.be/M-W7Pmo-YMY');
        $manager->persist($v7);

        $v8 = new Video();
        $v8->setUrl('https://youtu.be/4vGEOYNGi_c');
        $manager->persist($v8);

        $v9 = new Video();
        $v9->setUrl('https://youtu.be/f9FjhCt_w2U');
        $manager->persist($v9);

        $v10 = new Video();
        $v10->setUrl('https://youtu.be/KEdFwJ4SWq4');
        $manager->persist($v10);

        $v11 = new Video();
        $v11->setUrl('https://youtu.be/6yA3XqjTh_w');
        $manager->persist($v11);

        $t1 = new Tricks();
        $t1->setDescription('Cette figure consiste à saisi l\'avant de la planche, avec la main avant, du côté de la carre frontside')
            ->setName('Japan Air')
            ->setSlug($slugger->slug('Japan Air'))
            ->setCategory($c1)
            ->addVideo($v1)
            ->setCreatedAt($now);
        $manager->persist($t1);

        $t2 = new Tricks();
        $t2->setDescription('Mais en fait, pourquoi le Backside air est-il aussi emblématique? C’est vrai quoi, il existe des tricks bien plus compliqués que ça dans le snowboard moderne, d’autres aussi avec des noms bien plus amusants… Mais rappelle-toi: le backside air est le seul trick que tu ne peux pas faire en ski – déjà ça pose. Ensuite, c’est sans doute le trick qui marque le plus ta personnalité, car il y a 10.000 manières de le faire. Enfin, pour un trick “simple”, il est tout de même assez technique. Il faut l’envoyer en avançant le buste au pop, et vraiment s’engager dans les airs pour pouvoir bien grabber comme il se doit. Voilà à notre avis trois raisons majeures à ce succès du backside air, toutes générations et tous pratiquants confondus.')
            ->setName('Backside Air')
            ->setSlug($slugger->slug("Backside Air"))
            ->setCategory($c2)
            ->addVideo($v2)
            ->setCreatedAt($now);
        $manager->persist($t2);

        $t3 = new Tricks();
        $t3->setDescription('Si l’univers du snowboard a jamais disposé d’un scientifique, alors c’était David Benedek. Personne mieux que lui n’a su comment monter un kicker pour qu’un trick marche bien. En musique, on qualifie cela d’expérimental. Ce n’est pas un hasard si c’est précisément lui qui a eu l’idée de faire un switch BS rode')
            ->setName('Switch Backside Rodeo 720')
            ->setSlug($slugger->slug('Switch Backside Rodeo 720'))
            ->setCategory($c2)
            ->addVideo($v3)
            ->setCreatedAt($now);

        $manager->persist($t3);

        $t4 = new Tricks();
        $t4->setDescription('Bode Merril est la preuve vivante que la réincarnation n’est pas un conte de fée. Dans sa vie antérieure de flamant rose, il avait déjà l’habitude d’affronter le quotidien sur une patte. Quelque 200 ans plus tard, il a eu la chance d’être un homme doté d’un snowboard, ce qui a fini par donner à son être l’élan nécessaire. Il aime bien s’avaler quelques one foot double backflips au p’tit déj.')
            ->setName('One Foot Tricks')
            ->setSlug($slugger->slug('One Foot Tricks'))
            ->setCategory($c3)
            ->addVideo($v4)
            ->setCreatedAt($now);
        $manager->persist($t4);

        $t5 = new Tricks();
        $t5->setDescription('Danny Davis est comme ces meilleurs potes qui peuvent faire tous les tricks avec juste un tout petit plus de classe que toi. Aussi difficiles ou aussi faciles soient-ils. Si un nombre incalculable de blessures ne l’avait pas cloué au lit, il aurait mis sens dessus dessous le monde de la compétition en pipe. Heureusement qu’il y a la vidéo. Et puis on peut quand même se faire une compétition de temps en temps. Et alors on peut y mettre un peu de switch method pour faire tomber les juges à la renverse.')
            ->setName('Switch Method')
            ->setSlug($slugger->slug('Switch Method'))
            ->setCategory($c4)
            ->addVideo($v5)
            ->setCreatedAt($now);

        $manager->persist($t5);

        $t6 = new Tricks();
        $t6->setDescription('saisie de la partie arrière de la planche, avec la main arrière.')
            ->setName('Tail grab')
            ->setSlug($slugger->slug('Tail grab'))
            ->setCategory($c4)
            ->addVideo($v6)
            ->setCreatedAt($now);

        $manager->persist($t6);

        $t7 = new Tricks();
        $t7->setDescription('saisie de la partie avant de la planche, avec la main avant.')
            ->setName('Nose grab')
            ->setSlug($slugger->slug('Nose grab'))
            ->setCategory($c4)
            ->addVideo($v7)
            ->setCreatedAt($now);

        $manager->persist($t7);

        $t8 = new Tricks();
        $t8->setDescription('saisie du carre frontside à l\'arrière avec la main avant ')
            ->setName('Seat belt')
            ->setSlug($slugger->slug('Seat belt'))
            ->setCategory($c4)
            ->addVideo($v8)
            ->setCreatedAt($now);

        $manager->persist($t8);



        $t9 = new Tricks();
        $t9->setDescription('saisie de la carre backside de la planche entre les deux pieds avec la main arrière.')
            ->setName('Stalefish')
            ->setSlug($slugger->slug('Stalefish'))
            ->setCategory($c4)
            ->addVideo($v9)
            ->setCreatedAt($now);

        $manager->persist($t9);


        $t10 = new Tricks();
        $t10->setDescription('saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.')
            ->setName('Melancholie')
            ->setSlug($slugger->slug('Melancholie'))
            ->setCategory($c4)
            ->addVideo($v10)
            ->setCreatedAt($now);

        $manager->persist($t10);

        $t11 = new Tricks();
        $t11->setDescription('aisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.')
            ->setName('Indy')
            ->setSlug($slugger->slug('Indy'))
            ->setCategory($c4)
            ->addVideo($v11)
            ->setCreatedAt($now);

        $manager->persist($t11);

        $manager->flush();
    }
}
