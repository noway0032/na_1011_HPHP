<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    if(isset($_POST["submit"]))
        $isposted=true;
    else
        $isposted=false;

    if($isposted) {
        $uzenet=array();
        $email="";
        $password="";
        $password2="";
        $nev="";
        $valid=true;
        if(isset($_POST["email"])) $email=$_POST["email"];
        if(isset($_POST["password"])) $password=$_POST["password"];
        if(isset($_POST["password2"])) $password2=$_POST["password2"];
        if(isset($_POST["nev"])) $nev=$_POST["nev"];
        $email=trim($email);
        $password=trim($password);
        $password2=trim($password2);
        $nev=trim($nev);
        if(!validemail($email)) {
            $valid=false;
            array_push($uzenet,create_uzi("Hibás email cím!","error"));
            // $uzenet[]=create_uzi("Hibás email cím!","error");
        }
        if(strlen($password)==0 || strlen($password2)==0) {
            $valid=false;
            array_push($uzenet,create_uzi("A jelszó nincs megadva!","error"));
        }
        if($password!=$password2) {
            $valid=false;
            array_push($uzenet,create_uzi("A jelszó és a megismételt jelszó nem egyezik meg!","error"));
        }
        if(strlen($nev)<2) {
            // itt meg lehetnek problemak (speci karakterek, script)
            $valid=false;
            array_push($uzenet,create_uzi("Túl rövid név(legyen legalább 2 karakter)!","error"));
        }

        if($valid) {
            // insert into
            // welcome oldal, udvozles, auto beleptetes
            array_push($uzenet,create_uzi("Köszöntünk! A regisztrációd sikeres!","accept"));
            array_push($uzenet,create_uzi("Az aktivációs linket elküldtük a megadott email címedre!","accept"));
            $_SESSION["uzenet"]=$uzenet;
            unset($_SESSION["userreg"]);
            // masik megoldas
            //session_regenerate_id();
            header("Location: index.php"); exit();
        } else {
            // visszairanyitas regisztracios oldalra
            // hibauzenetek kuldes
            $_SESSION["uzenet"]=$uzenet;
            $userreg=new UserReg();
            $userreg->setNev($nev);
            $userreg->setEmail($email);
            $_SESSION["userreg"]=$userreg;
            header("Location: register.php"); exit();
        }
    }

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>BlogMotor - Regisztráció</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
    <?php
        show_uzenet();
        $nev="";
        $email="";
        $ur=$_SESSION["userreg"];
        if(isset($ur) && is_object($ur) && get_class($ur)=="UserReg" ) {
            //print_r($ur);
            $nev=$ur->getNev();
            $email=$ur->getEmail();
            //unset($_SESSION["userreg"]);
        }
    ?>
    <div id="regurlap">
        <form action="register.php" method="post">
            <table>
                <tr><th colspan="2">Regisztrációs adatok</th></tr>
                <tr>
                    <td>Email (login)</td>
                    <td><input type="text" value="<?php echo $email; ?>" class="editmezo" name="email" id="email" /></td>
                </tr>
                <tr>
                    <td>Jelszó</td>
                    <td><input type="password" class="editmezo" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td>Jelszó mégegyszer</td>
                    <td><input type="password" class="editmezo" name="password2" id="password2" /></td>
                </tr>
                <tr>
                    <td>Megjelenítendő név</td>
                    <td><input type="text" value="<?php echo $nev; ?>" class="editmezo" name="nev" id="nev" /></td>
                </tr>
                <tr><th colspan="2"><input type="submit" value="Elküld" name="submit" /></th></tr>
            </table>
        </form>
    </div>
<?php
    // ide jon a kod
    include_once 'inc/UserReg.php';
    $u=new UserReg();
    //$u->nev="gipsz jakab";
    $u->password="dodo";
    $u->setNev("Gipsz Jakab");
    print "Nev: ".$u->getNev();

    $u2=$u;
    $u2->setNev("Nyomasek BObo");

    print "Jelszo: ".$u->password;
    
?>
</div>
<?php
    include_once 'inc/footer.php';
?>