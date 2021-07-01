<?php

namespace App\config;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class Router
{
    private $frontController;
    private $errorController;
    private $backController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        $route = $this->request->getGet()->get('route');
        try{
            if(isset($route))
            {
                if($route === 'post'){
                    $this->frontController->post($this->request->getGet()->get('postId'));
                }
                elseif ($route === 'addPost'){
                    $this->backController->addPost($this->request->getPost());
                }
                elseif($route === 'editPost'){
                    $this->backController->editPost($this->request->getPost(), $this->request->getGet()->get('postId'));
                }
                elseif($route === 'deletePost'){
                    $this->backController->deletePost($this->request->getGet()->get('postId'));
                }
                elseif($route === 'addComment'){
                    $this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('postId'));
                }
                elseif($route === 'flagComment'){
                    $this->frontController->flagComment($this->request->getGet()->get('commentId'));
                }
                elseif($route === 'deleteComment'){
                    $this->backController->deleteComment($this->request->getGet()->get('commentId'));
                }
                elseif($route === 'register'){
                    $this->frontController->register($this->request->getPost());
                }
                else{
                    $this->errorController->errorNotFound();
                }
            }
            else{
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}