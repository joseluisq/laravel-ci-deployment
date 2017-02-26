<?php

/**
 * Laravel + Circle CI Deployment
 */

namespace Deployer;

require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);
set('repository', getenv('MY_DEPLOY_REPOSITORY'));

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// ~/.ssh/id_myserver
// Servers
server('production', getenv('MY_DEPLOY_SERVER'))
    ->user(getenv('MY_DEPLOY_USER'))
    ->identityFile(getenv('MY_DEPLOY_IDFILE'), getenv('MY_DEPLOY_IDFILE') . '.pub', '')
    ->set('deploy_path', getenv('MY_DEPLOY_PATH'))
    ->pty(true);


// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');
