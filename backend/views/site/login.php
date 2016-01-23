<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/signin.css');

?>





<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="container">



    <div class="" id="login-wrapper">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div id="logo-login">
                    <h1>Apricot
                        <span>v1.3</span>
                    </h1>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="account-box">

                    <form role="form" id="login-form" method="POST" action="/index.php?r=site/login">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />                        
                        <div class="form-group">
                            <a href="#" class="pull-right label-forgot">Forgot email?</a>
                            <label for="inputUsernameEmail">Username or email</label>
                            <input name="LoginForm[username]" type="text" id="inputUsernameEmail loginform-username" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="#" class="pull-right label-forgot">Forgot password?</a>
                            <label for="inputPassword">Password</label>
                            <input id="loginform-password" name="LoginForm[password]" type="password" id="inputPassword" class="form-control">
                        </div>
                        <div class="checkbox pull-left">
                            <label>
                                <input type="checkbox">Remember me</label>
                        </div>
                        <button class="btn btn btn-primary pull-right" type="submit">
                            Log In
                        </button>
                    </form>
                    <a class="forgotLnk" href="index.html"></a>
                    <div class="or-box">

                        <center><span class="text-center login-with">Login or <b>Sign Up</b></span></center>
                        <div class="row">
                            <div class="col-md-6 row-block">
                                <a href="index.html" class="btn btn-facebook btn-block">
                                    <span class="entypo-facebook space-icon"></span>Facebook</a>
                            </div>
                            <div class="col-md-6 row-block">
                                <a href="index.html" class="btn btn-twitter btn-block">
                                    <span class="entypo-twitter space-icon"></span>Twitter</a>

                            </div>

                        </div>
                        <div style="margin-top:25px" class="row">
                            <div class="col-md-6 row-block">
                                <a href="index.html" class="btn btn-google btn-block"><span class="entypo-gplus space-icon"></span>Google +</a>
                            </div>
                            <div class="col-md-6 row-block">
                                <a href="index.html" class="btn btn-instagram btn-block"><span class="entypo-instagrem space-icon"></span>Instagram</a>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row-block">
                        <div class="row">
                            <div class="col-md-12 row-block">
                                <a href="index.html" class="btn btn-primary btn-block">Create New Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div style="text-align:center;margin:0 auto;">
        <h6 style="color:#fff;">Release Candidate 1.0 Powered by © Themesmiles 2014</h6>
    </div>

</div>
<div id="test1" class="gmap3"></div>