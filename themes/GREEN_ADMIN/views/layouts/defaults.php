<!DOCTYPE html>
<html ng-app="backEndApp">
    <head>
        <?php
        Yii::app()->clientScript->registerCoreScript("jquery");
        ?>
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->baseUrl; ?>'
        </script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Maverick">
        <meta name="author" content="Spotky Team">

        <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/rtq_favicon.png">

        <!-- prochtml:remove:dist -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/less/styles.css" rel="stylesheet" media="all">
        <!-- /prochtml -->
        <?php /*
        <!--<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>-->
         */?>
        <!-- bower:css -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/angular-ui-tree/dist/angular-ui-tree.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/ng-grid/ng-grid.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/angular-xeditable/dist/css/xeditable.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/pnotify/pnotify.core.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/pnotify/pnotify.buttons.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/pnotify/pnotify.history.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/nanoscroller/bin/css/nanoscroller.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/textAngular/src/textAngular.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/angular-ui-grid/ui-grid.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/switchery/dist/switchery.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/ng-sortable/dist/ng-sortable.css" />
        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl; ?>/bower_components/fullcalendar/fullcalendar.css" />-->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/angular-meditor/dist/meditor.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/angular-ui-select/dist/select.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/animate.css/animate.css" />
        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl; ?>/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css" />-->

        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl; ?>/bower_components/skylo/vendor/styles/skylo.css" />-->
        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl; ?>/bower_components/bootstrap-datepaginator/dist/bootstrap-datepaginator.min.css" />-->
        <!-- endbower -->
        <link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->theme->baseUrl; ?>/fonts/glyphicons/css/glyphicons.min.css' />
        <link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->theme->baseUrl; ?>/plugins/form-fseditor/fseditor.css' />
        <!--<link rel='stylesheet' type='text/css' href='<?php // echo Yii::app()->theme->baseUrl; ?>/plugins/jcrop/css/jquery.Jcrop.min.css' />-->
        
        <!------------------------------ CSS/LESS -->
        <!-- core -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/admin/core.css" rel="stylesheet" media="all"> 
        <!-- datetimepicker -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/lib/datetimepicker/datetimepicker.css" rel="stylesheet" media="all"> 
        <!-- cropper -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/lib/cropper/cropper.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/lib/cropper/main.css">
        <!-- nvd3 -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/nvd3/src/nv.d3.css" />
        <!-- nailthumb -->
        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->baseUrl; ?>/css/lib/nailthumb/jquery.nailthumb.less" />-->
        
        <!------------------------------ JS -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
        <!--<script type="text/javascript" src="<?php // echo Yii::app()->theme->baseUrl; ?>/plugins/misc/less.js"></script>-->

        <!-- core -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/admin/core.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/admin/coreng.js"></script>
        <!-- angular -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/angular/angular.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/angular/angular-loadscript.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/angular/ui-bootstrap-tpls.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/angular/angular-keep-values.js"></script>
        <!-- nvd3 -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/d3/d3.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/nvd3/nv.d3.min.js"></script>
        <!-- mustache -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/mustache/mustache.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/mustache/highlight.js"></script>
        <!-- datetimepicker -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/datepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/datepicker/bootstrap-datetimepicker.id.js"></script>
        <!-- cropper -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/cropper/cropper.min.js"></script>
        <!--<script type="text/javascript-lazy" src="<?php // echo Yii::app()->baseUrl;  ?>/js/lib/cropper/main.js"></script>-->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/cropper/main.js"></script>
        <!-- typeahead -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/typeahead/typeahead.bundle.min.js"></script>
        <!--<script type="text/javascript" src="<?php // echo Yii::app()->baseUrl; ?>/js/lib/typeahead/bloodhound.js"></script>-->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/typeahead/handlebars.min.js"></script>
        <!-- bootstrap addons -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/lib/bootstrap/stacked-modal.js"></script>
        <!-- nailthumb -->
        <!--<script type="text/javascript" src="<?php // echo Yii::app()->baseUrl; ?>/js/lib/nailthumb/jquery.nailthumb.1.1.js"></script>-->
        
    </head>
    <body ng-controller="MainController" class="navbar-indigo sidebar-default">
        <header id="topnav" class="navbar navbar-fixed-top">
            <a id="leftmenu-trigger"></a>
            <div class="navbar-header pull-left">
                <a href="" class="navbar-brand">Rumah TahfidzQu</a>
            </div>
            <ul class="nav navbar-nav pull-right toolbar">
                <li class="dropdown" ng-class="dropdownShowClass">
                    <a ng-click="showDropdown()" class="dropdown-toggle username" dropdown-toggle><img src="<?php echo User::getPhotoIconUrl(Yii::app()->user->id) ?>"></a>
                    <ul class="dropdown-menu animated flipInX userinfo arrow">
                        <li>
                            <a ng-init="init('myProfileUrl', '<?php echo Yii::app()->createAbsoluteUrl('User/myprofile') ?>')" ng-click="showProfile()">Edit Profile <i class="pull-right glyphicon glyphicon-user"></i></a>
                        </li>
                        <li>
                            <a ng-init="init('myPasswordUrl', '<?php echo Yii::app()->createAbsoluteUrl('User/changepassword') ?>')" ng-click="showPassword()">Ganti Password<i class="pull-right glyphicon glyphicon-cog"></i></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('site/logout') ?>" class="text-right">Sign Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper left-pannel">
                    <nav class="static-sidebar" role="navigation">
                        <?php
                        /**/
                        ?>
                        <div class="left-pannel-inner">
                            <!--<h5>Navigation</h5>-->
                            <?php $this->widget("application.components.widgets.MainMenu"); ?>
                        </div>
                        <?php
                        /**/
                        ?>
                        <?php
                        /*
                          ?>
                          <ul id="sidebar" style="top:50px;">
                          <li class="nav-separator"><span>Peninjauan</span></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-home"></i><span>Dashbord</span></a></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-send"></i><span>Setoran Hafalan</span></a></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-th-list"></i><span>Halaqoh</span></a></li>
                          <li class="nav-separator"><span>Pendataan</span></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-book"></i><span>Data Ustad</span></a></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-floppy-disk"></i><span>Data Santri</span></a></li>
                          <li class="nav-separator"><span>Statistik</span></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-stats"></i><span>Data Santri</span></a></li>
                          <li class="nav-separator"><span>Administrator</span></li>
                          <li class="item"><a href=""><i class="glyphicon glyphicon-user"></i><span>User</span></a></li>
                          </ul>
                          <?php
                         */
                        ?>
                    </nav>
                </div>
                <div class="static-content-wrapper">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="my-profile-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Profil Saya</h4>
                </div>
                <div class="modal-body">
                    <div class="c-success-alert animation-fade" ng-hide="profile">
                        <div class="alert alert-success alert-dismissable" role="alert" type="success" close="closeAlert($index)">
                            <button type="button" class="close">
                                <span class=""></span>
                                <span class="sr-only">Close</span>
                            </button>
                            <div><span class=""><strong>Sukses!</strong> Data berhasil disimpan</span></div>
                        </div>
                    </div>
                    <div direct-profile-form="myProfileForm" template-url="<?php echo Yii::app()->createAbsoluteUrl('User/myprofile') ?>" profile="myProfileData">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" ng-click="saveMyProfile()" class="btn btn-primary c-profile-save">Simpan</button>
                    <!--<button type="button" ng-click="checkScope()" class="btn btn-primary c-profile-save">Cek</button>-->
                </div>
                <!--<div ng-bind="myProfileData.full_name"></div>-->
            </div>

        </div>
    </div>    
    <!-- Modal -->
    <div id="change-password-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ganti Password</h4>
                </div>
                <div class="modal-body">
                    <div class="c-success-alert animation-fade" ng-hide="hideSuccessPassword">
                        <div class="alert alert-success alert-dismissable" role="alert" type="success" close="closeAlert($index)">
                            <button type="button" class="close">
                                <span class=""></span>
                                <span class="sr-only">Close</span>
                            </button>
                            <div><span class=""><strong>Sukses!</strong> Password berhasil diganti</span></div>
                        </div>
                    </div>
                    <div direct-password="changePasswordForm" template-url="<?php echo Yii::app()->createAbsoluteUrl('User/myprofile') ?>" password="myPasswordData">
                    </div>
                    <!--<div ng-bind="myPasswordData.currentPassword"></div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" ng-click="changePassword()" class="btn btn-primary c-profile-save">Simpan</button>
                    <!--<button type="button" ng-click="checkScope()" class="btn btn-primary c-profile-save">Cek</button>-->
                </div>
                <!--<div ng-bind="myProfileData.full_name"></div>-->
            </div>

        </div>
    </div>
</body>
</html>