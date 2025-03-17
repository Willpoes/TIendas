<?php 

$setting = find_setting_of_admin($admin_id);


$site_name = ""; $tag = ""; $site_logo = ""; $panel_currency = ""; $setting_id = "";
if(!empty($setting['panel_site_name'])) $site_name = $setting['panel_site_name'];
if(!empty($setting['panel_tag_line'])) $tag = ' - ' . $setting['panel_tag_line'];
if(!empty($setting['panel_logo_name'])) $site_logo  = 'uploads/user-images/' . $setting['panel_logo_name'];
if(!empty($setting['panel_currency'])) $panel_currency = $setting['panel_currency'];
if(!empty($setting['setting_id'])) $setting_id = $setting['setting_id'];

?>
<!DOCTYPE HTML>
<html lang="es-PE">
<head>
    <title><?php echo $site_name; ?><?php echo $tag; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $site_logo ; ?>" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CKarma:400%7CLibre+Baskerville" rel="stylesheet">

    <!-- Font Icons -->
    <link rel="stylesheet" href="fonts/css/fontawesome-all.min.css">

    <!-- Bootstrap -->
   
    <link rel="stylesheet" type="text/css" href="./plugin-frameworks/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./plugin-frameworks/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="./plugin-frameworks/css/responsive.bootstrap4.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="./common_update/styles.css">
    

</head>