<?php
class Site
{
    public static function main()
    {
        Process::$context['name'] = 'world';
    }

    public static function logout()
    {
        if (Process::$context['csrf_token'] === Data::uriVar('csrf_token'))
        {
            Session::stop();
            $rPath = Data::uriVar('rpath');
            Process::redirect($rPath ? $rPath : '/');
        } else {
            throw new ForbiddenException();
        }
    }

    public static function login()
    {
        list ($login, $password) = Data::inputsList('login', 'password');
        if (Process::$context['csrf_token'] == Data::input('csrf_token')) {
            try {
                Session::authorize($login, $password, true);
                Process::redirect('/');
            } catch (AuthException $e) {
                Process::redirect('/?error=1');
            } catch (Exception $e) {
                throw new ForbiddenException();
            }
        } else {
            throw new NotFoundException();
        }
    }
}

