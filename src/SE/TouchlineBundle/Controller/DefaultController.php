<?php

namespace SE\TouchlineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Validator\Constraints\FormValidator;
use Symfony\Component\Form\Guess\ValueGuess;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validation;


class DefaultController extends Controller
{
    public $messageId;

    public function indexAction()
    {
        return $this->render('SETouchlineBundle:Default:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function writeAction()
    {
        return $this->render('SETouchlineBundle:Default:editor.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function replyAction(Request $request)
    {
        $this->messageId = $request->get('id');

        if (null === $this->messageId) {
            throw new NotFoundHttpException('Reply not available. The message ID must be specified.');
        }

        if(false === is_numeric($this->messageId)) {
            throw new BadRequestHttpException('Reply was rejected. The message ID must be a natural number.');
        }

        return $this->render('SETouchlineBundle:Default:editor.html.twig',
            array(
                'id' => $this->messageId
            ));
    }
}
