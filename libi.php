<!--  Libi project  1.0.2 - Licensed under GNU GPL -->

<?php


//rearrange un tableau de session qui peut avoir des trous. Renvoie la nouvelle longueur
function resetter($name)
{
    echo '<!-- Resetter-->';
    $i = 0;
    $temp = array();
    foreach ($_SESSION[$name] as $ligne) {
        $temp[$i] = $ligne;
        $i++;
    }

    $_SESSION[$name] = $temp;
    return $i;
    

}

function autoinput($type, $name, $echo, $args)
{
    echo '<!-- autoinput-->';
    //type :type d'input
    //name  :le name recupere par le traitement
    //echo :le texte affiché devant
    //args : des parametres html en plus (required...)
    //necessite d'etre dans un tableau
    echo '<tr><td><label for="' . $name . '">' . $echo . '</label></td>';
    echo "<td><input type=\"$type\" name=\"$name\" id=\"$name\" $args /></td></tr>";


}





function affiche($var)
{ //fonction parlante, pour le debug
    echo '-- ' . $var . ' -- <br/>';
}



//---------------
//libi_core start
//---------------
$pdo_ok = false;
$user_func = false;
$var_securities = false;
$name_tools=false;
if (!isset($libi_config_on)) {
    if (@include('libi_files/libi_config.php')) {
        if ($libi_pdo['enabled'])
            if (@!include('libi_files/libi_pdo.php'))
                autodie('pdo');
            else $pdo_ok = true;
        if ($libi_enable_user_func)
            if (@!include('libi_files/libi_user_func.php'))
                autodie('user_func');
            else $user_func = true;
        if ($libi_enable_var_securities)
            if (@!include('libi_files/libi_var_securities.php'))
                autodie('var_securities');
            else $var_securities = true;
        if ($libi_enable_names_tools)
            if (@!include('libi_files/libi_names_tools.php'))
                autodie('names_tools');
            else $name_tools = true;
    } else
        echo '<pre>Warning! Unable to get libi config. Expect errors.</pre>';
}


function autodie($module)
{
    die('<pre>Unable to get libi ' . $module . ' module!</pre>');
}

function isenabled($bool)
{
    if ($bool)
        return 'Enabled';
    else
        return 'Not enabled';
}


if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    // this file is not being included
    if ($libi_welcome) {
        echo '<div style="text-align: center;"><h1>WoopyCat libi micro-framework</h1>
		<table border="1" style="text-align:center;margin-left:auto; 
    margin-right:auto;">
		<tr><th>Module</th><th>Is enabled?</th></tr>
		<tr><td>Core</td><td>Enabled</td></tr>
		<tr><td>Pdo</td><td>' . isenabled($pdo_ok) . '</td></tr>
		<tr><td>User functions</td><td>' . isenabled($user_func) . '</td></tr>
		<tr><td>Variables securers</td><td>' . isenabled($var_securities) . '</td></tr>
		<tr><td>Tools for names</td><td>' . isenabled($name_tools) . '</td></tr>
		</table>
		</div>
		<div style="text-align:center;position:fixed; width:100%; height:70px; padding:5px; bottom:0px; ">
		ALL HAIL GNU GPL - Baptiste rajaut</div>';
    } else {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
        exit();
    }
}

?>

