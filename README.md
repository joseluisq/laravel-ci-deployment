# laravel-ci-deployment

> [Laravel 5.4](https://laravel.com/docs/5.4/) + [Circle CI](https://circleci.com/) + [Deployer](https://github.com/deployphp/deployer) example.

## Requirements

- Circle CI project connected with your Github or Bitbucket account.
- SSH key configured in your server and added to your Circle CI project at `PERMISSIONS > SSH Permissions`.

## Project configuration

Add __deployer__ package to your laravel project as dev dependency.

```sh
composer require deployer/deployer --dev 
```

Copy the following files to your project's root:

- `deploy.php` (For more advanced features check out [Deployer](https://deployer.org/docs) documentation)
- `circle.yml` (For more advanced features check out [Circle CI](https://circleci.com/docs/1.0/) documentation)

## Environment Variables
Add environment variables to your __Circle CI__ project at `BUILD SETTINGS > Environment Variables`. The values will be passed to `deploy.php` file later.

```sh
MY_DEPLOY_SERVER        #   Your server domain or IP.

MY_DEPLOY_USER          #   Your server username.

MY_DEPLOY_IDFILE        #   The Circle CI SSH key path. (~/.ssh/id_YOUR_HOSTNAME_VALUE)
                        #   
                        #   Example: Add your SSH server key at "PERMISSIONS > SSH Permissions" and 
                        #   in "Hostname" enter for example "myserver".
                        #   Then, the "MY_DEPLOY_IDFILE" value should be 
                        #   "~/.ssh/id_myserver" (adding the "id_" prefix)

MY_DEPLOY_PATH          #   Your server deploy path.

MY_DEPLOY_REPOSITORY    #   Your git repository path. 
                        #   E.g. git@github.com:joseluisq/myrepo.git 
```

__Note:__ The "double quotes" (in this example) are illustrative only.


## Test

Finally, send your commit ! :+1:
