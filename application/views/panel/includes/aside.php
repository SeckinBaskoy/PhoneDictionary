<?php 

$user=get_active_user();

?>
<aside id="menubar" class="menubar light">
  
  <div class="app-user">
    <div class="media">
      <div class="media-left">
      </div>
      <div class="media-body">
        <div class="foldable">
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h5 class="username"><?=$user->full_name;?></h5>

              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="<?=base_url('users/update_form/'.$user->id);?>">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Edit Profile</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="<?=base_url('logout');?>">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Logout</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->
  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
      <?php if(isAllowedViewModule("rehber")) { ?>
          <li>
            <a href="<?=base_url("rehber");?>">
              <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">Phone Directory</span>
            </a>
          </li>
      <?php } ?>
      <li class="menu-separator"><hr></li>
      <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">Parameters &amp; Settings</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
            <ul class="submenu">
              <?php if(isAllowedViewModule("birimler")) { ?>
                    <li><a href="<?=base_url("birimler");?>"><i class="menu-icon fa fa-sitemap"></i><span class="menu-text">Unit Identification</span></a></li>
              <?php } ?>
              <?php if(isAllowedViewModule("unvanlar")) { ?>
                    <li><a href="<?=base_url("unvanlar");?>"><i class="menu-icon fa fa-mortar-board"></i><span class="menu-text">Title Identification</span></a>
                    </li>
              <?php } ?>
              <?php if(isAllowedViewModule("emailsettings")) { ?>
                    <li><a href="<?=base_url("emailsettings");?>"><i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i><span class="menu-text">e-Mail Settings</span></a></li>
              <?php } ?>
              <?php if(isAllowedViewModule("users")) { ?>
                    <li><a href="<?=base_url("users");?>"><i class="menu-icon fa fa-users"></i><span class="menu-text">User Management</span></a></li>
              <?php } ?>
                  <?php if(isAllowedViewModule("user_role")) { ?>
                    <li><a href="<?=base_url("user_role");?>"><i class="menu-icon fa fa-user-times"></i><span class="menu-text">User Privileges</span></a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="menu-separator"><hr></li>
          <li>
          <a class="text-color" href="<?=base_url('logout');?>">
            <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
            <span>Logout</span>
          </a>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>