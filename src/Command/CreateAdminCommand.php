<?php

namespace App\Command;

use App\Service\CreateAdminService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Create a new admin user',
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private readonly CreateAdminService $createAdminService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin user\'s email')
            ->addArgument('password', InputArgument::REQUIRED, 'Admin user\'s password')
            ->addArgument('firstName', InputArgument::REQUIRED, 'Admin user\'s first name')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Admin user\'s last name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $firstName = $input->getArgument('firstName');
        $lastName = $input->getArgument('lastName');

        $this->createAdminService->createAdmin($email, $password, $firstName, $lastName);

        $io->success('Admin user successfully created !');

        return Command::SUCCESS;
    }
}
