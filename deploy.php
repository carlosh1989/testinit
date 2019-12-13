<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'testinit');

// Project repository
set('repository', 'git@github.com:carlosh1989/testinit.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

set('default_stage', 'alpha');

// Hosts

host('appalpha.trymyride.co')
    ->stage('alpha')
    ->user('alpha')
    ->identityFile('~/.ssh/aws-trymyride-alpha-2.pem')
    ->set('deploy_path', '/home/alpha/testinit');
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
