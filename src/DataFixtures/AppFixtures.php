<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\Habitat;
use App\Entity\Image;
use App\Entity\OpeningHour;
use App\Entity\Race;
use App\Entity\Review;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\VeterinaryReport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        // Create 5 Reviews
        $reviews = [];

        for ($i = 0; $i < 5; ++$i) {
            $review = new Review();
            $review->setPseudo($faker->name)
                ->setComment($faker->text(60))
                ->setIsVisible($faker->boolean(70));
            $manager->persist($review);
            $reviews[] = $review;
        }

        // Create Opening Hours
        $openingHours = [];

        foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $day) {
            $openingHour = new OpeningHour();
            $openingHour->setDay($day)
                    ->setOpen(new \DateTime($faker->time('08:00:00')))
                    ->setClose(new \DateTime($faker->time('18:00:00')));
            $manager->persist($openingHour);
            $openingHours[] = $openingHour;
        }

        // Create 40 images
        $images = [];
        $animalNames = ['leonidas', 'ezra', 'grace', 'indira', 'maya', 'zephyr', 'aria', 'galen', 'osiris'];

        foreach ($animalNames as $name) {
            $image = new Image();
            $image->setImagePath('images/'.$name.'.png')
                ->setTitle($name);
            $manager->persist($image);
            $images[] = $image;
        }

        // Create 9 races
        $races = [];

        foreach (['tigre du bengale', 'ara écarlate', 'toucan à carène', 'lion d\'Afrique', 'éléphant d\'Afrique', 'girafe réticulée', 'flamant rose des caraïbes', 'cerf de Duvaucel (Barasingha)', 'bec-en-sabot du Nil'] as $name) {
            $race = new Race();
            $race->setLabel($name);
            $manager->persist($race);
            $races[] = $race;
        }

        // Create 3 habitats
        $habitats = [];

        foreach (['savane', 'jungle', 'marais'] as $name) {
            $habitat = new Habitat();
            $habitat->setLabel($name)
                ->setDescription($faker->text(100))
                ->setLongDescription($faker->text(200))
                ->setHabitComment($faker->text(50))
                ->addImage($faker->randomElement($images));
            $manager->persist($habitat);
            $habitats[] = $habitat;
        }

        // Create 3 services
        $services = [];

        foreach (['gastronomie en milieu sauvage', 'visites guidées des habitats', 'visites à bord du arc-Express'] as $label) {
            $service = new Service();
            $service->setLabel($label)
                ->setDescription($faker->text(100))
                ->setLongDescription($faker->text(200))
                ->setTextBtn($faker->word())
                ->addImage($faker->randomElement($images));
            $manager->persist($service);
            $services[] = $service;
        }

        // Create 9 animals
        $animals = [];

        $leonidas = new Animal();
        $leonidas->setName('Leonidas')
            ->setRace($races[3])
            ->setHabitat($habitats[0])
            ->setState('excellente forme')
            ->setSize('2.5')
            ->setWeight('200')
            ->addImage($images[0])
            ->setPresentation($faker->text(100));
        $manager->persist($leonidas);
        $animals[] = $leonidas;

        $ezra = new Animal();
        $ezra->setName('Ezra')
            ->setRace($races[4])
            ->setHabitat($habitats[0])
            ->setState('excellente forme')
            ->setSize('3.5')
            ->setWeight('4000')
            ->addImage($images[1])
            ->setPresentation($faker->text(100));
        $manager->persist($ezra);
        $animals[] = $ezra;

        $grace = new Animal();
        $grace->setName('Grace')
            ->setRace($races[5])
            ->setHabitat($habitats[0])
            ->setState('bonne forme')
            ->setSize('5.5')
            ->setWeight('900')
            ->addImage($images[2])
            ->setPresentation($faker->text(100));
        $manager->persist($grace);
        $animals[] = $grace;

        $indira = new Animal();
        $indira->setName('Indira')
            ->setRace($races[0])
            ->setHabitat($habitats[1])
            ->setState('excellente forme')
            ->setSize('2.5')
            ->setWeight('180')
            ->addImage($images[3])
            ->setPresentation($faker->text(100));
        $manager->persist($indira);
        $animals[] = $indira;

        $maya = new Animal();
        $maya->setName('Maya')
            ->setRace($races[1])
            ->setHabitat($habitats[1])
            ->setState('en forme')
            ->setSize('0.80')
            ->setWeight('1')
            ->addImage($images[4])
            ->setPresentation($faker->text(100));
        $manager->persist($maya);
        $animals[] = $maya;

        $zephyr = new Animal();
        $zephyr->setName('zephyr')
            ->setRace($races[2])
            ->setHabitat($habitats[1])
            ->setState('excellente forme')
            ->setSize('0.50')
            ->setWeight('0.5')
            ->addImage($images[5])
            ->setPresentation($faker->text(100));
        $manager->persist($zephyr);
        $animals[] = $zephyr;

        $aria = new Animal();
        $aria->setName('Aria')
            ->setRace($races[6])
            ->setHabitat($habitats[2])
            ->setState('bonne forme')
            ->setSize('1.2')
            ->setWeight('3')
            ->addImage($images[6])
            ->setPresentation($faker->text(100));
        $manager->persist($aria);
        $animals[] = $aria;

        $galen = new Animal();
        $galen->setName('Galen')
            ->setRace($races[7])
            ->setHabitat($habitats[2])
            ->setState('excellente forme')
            ->setSize('1.8')
            ->setWeight('160')
            ->addImage($images[7])
            ->setPresentation($faker->text(100));
        $manager->persist($galen);
        $animals[] = $galen;

        $osiris = new Animal();
        $osiris->setName('Osiris')
            ->setRace($races[8])
            ->setHabitat($habitats[2])
            ->setState('excellente forme')
            ->setSize('1.5')
            ->setWeight('5')
            ->addImage($images[8])
            ->setPresentation($faker->text(100));
        $manager->persist($osiris);
        $animals[] = $osiris;

        // Create 5 Employees
        $employees = [];

        for ($i = 0; $i < 5; ++$i) {
            $employee = new User();
            $employee->setEmail($faker->email)
                    ->setPassword($faker->password)
                    ->setRoles(['ROLE_EMPLOYEE'])
                    ->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName);
            $manager->persist($employee);
            $employees[] = $employee;
        }

        // Create 5 Veterinaries
        $veterinaries = [];

        for ($i = 0; $i < 5; ++$i) {
            $veterinary = new User();
            $veterinary->setEmail($faker->email)
                        ->setPassword($faker->password)
                        ->setRoles(['ROLE_VETERINARY'])
                        ->setFirstname($faker->firstName)
                        ->setLastname($faker->lastName);
            $manager->persist($veterinary);
            $veterinaries[] = $veterinary;
        }

        // Create 5 Food Consumptions
        $foodConsumptions = [];

        for ($i = 0; $i < 5; ++$i) {
            $foodConsumption = new FoodConsumption();

            // Get or create a random animal
            $animal = $faker->randomElement($animals);
            if (!$animal->getId()) {
                $manager->persist($animal);
            }

            $foodConsumption->setAnimal($animal)
                ->setDetail($faker->text(50))
                ->setDate($faker->dateTimeBetween('-1 month', 'now'))
                ->setEmployee($faker->randomElement($employees));
            $manager->persist($foodConsumption);
            $foodConsumptions[] = $foodConsumption;
        }

        // Create 5 Veterinary Reports
        $veterinaryReports = [];

        $veterinaryReports = [];

        for ($i = 0; $i < 5; ++$i) {
            $veterinaryReport = new VeterinaryReport();

            // Get or create a random animal
            $animal = $faker->randomElement($animals);
            if (!$animal->getId()) {
                $manager->persist($animal);
            }

            $veterinaryReport->setAnimal($animal)
                ->setDetail($faker->text(50))
                ->setDate($faker->dateTimeBetween('-1 month', 'now'))
                ->setVeterinary($faker->randomElement($veterinaries));
            $manager->persist($veterinaryReport);
            $veterinaryReports[] = $veterinaryReport;
        }

        $manager->flush();
    }
}
