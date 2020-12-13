<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'astrid');

// Project repository
set('repository', 'https://github.com/ivanstan/astrid');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server 
add('writable_dirs', []);

// Hosts

host('spacehub.com')
    ->user('spacehub')
    ->port(2233)
    ->stage('production')
    ->set('deploy_path', '~/projects/astrid.spacehub.rs');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

