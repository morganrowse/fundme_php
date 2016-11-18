<?php

class FileController extends BaseController {
    
    public function getAgreement($filename)
    {
        if (Auth::check())
        {
            return Response::download('app/'.$filename);
        } else {
            return Response::view('errors.403', array(), 403);
        }
    }

    public function getDocumentation($filename)
    {
        if (Auth::check())
        {
            return Response::download('app/'.$filename);
        } else {
            return Response::view('errors.403', array(), 403);
        }
    }

    public function getAvatar($filename)
    {
        if (Auth::check())
        {
            return Response::download('app/'.$filename);
        } else {
            return Response::view('errors.403', array(), 403);
        }
    }
}
