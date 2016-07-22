<?php
/* created by rizqi */
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users',
    $model->id,
);
?>
<div class="col-25-percentage">
    <img class="img-thumbnail input-width-100" src="<?php echo Yii::app()->baseUrl . "/images/resource/big.jpg"; ?>" alt="">
    <div class="mb30"></div>
    <h5 class="subtitle">About</h5>
    <p class="mb30">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat... Show More
    </p>
    <h5 class="subtitle">Connect</h5>
    <ul class="profile-social-list">
        <li><i class="icon-twitter"></i> <a href="">twitter.com/eileensideways</a></li>
        <li><i class="icon-facebook"></i> <a href="">facebook.com/eileen</a></li>
        <li><i class="icon-youtube"></i> <a href="">youtube.com/eileen22</a></li>
        <li><i class="icon-linkedin"></i> <a href="">linkedin.com/4ever-eileen</a></li>
        <li><i class="icon-pinterest"></i> <a href=""> pinterest.com/eileen</a></li>
        <li><i class="icon-instagram"></i> <a href="">instagram.com/eiside</a></li>
    </ul>
    <div class="mb30"></div>
    <h5 class="subtitle">Address</h5>
    <p>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        P: (123) 456-7890 <br>
    </p>
</div>
<div class="col-75-percentage">
    <h2 class="mb20"><?php echo $model->getFullName(); ?></h2>
    <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
    <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
    <button class="button-success"><i class="icon-user"></i> Follow</button>
    <button class="button-danger"><i class="icon-envelope"></i> Message</button>
    <div class="mb30"></div>
    <div class="tabview">
        <ul>
            <li class="active"><a>Activities</a></li>
            <li><a>Followers</a></li>
            <li><a>Following</a></li>
            <li><a>My Events</a></li>
            <div class="clear"></div>
        </ul>
        <div class="tabview-content border">
            <div class="tabview-pane active">
                <div class="padding-15">
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="28px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <strong>Ray Sin started</strong> following <strong>Eileen Sideways</strong>. 
                            <br>
                            <small>Today at 3:18pm</small>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="28px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <strong>Ray Sin started</strong> posted a new blog.  
                            <br>
                            <small>Today at 3:18pm</small>
                            <div class="media no-border">
                                <a class="pull-left"><img class="media-object" height="100px" width="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                                <div class="media-body">
                                    <a><h3 class="mb5">Eileen Sideways</h3></a>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... 
                                        <a href="">Read more</a>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="28px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <strong>Ray Sin started</strong> following <strong>Eileen Sideways</strong>. 
                            <br>
                            <small>Today at 3:18pm</small>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="tabview-pane">
                <div class="padding-15">
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-success"><i class="icon-user"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-submit"><i class="icon-check"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-success"><i class="icon-user"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="tabview-pane">
                <div class="padding-15">
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-submit"><i class="icon-user"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-submit"><i class="icon-user"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" width="100px" height="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <h3 class="subtitle mb5">Eileen Sideways</h3>
                            <div class="mb5"><i class="icon-map-marker"></i> San Francisco, California, USA</div>
                            <div class="mb20"><i class="icon-briefcase"></i>  Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                            <button class="button-submit"><i class="icon-user"></i> Follow</button>
                            <button class="button-danger"><i class="icon-envelope"></i> Message</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="tabview-pane">
                <div class="padding-15">
                    <div class="media">
                        <a class="pull-left"><img class="media-object" height="100px" width="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <a><h3 class="mb5">Eileen Sideways</h3></a>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... 
                                <a href="">Read more</a>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" height="100px" width="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <a><h3 class="mb5">Eileen Sideways</h3></a>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... 
                                <a href="">Read more</a>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="media">
                        <a class="pull-left"><img class="media-object" height="100px" width="125px" src="<?php echo Yii::app()->baseUrl . "/images/resource/avatar.jpg"; ?>"></a>
                        <div class="media-body">
                            <a><h3 class="mb5">Eileen Sideways</h3></a>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat... 
                                <a href="">Read more</a>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>