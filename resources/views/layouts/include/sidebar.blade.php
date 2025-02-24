@inject('perm', 'App\Http\Controllers\API\PermissionController')
@inject('app', 'App\Http\Controllers\API\SettingController')
<?php
$url = "$_SERVER[REQUEST_URI]";
$urlData = explode('/', $url);
$data = $urlData[count($urlData) - 1];

?>

<side-bar
        route={{$data}}
                routeurl={{$url}}
                workers={{$perm->workerManagePermission()}}
                services={{$perm->serviceManagePermission()}}
                products={{$perm->serviceManagePermission()}}
                booking={{$perm->bookingManagePermission()}}
                orders={{$perm->bookingManagePermission()}}
                userroles={{$perm->roleManagePermission()}}
                usermanage={{$perm->userManagePermission()}}
                vendormanage={{$perm->vendorManagePermission()}}
                bannermanage={{$perm->vendorManagePermission()}}
                appsettings={{$perm->appsManagePermission()}}
                emailsettings={{$perm->emailsManagePermission()}}
                offdaysettings={{$perm->offdaysManagePermission()}}
                vendorProfile={{$perm->offdaysManagePermission()}}
                holidaysettings={{$perm->holidaysManagePermission()}}
                emailtemplate={{$perm->etemplateManagePermission()}}
                clientmanage={{$perm->clientManagePermission()}}
                clientsetting={{$perm->clientSettingsPermission()}}
                reportpermission={{$perm->reportPermission()}}
>
</side-bar>
