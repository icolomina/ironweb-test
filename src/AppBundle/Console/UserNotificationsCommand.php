<?php

namespace AppBundle\Console;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserNotificationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:send-notifications')
            ->setDescription('Send user notifications')
            ->addArgument('email', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $email = $input->getArgument('email');

        $notifications = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Notification')
             ->findReadyToSendByEmail($email);
        ;

        if(empty($notifications)){

            $output->writeln('<info>There are no notifications for ' . $email . '</info>');
            return;
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody($this->getContainer()->get('templating')->renderView('AppBundle::NotificationEmail.html.twig', array('notifications' => $notifications)), 'text/html')

        ;

        try {
            $output->writeln('<info>Sending an email to ' . $email . ' with ' . $notifications->count() . '</info>');

            $this->getContainer->get('mailer')->send($message);
            $output->writeln('<info>Email sent successfuly</info>');
        }
        catch(\Exception $e){

            $output->writeln('<error>An error ocurred while sending the email. Please contect with the administrator</error>');
        }
    }
}
