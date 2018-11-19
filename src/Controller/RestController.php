<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Base Controller for RestBundle controllers.
 *
 */
class RestController extends FOSRestController
{

    /**
     * Returns a 200 response, with an error message.
     *
     * @param string $message Error message to be displayed in response body
     * @return Response Response being rendered
     */
    protected function alreadyExist($message = 'Resource already exist.')
    {
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(400)
                ->setData(array('message' => $message))
        );
    }

    /**
     * Returns a 200 response, with an error message.
     *
     * @param string $message Error message to be displayed in response body
     * @return Response Response being rendered
     */
    protected function isEmpty($message = 'Resources empty.')
    {
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(404)
                ->setData(array('message' => $message))
        );
    }

    /**
     * Returns a 404 Not Found response, with an error message.
     *
     * @param string $message Error message to be displayed in response body
     * @return Response Response being rendered
     */
    protected function notFound($message = 'Resource not found.')
    {
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(404)
                ->setData(array('message' => $message))
        );
    }
    /**
     * Returns a 403 Forbidden response, with an error message.
     *
     * @param string $message Error message to be displayed in response body
     * @return Response Response being rendered
     */
    protected function forbid($message = 'Access denied baby.')
    {
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(403)
                ->setData(array('message' => $message))
        );
    }

    /**
     * Returns a 400 Bad Request response, with an error message and a list of detailed errors.
     *
     * @param string $message Error message to be displayed in response body
     * @param $errors
     * @return Response Response being rendered
     */
    protected function missing($message = 'Necessary data missing.', $errors)
    {
        $schema = array(
            'message' => $message,
            'errors' => array()
        );
        if ($errors) {
            foreach($errors as $error) {
                $schema['errors'][ $error -> getPropertyPath() ] = $error -> getMessage();
            }
        }
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(400)
                ->setData($schema)
        );
    }

    /**
     * Returns a 400 Bad Request response, with an error message and a list of detailed errors.
     *
     * @param string $title
     * @param string $message Error message to be displayed in response body
     * @return Response Response being rendered
     */
    protected function errorHandler($title = '[Error]', $message = 'An error occured.')
    {
        $schema = array(
            'titre' => $title,
            'message' => $message
        );
        return $this->get('fos_rest.view_handler')->handle(
            View::create()
                ->setStatusCode(400)
                ->setData($schema)
        );
    }
}