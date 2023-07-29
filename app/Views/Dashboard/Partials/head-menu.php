<div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <img class="icon ni ni-user-alt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtKK_0rKATldCBx-Jm4K_hi580t6twSLTqug&usqp=CAU"/
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <img class="user-avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtKK_0rKATldCBx-Jm4K_hi580t6twSLTqug&usqp=CAU"/>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo $_SESSION['username']; ?></span>
                                                        <span class="sub-text"><?php echo $_SESSION['email']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="/<?php echo DASHBOARD_URL ?>/profile"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="/auth/logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .nk-header-tools -->
                            	