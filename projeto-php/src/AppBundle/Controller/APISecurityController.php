<?php

namespace AppBundle\Controller;

use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\FOSRestController;
use Sonata\UserBundle\Entity\UserManager;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Validator\Validation;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;

/**
 * Class APISecurityController
 * @package AppBundle\Controller
 */
class APISecurityController extends FOSRestController
{

    /**
     * Criar uma função para deslogar o cara via sistema.
     * Para isso vamos criar um método que invoca o firebase;
     */

    /**
     * Estratégia de Login. Quando fizer login vai fazer esse insert
     * Nomes:
     *  email       = email do usuário
     *  code        = senha de acesso
     *  userToken   = token firebase;
     *  deviceToken = código do aparelho ***** criar na rota
     *  deviceType  = android ou ios ***** criar na rota
     *
     ***** Regra: Toda vez que logar fazer update no userToken
     */


    /**
     * Get users to use this API.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @REST\QueryParam(name="email", requirements="[a-z]+", nullable=false, description="The user's e-mail.")
     * @REST\QueryParam(name="code", requirements="[a-z]+", nullable=false, description="The user's password or token social.")
     * @REST\QueryParam(name="userToken", requirements="[a-z]+", nullable=false, description="Token")
     *
     * @REST\Get("/users/login")
     * @param Request $request
     * @throws \Symfony\Component\Security\Core\Exception\BadCredentialsException
     * @return array|json|xml
     * @REST\View(serializerEnableMaxDepthChecks=true)
     */
    public function getUserAction(Request $request)
    {
        $apptoken   = $request->headers->get('appToken');
        $code       = $request->get('code');
        $email      = $request->get('email');

        if (!$apptoken) {
            throw new BadCredentialsException('No API token app found');
        }

        if ($apptoken !== $this->container->getParameter('api_app_token')) {
            throw new BadCredentialsException('No API token app valid');
        }

        /** @var UserManager $um */
        $um = $this->container->get('sonata.user.user_manager');

        // Find user by email
        $user = $um->findUserByEmail($request->get('email'));

        // Test user by this email exists
        if(!$user){
            throw new HttpException(Codes::HTTP_FORBIDDEN, "Colaborador não encontrado");
        }

        // Test password are correct to this user
        if(!$this->comparePasswordWithParameterUrlWithUserDatabase($user,$code)){
            throw new HttpException(Codes::HTTP_FORBIDDEN, "Senha incorreta para o usuário: " . $email);
        }

		$colaboradorData = null;

        // Join Colaborador
		if ($user->getColaborador()) {

            $query = $this->getDoctrine()->getEntityManager()->createQuery("
            SELECT c FROM AppBundle:Colaborador c
            JOIN c.user u
            WHERE u.id = :usuario
            ");

            $query->setParameter('usuario', $user->getId());

            $colaboradorData = $query->getOneOrNullResult();

		}

        if (!$colaboradorData) {
            throw new HttpException(Codes::HTTP_FORBIDDEN, "Colaborador não encontrado ou não vinculado a este usuário");
        }

        // Verificar se este colaborar está habilitado
        if($colaboradorData->getUser()->isLocked() || (!$colaboradorData->getUser()->isEnabled())){
            throw new HttpException(Codes::HTTP_FORBIDDEN, 'Este colaborador está bloqueado!' . $email);
        }

        return [
            'colaborador' => $colaboradorData,
            'apiToken'    => $user->getApiToken(),
        ];
    }

    private function comparePasswordWithParameterUrlWithUserDatabase($user,$password)
    {
        $encoder_service = $this->container->get('security.encoder_factory');
        $encoder         = $encoder_service->getEncoder($user);
        $encoded_pass    = $encoder->encodePassword($password,$user->getSalt());

        return ($encoded_pass===$user->getPassword());

    }
}
