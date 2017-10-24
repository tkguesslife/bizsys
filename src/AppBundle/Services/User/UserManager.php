<?php


namespace AppBundle\Services\User;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\DiExtraBundle\Annotation\Inject;
use AppBundle\Services\Core\StatusManager;
use AppBundle\Event\User\UserEvents;
use AppBundle\Event\User\UserEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Monolog\Logger;

/**
 * UserManager
 *
 * @DI\Service("user.manager")
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Services
 * @version 0.0.1
 *
 */
class UserManager {
    /**
     * @var Monolog logger
     */
    protected $logger;

    /**
     * @var Entity manager
     */
    protected $em;

    /**
     * @var Status manager
     */
    protected $sm;

    /**
     * @var Event Dispatcher
     */
    private $eventDispatcher;

    /**
     * Security Context
     * @var object
     * @Inject("security.token_storage", required = false)
     */
    public $securityContext;

    /**
     *
     * Class construct
     *
     * @param EntityManager $em
     * @param Logger $logger
     * @param StatusManager $sm
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     *
     * @DI\InjectParams({
     *     "em"                  = @DI\Inject("doctrine.orm.entity_manager"),
     *     "logger"              = @DI\Inject("logger"),
     *     "sm"                  = @DI\Inject("status.manager"),
     *     "eventDispatcher"     = @DI\Inject("event_dispatcher")
     * })
     */
    public function __construct(
        EntityManager $em,
        Logger $logger,
        StatusManager $sm,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->sm = $sm;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Get Current user
     *
     * @return AppBundle:User
     */
    public function getCurrentUser()
    {
        if ($this->securityContext->getToken() && $this->securityContext->getToken()->getUser() instanceof User) {
            return $this->securityContext->getToken()->getUser();
        }

        return false;
    }

    /**
     * Get user by id
     *
     * @param integer $id
     * @return AppBundle:User
     */
    public function getById($id)
    {
        $this->logger->info("User.Manager getById()");
        return $this->em->getRepository('AppBundle:User')
            ->find($id);
    }

    /**
     * Get user by Slug
     *
     * @param String $slug
     * @return AppBundle:User
     */
    public function getBySlug($slug)
    {
        $this->logger->info("User.Manager getById()");
        $results = $this->em->getRepository('AppBundle:User')
            ->findBySlug($slug);
        if (is_array($results)) {
            return $results[0];
        }
        return false;
    }

    /**
     * Get user by email
     *
     * @param String $email
     * @return AppBundle:User
     */
    public function getByEmail($email)
    {
        $this->logger->info("User.Manager getByEmail()");
        return $this->em->getRepository('AppBundle:User')
            ->findOneByEmail($email);
    }

    /**
     * Get user by token
     *
     * @param String $token
     * @return AppBundle:User
     */
    public function getByToken($token)
    {
        $this->logger->info("User.Manager getByToken()");
        return $this->em->getRepository('AppBundle:User')
            ->findOneByConfirmationToken($token);
    }

    /**
     * Get user by forgotPassword unique string
     *
     * @param String $forgotPassword
     * @return AppBundle:User
     */
    public function getByforgotPassword($forgotPassword)
    {
        $this->logger->info("User.Manager getByforgotPassword()");
        return $this->em->getRepository('AppBundle:User')
            ->findOneByForgotPassword($forgotPassword);
    }

    /**
     * Get query list of all system users
     *
     * @param array $options
     * @return Query
     */
    public function getListAll($options = array())
    {
        $this->logger->info("User.Manager getListAll()");
        return $this->em->getRepository('AppBundle:User')
            ->getAllQueryList($options);

    }

    /**
     * Get all users by organisation
     * @param integer $organisationId
     * @return mixed
     */
    public function getAllByOrganisationId($organisationId)
    {
        $this->logger->info("User.Manager getAllByOrganisation()");
        return $this->em->getRepository('AppBundle:User')
            ->getAllByOrganisationId($organisationId);
    }

    /**
     * Get count of all users in the system
     *
     * @return mixed
     */
    public function getCountOfAllUsers()
    {
        $this->logger->info("User.Manager getCountOfAllUsers()");

        $repo = $this->em->getRepository('AppBundle:User');

        $qb = $repo->createQueryBuilder('u');
        $qb->select('COUNT(u)');
        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Create user and trigger send confirmation
     * @param User $user
     * @param bool $bolSendEmail
     * @return User
     */
    public function createUser(\AppBundle\Entity\User $user, $bolSendEmail = true)
    {
        $this->logger->info("User.Manager createUser()");
        if(!$user->getPassword()){
            // generate password for user to send via email
            $password = substr(base_convert(bin2hex(hash('sha256', uniqid(mt_rand(), true), true)), 16, 20), 0, 10);
            $user->setPassword($password);
        }
        $user->setTransient($user->getPassword());

        //save user
        $user = $this->create($user);

        if($bolSendEmail) {
            $this->eventDispatcher->dispatch(
                UserEvents::NEW_ACCOUNT_CREATED,
                new UserEvent($user)
            );
        }

        return $user;
    }

    /**
     * Create user
     *
     * @param User $user
     * @return User
     */
    public function create(\AppBundle\Entity\User $user)
    {
        $this->logger->info("User.Manager create()");

//        $user->setStatus($this->sm->active());
        if(is_object($user->getGroup())){
            foreach ($user->getGroup()->getRoles() as $role) {
                $user->addUserRole($role);
                if ($user->getGroup()->getName() == 'Super Administrator') {
                    $user->setIsadmin(true);
                }
            }
        }


        if ($this->getCurrentUser() instanceof User) {
            $user->setCreatedBy($this->getCurrentUser());
        } else {
            $user->setCreatedBy(NULL);
        }

        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    /**
     * Update user
     *
     * @param User $user
     * @return User
     */
    public function update(\AppBundle\Entity\User $user)
    {
        $this->logger->info("User.Manager update()");
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    /**
     * Lock user account
     *
     * @param \AppBundle\Entity\User $user
     * @return \AppBundle\Entity\User
     */
    public function suspend(\AppBundle\Entity\User $user)
    {
        $this->logger->info("User.Manager suspend()");
        $user->setStatus($this->sm->suspended());
        $user->setActive(false);
        $user->setSuspendAt(new \DateTime());
        $user->setSuspendedBy($this->getCurrentUser());
        $user->setLocked(true);
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    /**
     * Suspend all user by orginsation
     *
     * @param $organisationId
     */
    public function suspendByOrganisationId($organisationId)
    {
        $this->logger->info("User.Manager suspendByOrganisationId()");
        $users = $this->getAllByOrganisationId($organisationId);

        foreach ($users as $user) {
            $this->suspend($user);
        }
    }

    /**
     * Activate user account
     *
     * @param \AppBundle\Entity\User $user
     * @return \AppBundle\Entity\User
     */
    public function activate(\AppBundle\Entity\User $user)
    {
        $this->logger->info("User.Manager activate()");
        $user->setStatus($this->sm->active());
        $user->setActive(true);
        $user->setActivatedAt(new \DateTime());
        $user->setActivatedBy($this->getCurrentUser());
        $user->setLocked(false);
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    /**
     * Activate all user by orginsation
     *
     * @param $organisationId
     */
    public function activateByOrganisationId($organisationId)
    {
        $this->logger->info("User.Manager activateByOrganisationId()");
        $users = $this->getAllByOrganisationId($organisationId);

        foreach ($users as $user) {
            $this->activate($user);
        }
    }

    /**
     * Generate forgot password random string and dispatch an event
     *
     * @param User $user
     * @return User
     */
    public function forgotPassword(\AppBundle\Entity\User $user)
    {
        $this->logger->info("User.Manager forgotPassword()");
        $user->setForgotPassword($this->generateRandomString(8));
        $user->setPasswordRequestedAt(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();

        $this->eventDispatcher->dispatch(
            UserEvents::ON_ACCOUNT_FORGOT_PASSWORD,
            new UserEvent($user)
        );
        return $user;
    }

    /**
     * Generate a random string
     * @param int $length
     * @return string
     * @author
     */
    public function generateRandomString($length = 10)
    {
        $this->logger->info("User.Manager generateRandomString()");
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function resetPassword(User $user){

        $user->setTransient($this->generateRandomString(5));
        $user->setPassword($user->getTransient());
        $user->encodePassword();
        $this->em->persist($user);
        $this->em->flush();

        $this->eventDispatcher->dispatch(
            UserEvents::USER_PASSWORD_RESET,
            new UserEvent($user)
        );
        return true;
    }

}