<?php
$routes = [
    '/user/edit' => ['controller' => 'UserController', 'action' => 'editPage', 'guard' => 'Authenticated'],
    '/login' => ['controller' => 'LoginController', 'action' => 'loginPage'],
    '/user/edit/ed' => ['controller' => 'UserController', 'action' => 'editUser', 'guard' => 'Authenticated'],
    '/login/auth' => ['controller' => 'LoginController', 'action' => 'loginAction'],
    '/logout' => ['controller' => 'LoginController', 'action' => 'logoutAction'],
    '/register' => ['controller' => 'LoginController', 'action' => 'registerPage'],
    '/register/reg' => ['controller' => 'LoginController', 'action' => 'registerAction'],
    '/events' => ['controller' => 'EventController', 'action' => 'eventsPage','guard' => 'Authenticated'],
    '/events/{id}/edit' => ['controller' => 'EventController', 'action' => 'editPage','guard' => 'Authenticated'],
    '/events/doEdit' => ['controller' => 'EventController', 'action' => 'editEvent','guard' => 'Authenticated'],
    '/events/{id}/delete' => ['controller' => 'EventController', 'action' => 'deleteEvent','guard' => 'Authenticated'],
    '/events/add' => ['controller' => 'EventController', 'action' => 'addPage','guard' => 'Authenticated'],
    '/events/doAdd' => ['controller' => 'EventController', 'action' => 'addEventAction','guard' => 'Authenticated'],
    '/' =>['controller' => 'PageController', 'action' => 'home']
];
